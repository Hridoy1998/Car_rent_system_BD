<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'sender_id' => User::factory(),
            'receiver_id' => User::factory(),
            'booking_id' => Booking::factory(),
            'message' => fake()->randomElement([
                'Deployment location confirmed. See you at the sector coordinates.',
                'The asset is primed and ready. Please bring your identity tokens.',
                'Encountering heavy traffic in Sector 7. ETA delayed by 15 minutes.',
                'Pristine condition return confirmed. Terminating epoch now.',
                'Is there a specific fuel grade required for this asset?',
            ]),
            'seen' => fake()->boolean(),
        ];
    }
}
