<?php

namespace Database\Factories;

use App\Models\Earning;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class EarningFactory extends Factory
{
    protected $model = Earning::class;

    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'booking_id' => Booking::factory(),
            'amount' => rand(5000, 50000),
        ];
    }
}
