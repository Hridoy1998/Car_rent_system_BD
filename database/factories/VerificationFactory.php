<?php

namespace Database\Factories;

use App\Models\Verification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VerificationFactory extends Factory
{
    protected $model = Verification::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'document_type' => fake()->randomElement(['nid', 'passport', 'license']),
            'document_file' => 'demo/docs/sample_doc.pdf',
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
