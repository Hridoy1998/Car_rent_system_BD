<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Car;
use App\Models\PromoCode;
use App\Models\Verification;
use App\Notifications\BookingRequested;
use App\Notifications\BookingStatusUpdated;
use App\Notifications\PaymentSuccessful;
use App\Services\BookingService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService,
        protected PaymentService $paymentService
    ) {}

    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with(['car.owner', 'car.images', 'car.reviews', 'damageReports'])
            ->latest()
            ->paginate(10);

        return view('customer.bookings.index', compact('bookings'));
    }

    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();

        // Require approved NID verification
        $verified = Verification::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->exists();

        if (! $verified) {
            return redirect()->route('customer.verifications.index')
                ->with('error', 'You must verify your identity before making a booking.');
        }

        $car = Car::findOrFail($data['car_id']);

        if ($car->status !== 'approved') {
            return back()->with('error', 'This car is not available for booking.')->withInput();
        }

        // Strict overlap check from BookingService
        if ($this->bookingService->checkOverlap($car->id, $data['start_date'], $data['end_date'])) {
            return back()->withErrors(['start_date' => 'This car is already booked for the selected dates.'])->withInput();
        }

        $totalPrice = $this->bookingService->calculateTotal($car, $data['start_date'], $data['end_date']);

        // Apply promo code discount if provided
        if (! empty($data['promo_code'])) {
            $promo = PromoCode::where('code', $data['promo_code'])
                ->where('expiry_date', '>=', today())
                ->first();

            if ($promo) {
                if ($promo->discount_type === 'percentage') {
                    $totalPrice -= $totalPrice * ($promo->discount_value / 100);
                } else {
                    $totalPrice = max(0, $totalPrice - $promo->discount_value);
                }
            }
        }

        $booking = DB::transaction(function () use ($car, $data, $totalPrice) {
            return Booking::create([
                'user_id' => auth()->id(),
                'car_id' => $car->id,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'total_price' => $totalPrice,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);
        });

        // Notify owner
        $car->owner->notify(new BookingRequested($booking->load('customer', 'car')));

        return redirect()->route('customer.bookings.index')
            ->with('success', 'Booking request submitted! Awaiting owner approval.');
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $newStatus = $request->validated()['status'];

        // Customer can only cancel
        if (auth()->user()->role === 'customer' && $newStatus !== 'cancelled') {
            abort(403, 'Customers can only cancel bookings.');
        }

        if (! in_array($booking->status, ['pending', 'approved'])) {
            return back()->with('error', 'This booking cannot be modified in its current state.');
        }

        DB::transaction(function () use ($booking, $newStatus) {
            $refundAmount = null;

            if ($newStatus === 'cancelled' && $booking->payment_status === 'paid') {
                $refundAmount = $this->bookingService->calculateRefund($booking);
                $this->paymentService->processRefund($booking, $refundAmount);
                $booking->update(['status' => 'cancelled', 'payment_status' => 'pending']);
            } else {
                $booking->update(['status' => $newStatus]);
            }
        });

        // Notify customer
        $booking->customer->notify(new BookingStatusUpdated($booking->load('car')));

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function pay(Booking $booking)
    {
        $this->authorize('pay', $booking);

        $paid = $this->paymentService->processPayment($booking);

        if ($paid) {
            $booking->customer->notify(new PaymentSuccessful($booking->load('car')));
            $booking->car->owner->notify(new BookingStatusUpdated($booking->load('car')));

            return back()->with('success', 'Payment successful! Your booking is confirmed.');
        }

        return back()->with('error', 'Payment failed. Please try again.');
    }
}
