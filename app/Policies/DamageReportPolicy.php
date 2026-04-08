<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\DamageReport;
use App\Models\User;

class DamageReportPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Booking $booking): bool
    {
        // Only the car owner can file a damage report after completion
        return $user->id === $booking->car->user_id
            && $booking->status === 'completed';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DamageReport $damageReport): bool
    {
        return $user->role === 'admin'
            || $user->id === $damageReport->booking->user_id
            || $user->id === $damageReport->booking->car->user_id;
    }
}
