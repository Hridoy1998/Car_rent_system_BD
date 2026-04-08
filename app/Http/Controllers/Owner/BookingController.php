<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::whereHas('car', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->with('customer', 'car')
            ->latest()
            ->paginate(10);

        return view('owner.bookings.index', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Authorize owner
        if ($booking->car->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,completed,cancelled',
        ]);

        DB::transaction(function () use ($booking, $validated) {
            $booking->update(['status' => $validated['status']]);

            if ($validated['status'] === 'completed') {
                $booking->update(['payment_status' => 'paid']);
                
                // Workflow 10: Owner Earnings
                Earning::firstOrCreate(
                    ['booking_id' => $booking->id],
                    [
                        'owner_id' => auth()->id(),
                        'amount' => $booking->total_price, // 100% of booking price goes to owner
                    ]
                );
            }
        });

        return back()->with('success', 'Booking status updated to ' . $validated['status'] . '.');
    }
}
