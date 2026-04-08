<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    /**
     * Determine whether the user can index messages for a booking.
     */
    public function viewAny(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id || $user->id === $booking->car->user_id;
    }

    /**
     * Determine whether the user can send a message for a booking.
     */
    public function create(User $user, Booking $booking): bool
    {
        // Must be part of the booking
        return $user->id === $booking->user_id || $user->id === $booking->car->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Message $message): bool
    {
        return $user->id === $message->sender_id || $user->id === $message->receiver_id;
    }
}
