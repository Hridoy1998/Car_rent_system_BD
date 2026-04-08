<?php

use App\Models\User;
use App\Models\Car;

it('allows an owner to list a new car', function () {
    $owner = User::factory()->create([
        'role' => 'owner',
    ]);

    $response = $this->actingAs($owner)->post('/owner/cars', [
        'title' => '2022 Honda Civic',
        'brand' => 'Honda',
        'model' => 'Civic',
        'year' => 2022,
        'type' => 'Sedan',
        'transmission' => 'Auto',
        'fuel_type' => 'Petrol',
        'price_per_day' => 4500,
        'price_per_month' => 90000,
        'location' => 'Banani, Dhaka',
        'description' => 'A wonderful car.',
    ]);

    $response->assertRedirect('/owner/cars');
    $this->assertDatabaseHas('cars', [
        'title' => '2022 Honda Civic',
        'status' => 'pending',
    ]);
});

it('allows an admin to approve a pending car', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);
    $owner = User::factory()->create([
        'role' => 'owner',
    ]);
    
    // Create a pending car
    $car = \App\Models\Car::create([
        'user_id' => $owner->id,
        'title' => '2021 Toyota RAV4',
        'brand' => 'Toyota',
        'model' => 'RAV4',
        'year' => 2021,
        'type' => 'SUV',
        'transmission' => 'Auto',
        'fuel_type' => 'Hybrid',
        'price_per_day' => 6500,
        'price_per_month' => 120000,
        'location' => 'Gulshan, Dhaka',
        'description' => 'Great SUV',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->put("/admin/cars/{$car->id}", [
        'status' => 'approved',
    ]);

    $response->assertSessionHas('success');
    
    // Check if the status was updated in database
    $this->assertDatabaseHas('cars', [
        'id' => $car->id,
        'status' => 'approved',
    ]);
});

it('displays approved cars on the homepage', function () {
    // Create a user for owner
    $owner = User::factory()->create(['role' => 'owner']);
    
    // Create an approved car
    \App\Models\Car::create([
        'user_id' => $owner->id,
        'title' => 'Approved Mazda',
        'brand' => 'Mazda',
        'model' => 'CX-5',
        'year' => 2020,
        'type' => 'SUV',
        'transmission' => 'Auto',
        'fuel_type' => 'Diesel',
        'price_per_day' => 5000,
        'price_per_month' => 100000,
        'location' => 'Uttara, Dhaka',
        'status' => 'approved',
    ]);

    // Create a pending car
    \App\Models\Car::create([
        'user_id' => $owner->id,
        'title' => 'Pending Mazda',
        'brand' => 'Mazda',
        'model' => 'CX-3',
        'year' => 2018,
        'type' => 'SUV',
        'transmission' => 'Auto',
        'fuel_type' => 'Diesel',
        'price_per_day' => 4000,
        'price_per_month' => 80000,
        'location' => 'Uttara, Dhaka',
        'status' => 'pending',
    ]);

    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('Approved Mazda');
    $response->assertDontSee('Pending Mazda');
});
