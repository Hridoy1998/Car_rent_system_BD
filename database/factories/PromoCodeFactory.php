<?php

namespace Database\Factories;

use App\Models\PromoCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromoCodeFactory extends Factory
{
    protected $model = PromoCode::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->bothify('NEON-####')),
            'discount_type' => fake()->randomElement(['percentage', 'fixed']),
            'discount_value' => rand(5, 20) * 5, // 5% to 50% or 25 to 250 taka
            'expiry_date' => fake()->dateTimeBetween('now', '+6 months'),
        ];
    }
}
