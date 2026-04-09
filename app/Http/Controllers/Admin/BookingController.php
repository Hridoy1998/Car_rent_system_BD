<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Notifications\BookingStatusUpdated;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['customer', 'car.owner', 'damageReports'])
            ->latest()
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load([
            'customer.verifications',
            'car.owner',
            'car.images',
            'damageReports',
            'messages.sender',
        ]);

        return view('bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,completed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        // Notify customer
        $booking->customer->notify(new BookingStatusUpdated($booking->load('car')));

        return back()->with('success', "Booking #{$booking->id} status changed to {$request->status}.");
    }
}
