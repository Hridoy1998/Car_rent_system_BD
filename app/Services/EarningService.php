<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Earning;
use App\Models\Setting;

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

        // Fetch commission setting (Percentage)
        $commissionPercent = Setting::where('key', 'platform_commission')->first()->value ?? 10;
        $platformCut = ($booking->total_price * $commissionPercent) / 100;
        $hostEarning = $booking->total_price - $platformCut;

        // Prevent duplicate earnings for the same booking
        Earning::firstOrCreate(
            ['booking_id' => $booking->id],
            [
                'owner_id' => $booking->car->user_id,
                'amount' => $hostEarning,
                'platform_fee' => $platformCut,
            ]
        );
    }
}
