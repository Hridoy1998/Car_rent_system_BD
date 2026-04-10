<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Sovereign Admin (1)
        User::factory()->admin()->create([
            'name' => 'Monolith Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Create Sector Owners (9) - Each with exactly 2 assets
        User::factory(8)->owner()->create()->each(function ($user) {
            Car::factory(2)->create([
                'user_id' => $user->id,
                'status' => 'approved',
            ]);
        });

        // Dedicated Demo Owner (Part of the 9)
        $demoOwner = User::factory()->owner()->create([
            'name' => 'Demo Owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('password'),
        ]);
        Car::factory(2)->create([
            'user_id' => $demoOwner->id,
            'status' => 'approved',
        ]);

        // 3. Create Operational Customers (10)
        User::factory(9)->customer()->create();

        // Dedicated Demo Customer (Part of the 10)
        User::factory()->customer()->create([
            'name' => 'Demo Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // 4. Tactical Operational Data (Disabled for clean demo)
        // $this->call(DemoHubSeeder::class);
    }
}
