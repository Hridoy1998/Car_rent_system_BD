<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('car.owner', 'car.images')
            ->latest()
            ->paginate(10);

        return view('customer.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        // Workflow 7: Require approved verification
        $hasVerification = \App\Models\Verification::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->exists();
            
        if (!$hasVerification) {
            return back()->withErrors(['car_id' => 'You must successfully verify your identity before booking any cars.'])->withInput();
        }

        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $car = Car::findOrFail($validated['car_id']);
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);

        // Check availability
        $overlapping = Booking::where('car_id', $car->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($q) use ($startDate, $endDate) {
                $q->whereBetween('start_date', [$startDate, $endDate])
                  ->orWhereBetween('end_date', [$startDate, $endDate])
                  ->orWhere(function ($q3) use ($startDate, $endDate) {
                      $q3->where('start_date', '<=', $startDate)
                         ->where('end_date', '>=', $endDate);
                  });
            })->exists();

        if ($overlapping) {
            return back()->withErrors(['start_date' => 'This car is already booked for the selected dates.'])->withInput();
        }

        $days = $startDate->diffInDays($endDate);
        if ($days === 0) {
            $days = 1; // Minimum 1 day rental
        }

        $totalPrice = $car->price_per_day * $days;

        // Apply month discount if applicable
        if ($days >= 30 && $car->price_per_month) {
            $months = floor($days / 30);
            $remainingDays = $days % 30;
            $totalPrice = ($months * $car->price_per_month) + ($remainingDays * $car->price_per_day);
        }

        Booking::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('customer.bookings.index')->with('success', 'Booking request sent successfully. Waiting for owner approval.');
    }

    public function update(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:cancelled',
        ]);

        // Customers can only cancel pending or approved bookings
        if (!in_array($booking->status, ['pending', 'approved'])) {
            return back()->with('error', 'You cannot cancel this booking.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
