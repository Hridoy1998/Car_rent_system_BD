<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Car;
use App\Models\DamageReport;
use App\Models\Earning;
use App\Models\Favorite;
use App\Models\Message;
use App\Models\Notification;
use App\Models\PromoCode;
use App\Models\Review;
use App\Models\User;
use App\Models\UserReview;
use App\Models\Verification;
use Illuminate\Database\Seeder;

class DemoHubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $owners = User::where('role', 'owner')->get();
        $cars = Car::all();

        if ($customers->isEmpty() || $owners->isEmpty() || $cars->isEmpty()) {
            return;
        }

        // 1. Verifications
        User::all()->each(function ($user) {
            Verification::factory()->create([
                'user_id' => $user->id,
                'status' => 'approved',
            ]);
        });

        // 2. Promo Codes
        PromoCode::factory(10)->create();

        // 3. Bookings distributed across cars and customers over the last 6 months
        $cars->each(function ($car) use ($customers) {
            // Create 5-8 bookings per car to ensure thick data
            for ($i = 0; $i < rand(5, 8); $i++) {
                $createdAt = now()->subDays(rand(1, 180));
                Booking::factory()->create([
                    'car_id' => $car->id,
                    'user_id' => $customers->random()->id,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }
        });

        // 4. Data derived from Bookings
        Booking::all()->each(function ($booking) {
            $createdAt = $booking->created_at;

            // If completed, add reviews and earnings
            if ($booking->status === 'completed') {
                // Car Review
                Review::factory()->create([
                    'car_id' => $booking->car_id,
                    'user_id' => $booking->user_id,
                    'created_at' => $createdAt,
                ]);

                // User Reviews (Both ways with safety check)
                // Customer reviews Owner
                UserReview::updateOrCreate(
                    ['reviewer_id' => $booking->user_id, 'booking_id' => $booking->id],
                    [
                        'reviewee_id' => $booking->car->user_id,
                        'rating' => rand(4, 5),
                        'comment' => 'Exceptional owner. Asset handover was flawless.',
                        'created_at' => $createdAt,
                    ]
                );

                // Owner reviews Customer
                UserReview::updateOrCreate(
                    ['reviewer_id' => $booking->car->user_id, 'booking_id' => $booking->id],
                    [
                        'reviewee_id' => $booking->user_id,
                        'rating' => rand(4, 5),
                        'comment' => 'Responsible operator. Adhered to all sector protocols.',
                        'created_at' => $createdAt,
                    ]
                );

                // Earnings
                Earning::factory()->create([
                    'booking_id' => $booking->id,
                    'owner_id' => $booking->car->user_id,
                    'amount' => $booking->total_price * 0.9, // 90% to owner
                    'platform_fee' => $booking->total_price * 0.1, // 10% platform fee
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            // Casual damage report for 10% of bookings
            if (rand(1, 10) === 1) {
                DamageReport::factory()->create([
                    'booking_id' => $booking->id,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            // Messages for every booking
            Message::factory(rand(2, 6))->create([
                'booking_id' => $booking->id,
                'sender_id' => $booking->user_id,
                'receiver_id' => $booking->car->user_id,
                'created_at' => $createdAt,
            ]);
        });

        // 5. Global Notifications and Favorites
        $customers->each(function ($customer) use ($cars) {
            Notification::factory(rand(3, 8))->create([
                'notifiable_id' => $customer->id,
                'notifiable_type' => 'App\Models\User',
            ]);

            // Favorite 2-4 cars
            $cars->random(rand(2, 4))->each(function ($car) use ($customer) {
                Favorite::firstOrCreate([
                    'user_id' => $customer->id,
                    'car_id' => $car->id,
                ]);
            });
        });

        $owners->each(function ($owner) {
            Notification::factory(rand(5, 12))->create([
                'notifiable_id' => $owner->id,
                'notifiable_type' => 'App\Models\User',
            ]);
        });
    }
}
