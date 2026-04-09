<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Notifications\BookingStatusUpdated;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'car.owner', 'damageReports']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('customer', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('car', fn ($c) => $c->where('title', 'like', "%{$search}%"));
            });
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(15)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load([
            'customer.bookings',
            'customer.verifications',
            'car.owner.earnings',
            'car.owner.cars',
            'car.images',
            'damageReports',
            'messages.sender',
        ]);

        return view('admin.bookings.show', compact('booking'));
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
