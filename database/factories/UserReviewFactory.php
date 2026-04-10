<?php

namespace Database\Factories;

use App\Models\UserReview;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserReviewFactory extends Factory
{
    protected $model = UserReview::class;

    public function definition(): array
    {
        return [
            'reviewer_id' => User::factory(),
            'reviewee_id' => User::factory(),
            'booking_id' => Booking::factory(),
            'rating' => fake()->numberBetween(4, 5),
            'comment' => fake()->randomElement([
                'Professional operator. Adhered to all protocols.',
                'Excellent communication integrity. Highly reliable user.',
                'Asset was returned in pristine condition. Strategic partner.',
                'Timely deployment and return. Zero variance detected.',
                'Protocol-driven exchange. Exceptional transparency.',
            ]),
        ];
    }
}
