<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 month', '+1 month');
        $end = (clone $start)->modify('+'.rand(1, 14).' days');

        $pricePerDay = rand(2000, 15000);
        $days = $start->diff($end)->days ?: 1;
        $total = $pricePerDay * $days;

        $status = fake()->randomElement(['pending', 'approved', 'ongoing', 'returning', 'completed', 'cancelled']);
        $paymentStatus = in_array($status, ['ongoing', 'returning', 'completed']) ? 'paid' : 'pending';

        return [
            'user_id' => User::factory(), // Fallback if not provided
            'car_id' => Car::factory(),   // Fallback if not provided
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $total,
            'status' => $status,
            'payment_status' => $paymentStatus,
            'checked_in_at' => null,
            'returned_at' => null,
            'start_odo' => rand(1000, 50000),
            'security_deposit_amount' => rand(5000, 20000),
            'security_deposit_status' => 'held',
        ];
    }

    public function ongoing(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ongoing',
            'payment_status' => 'paid',
            'checked_in_at' => now()->subDays(1),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'payment_status' => 'paid',
            'checked_in_at' => now()->subDays(10),
            'returned_at' => now()->subDays(7),
            'end_odo' => $attributes['start_odo'] + rand(100, 1000),
            'end_fuel' => rand(50, 100),
            'security_deposit_status' => 'released',
        ]);
    }
}
