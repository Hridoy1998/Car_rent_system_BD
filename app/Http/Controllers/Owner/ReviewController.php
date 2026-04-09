<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\UserReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        if ($booking->car->user_id !== auth()->id() || $booking->status !== 'completed') {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        UserReview::create([
            'reviewer_id' => auth()->id(),
            'reviewee_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Renter reputation updated successfully.');
    }
}
