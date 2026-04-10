<?php

namespace Database\Factories;

use App\Models\DamageReport;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class DamageReportFactory extends Factory
{
    protected $model = DamageReport::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'description' => fake()->randomElement([
                'Minor surface abrasion on rear bumper sector.',
                'Wheel rim integrity compromised during deployment.',
                'Small windshield fracture detected in lower-left quadrant.',
                'Interior upholstery variance: liquid exposure.',
            ]),
            'image' => 'demo/damage_sample.jpg', // Placeholder for seeder logic
            'cost' => rand(2000, 15000),
            'status' => fake()->randomElement(['pending', 'disputed', 'resolved']),
        ];
    }
}
