<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Filtered in index method
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booking $booking): bool
    {
        return $user->role === 'admin'
            || $user->id === $booking->user_id
            || $user->id === $booking->car->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'customer' && $user->is_verified;
    }

    /**
     * Determine whether the user can update the model (approve/reject/complete).
     */
    public function update(User $user, Booking $booking): bool
    {
        // Admin can update anything for management
        if ($user->role === 'admin') {
            return true;
        }

        // Owner can approve/reject/complete bookings for their cars
        if ($user->role === 'owner' && $user->id === $booking->car->user_id) {
            return true;
        }

        // Customer can only cancel their own booking (if pending/approved) or initiate return (if ongoing)
        if ($user->role === 'customer' && $user->id === $booking->user_id) {
            return in_array($booking->status, ['pending', 'approved', 'ongoing']);
        }

        return false;
    }

    /**
     * Determine whether the user can pay for the booking.
     */
    public function pay(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id
            && $booking->status === 'approved'
            && $booking->payment_status === 'pending';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Booking $booking): bool
    {
        return $user->role === 'admin';
    }
}
