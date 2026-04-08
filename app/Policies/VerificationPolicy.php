<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Verification;

class VerificationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Verification $verification): bool
    {
        return $user->role === 'admin' || $user->id === $verification->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'customer';
    }

    /**
     * Determine whether the user can update the model (Admin approve/reject).
     */
    public function update(User $user, Verification $verification): bool
    {
        return $user->role === 'admin';
    }
}
