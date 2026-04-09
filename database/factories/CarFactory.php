<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = [
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Land Cruiser', 'Prius'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'HR-V', 'City'],
            'Nissan' => ['Sunny', 'X-Trail', 'Patrol', 'Kicks'],
            'Hyundai' => ['Elantra', 'Tucson', 'Santa Fe', 'Creta'],
            'Mitsubishi' => ['Pajero', 'Lancer', 'Outlander', 'ASX'],
        ];

        $brand = fake()->randomElement(array_keys($brands));
        $model = fake()->randomElement($brands[$brand]);
        $year = fake()->numberBetween(2015, 2024);

        return [
            'user_id' => User::factory(),
            'title' => "$year $brand $model",
            'brand' => $brand,
            'model' => $model,
            'year' => $year,
            'type' => fake()->randomElement(['SUV', 'Sedan', 'Hatchback', 'Van', 'Other']),
            'transmission' => fake()->randomElement(['Manual', 'Auto']),
            'fuel_type' => fake()->randomElement(['Petrol', 'Octane', 'Hybrid', 'CNG']),
            'license_plate' => strtoupper(fake()->bothify('???-####')),
            'color' => fake()->safeColorName(),
            'seats' => fake()->numberBetween(4, 7),
            'price_per_day' => fake()->numberBetween(3000, 10000),
            'price_per_month' => fake()->numberBetween(70000, 200000),
            'location' => fake()->randomElement(['Gulshan, Dhaka', 'Banani, Dhaka', 'Uttara, Dhaka', 'Dhanmondi, Dhaka', 'Chattogram']),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
