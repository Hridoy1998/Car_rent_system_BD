<?php

namespace Database\Seeders;

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
        // 1. Create Admin
        User::factory()->admin()->create([
            'name' => 'Demo Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Create 20 Owners and some cars for them
        User::factory(20)->owner()->create()->each(function ($user) {
            \App\Models\Car::factory(rand(1, 3))->create([
                'user_id' => $user->id,
                'status' => 'approved', // Seed with some approved cars so they show up on home page
            ]);
        });

        // 3. Create 20 Customers
        User::factory(20)->customer()->create();

        // Specific test owner and customer for easy access
        User::factory()->owner()->create([
            'name' => 'Demo Owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->customer()->create([
            'name' => 'Demo Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // 4. Populate Operational Data (Bookings, Reviews, Earnings, etc.)
        $this->call(DemoHubSeeder::class);
    }
}
