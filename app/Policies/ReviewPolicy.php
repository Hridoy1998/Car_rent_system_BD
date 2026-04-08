<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Booking $booking): bool
    {
        // Must be the customer of the booking, and booking must be completed
        return $user->id === $booking->user_id
            && $booking->status === 'completed'
            && ! Review::where('user_id', $user->id)->where('car_id', $booking->car_id)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->role === 'admin';
    }
}
