<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Notification::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid()->toString(),
            'type' => 'App\Notifications\BookingStatusUpdated',
            'notifiable_type' => 'App\Models\User',
            'notifiable_id' => 1, // Will be overridden
            'data' => [
                'title' => fake()->randomElement([
                    'Deployment Authorized',
                    'Payment Signal Received',
                    'Asset Integrity Alert',
                    'New Message in Secure Channel',
                    'Epoch Termination Confirmed',
                ]),
                'message' => fake()->sentence(),
                'action_url' => '/dashboard',
            ],
            'read_at' => fake()->randomElement([null, now()]),
        ];
    }
}
