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

        $brand = $this->faker->randomElement(array_keys($brands));
        $model = $this->faker->randomElement($brands[$brand]);
        $year = $this->faker->numberBetween(2015, 2024);

        return [
            'user_id' => User::factory(),
            'title' => "$year $brand $model",
            'brand' => $brand,
            'model' => $model,
            'year' => $year,
            'type' => $this->faker->randomElement(['SUV', 'Sedan', 'Hatchback', 'Van', 'Other']),
            'transmission' => $this->faker->randomElement(['Manual', 'Auto']),
            'fuel_type' => $this->faker->randomElement(['Petrol', 'Octane', 'Hybrid', 'CNG']),
            'license_plate' => strtoupper($this->faker->bothify('???-####')),
            'color' => $this->faker->safeColorName(),
            'seats' => $this->faker->numberBetween(4, 7),
            'price_per_day' => $this->faker->numberBetween(3000, 10000),
            'price_per_month' => $this->faker->numberBetween(70000, 200000),
            'location' => $this->faker->randomElement(['Gulshan, Dhaka', 'Banani, Dhaka', 'Uttara, Dhaka', 'Dhanmondi, Dhaka', 'Chattogram']),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
