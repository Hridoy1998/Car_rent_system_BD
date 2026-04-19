<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Earning;
use App\Models\Setting;

class EarningService
{
    /**
     * Settle or update earnings for an owner.
     */
    public function settleOrUpdate(Booking $booking): void
    {
        if ($booking->payment_status !== 'paid') {
            return;
        }

        // Fetch commission setting (Percentage)
        $commissionPercent = Setting::where('key', 'platform_commission')->first()->value ?? 10;
        $platformCut = ($booking->total_price * $commissionPercent) / 100;
        $hostEarning = $booking->total_price - $platformCut;

        Earning::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'owner_id' => $booking->car->user_id,
                'amount' => $hostEarning,
                'platform_fee' => $platformCut,
            ]
        );
    }
}
