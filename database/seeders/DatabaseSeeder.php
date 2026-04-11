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
        // 1. Create Sovereign Admin
        User::factory()->admin()->create([
            'name' => 'Monolith Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Create 20 Users (mix of 'customer' and 'owner')
        User::factory(20)->create()->each(function ($user) {
            // 3. For each owner, create 1 or 2 cars
            if ($user->role === 'owner') {
                Car::factory(rand(1, 2))->create([
                    'user_id' => $user->id,
                    'status' => 'approved',
                ]);
            }
        });
    }
}
