<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Notifications\BookingStatusUpdated;
use App\Services\EarningService;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct(protected EarningService $earningService) {}

    public function index()
    {
        $bookings = Booking::whereHas('car', fn ($q) => $q->where('user_id', auth()->id()))
            ->with(['customer', 'car.images', 'damageReports'])
            ->latest()
            ->paginate(10);

        return view('owner.bookings.index', compact('bookings'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $newStatus = $request->validated()['status'];

        // Enforce lifecycle: can only progress forward
        $allowed = [
            'pending' => ['approved', 'rejected'],
            'approved' => ['completed', 'cancelled'],
        ];

        $currentStatus = $booking->status;
        if (! isset($allowed[$currentStatus]) || ! in_array($newStatus, $allowed[$currentStatus])) {
            return back()->with('error', "Cannot transition booking from '{$currentStatus}' to '{$newStatus}'.");
        }

        // Prevent completion if payment not received
        if ($newStatus === 'completed' && $booking->payment_status !== 'paid') {
            return back()->with('error', 'Cannot complete a booking with unpaid payment. Ask the customer to pay first.');
        }

        DB::transaction(function () use ($booking, $newStatus) {
            $booking->update(['status' => $newStatus]);

            // Settle earnings on completion
            if ($newStatus === 'completed') {
                $this->earningService->settleBooking($booking->load('car'));
            }
        });

        // Notify the customer
        $booking->customer->notify(new BookingStatusUpdated($booking->load('car')));

        return back()->with('success', "Booking status updated to '{$newStatus}'.");
    }
}
