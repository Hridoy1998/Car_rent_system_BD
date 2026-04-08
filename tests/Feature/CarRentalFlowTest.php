<?php
use App\Models\User;
use App\Models\Car;
use App\Models\Booking;
use App\Models\Verification;
use App\Models\Message;
use App\Models\Review;
use App\Models\DamageReport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('full car rental lifecycle', function () {
    // 1. Create Users
    $admin = User::factory()->create(['role' => 'admin']);
    $owner = User::factory()->create(['role' => 'owner']);
    $customer = User::factory()->create(['role' => 'customer']);

    // 2. Customer performs Verification (Workflow 7)
    $this->actingAs($customer)
        ->post(route('customer.verifications.store'), [
            'document_type' => 'NID',
            'document_file' => UploadedFile::fake()->create('nid.jpg', 100, 'image/jpeg'),
        ])->assertSessionHasNoErrors();
    
    $verification = Verification::where('user_id', $customer->id)->first();
    expect($verification)->not->toBeNull()
        ->and($verification->status)->toBe('pending');

    // Admin approves verification
    $this->actingAs($admin)
        ->put(route('admin.verifications.update', $verification), [
            'status' => 'approved',
        ])->assertSessionHasNoErrors();

    // 3. Owner adds a car (Phase 1)
    $this->actingAs($owner)
        ->post(route('owner.cars.store'), [
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2022,
            'title' => 'Toyota Corolla 2022',
            'type' => 'Sedan',
            'color' => 'White',
            'license_plate' => 'DHA-123',
            'transmission' => 'Auto',
            'fuel_type' => 'Petrol',
            'seats' => 5,
            'price_per_day' => 5000,
            'price_per_month' => 100000,
            'location' => 'Dhaka',
            'description' => 'Great car',
            'images' => [UploadedFile::fake()->create('car.jpg', 100, 'image/jpeg')],
        ])->assertSessionHasNoErrors();

    $car = Car::where('user_id', $owner->id)->first();
    
    // Admin approves car
    $this->actingAs($admin)
        ->put(route('admin.cars.update', $car), [
            'status' => 'approved',
        ])->assertSessionHasNoErrors();

    // 4. Customer Books the car (Phase 2)
    $startDate = now()->addDays(1)->format('Y-m-d');
    $endDate = now()->addDays(3)->format('Y-m-d');
    
    $this->actingAs($customer)
        ->post(route('customer.bookings.store'), [
            'car_id' => $car->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ])->assertSessionHasNoErrors();

    $booking = Booking::where('user_id', $customer->id)->first();
    expect($booking->total_price)->toBeGreaterThan(0);

    // 5. Customer and Owner Chat (Workflow 5)
    $this->actingAs($customer)
        ->post(route('bookings.messages.store', $booking), [
            'message' => 'Hello, is this available?',
        ])->assertSessionHasNoErrors();

    $this->actingAs($owner)
        ->post(route('bookings.messages.store', $booking), [
            'message' => 'Yes it is!',
        ])->assertSessionHasNoErrors();

    expect(Message::where('booking_id', $booking->id)->count())->toBe(2);

    // 6. Owner Approves Booking
    $this->actingAs($owner)
        ->put(route('owner.bookings.update', $booking), [
            'status' => 'approved',
        ])->assertSessionHasNoErrors();

    // 7. Owner completes Booking, generating earnings (Workflow 8 & 10)
    $this->actingAs($owner)
        ->put(route('owner.bookings.update', $booking), [
            'status' => 'completed',
        ])->assertSessionHasNoErrors();

    $booking->refresh();
    expect($booking->status)->toBe('completed');
    expect(\App\Models\Earning::where('booking_id', $booking->id)->count())->toBe(1);

    // 8. Customer reviews car (Workflow 2)
    $this->actingAs($customer)
        ->post(route('customer.bookings.reviews.store', $booking), [
            'rating' => 5,
            'comment' => 'Very smooth ride.',
        ])->assertSessionHasNoErrors();

    expect(Review::where('car_id', $car->id)->count())->toBe(1);

    // 9. Owner files Damage Report (Workflow 2)
    $this->actingAs($owner)
        ->post(route('owner.bookings.damage-reports.store', $booking), [
            'description' => 'Scratch on left door',
            'cost' => '1000',
        ])->assertSessionHasNoErrors();

    expect(DamageReport::where('booking_id', $booking->id)->count())->toBe(1);
});
