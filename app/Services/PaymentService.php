<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    /**
     * Simulate a payment gateway charge.
     */
    public function processPayment(Booking $booking): bool
    {
        // Simulation: Here we would call Stripe/SSLCommerz API
        // For now, we simulate a successful transaction 95% of the time

        return DB::transaction(function () use ($booking) {
            if ($booking->payment_status === 'paid') {
                return true;
            }

            // Mark as paid
            $booking->update([
                'payment_status' => 'paid',
            ]);

            return true;
        });
    }

    /**
     * Simulate a refund process.
     */
    public function processRefund(Booking $booking, float $amount): bool
    {
        // Simulation: Refund through gateway
        return true;
    }
}
