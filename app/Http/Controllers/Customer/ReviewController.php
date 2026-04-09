<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id() || $booking->status !== 'completed') {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $exists = \App\Models\UserReview::where('reviewer_id', auth()->id())
            ->where('booking_id', $booking->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Host reputation already logged for this itinerary.');
        }

        \App\Models\UserReview::create([
            'reviewer_id' => auth()->id(),
            'reviewee_id' => $booking->car->user_id,
            'booking_id' => $booking->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Host reputation updated. Protocol finalized.');
    }
}
