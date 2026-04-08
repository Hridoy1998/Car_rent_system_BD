<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Earning;

class EarningService
{
    /**
     * Settle earnings for an owner upon booking completion.
     */
    public function settleBooking(Booking $booking): void
    {
        if ($booking->status !== 'completed' || $booking->payment_status !== 'paid') {
            return;
        }

        // Prevent duplicate earnings for the same booking
        Earning::firstOrCreate(
            ['booking_id' => $booking->id],
            [
                'owner_id' => $booking->car->user_id,
                'amount' => $booking->total_price, // Assuming 100% goes to owner for this model
            ]
        );
    }
}
