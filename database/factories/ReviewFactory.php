<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'car_id' => Car::factory(),
            'rating' => fake()->numberBetween(3, 5),
            'comment' => fake()->randomElement([
                'Exceptional asset. Handover was precise and efficient.',
                'The vehicle performance exceeded engineering expectations.',
                'Tactical mobility at its finest. Highly recommended.',
                'Pristine condition. Minimal latency during communication.',
                'Verified ownership was clear. Smooth deployment.',
                'Elite fleet quality. Will engage again.',
            ]),
        ];
    }
}
