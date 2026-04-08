<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;

class CarPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Car $car): bool
    {
        // Public can see approved cars
        if ($car->status === 'approved') {
            return true;
        }

        // Admin can see everything
        if ($user && $user->role === 'admin') {
            return true;
        }

        // Owner can see their own
        if ($user && $user->id === $car->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'owner';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Car $car): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $car->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Car $car): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $car->user_id;
    }
}
