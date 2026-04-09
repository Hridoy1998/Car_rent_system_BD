<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class BookingService
{
    /**
     * Validate and calculate booking costs.
     */
    public function calculateTotal(Car $car, string $startDate, string $endDate): float
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        if ($start->isPast() && ! $start->isToday()) {
            throw ValidationException::withMessages(['start_date' => 'Start date cannot be in the past.']);
        }

        if ($end->lessThan($start)) {
            throw ValidationException::withMessages(['end_date' => 'End date must be after start date.']);
        }

        $days = $start->diffInDays($end) ?: 1;
        $months = floor($days / 30);
        $remainingDays = $days % 30;

        $totalPrice = ($months * $car->price_per_month) + ($remainingDays * $car->price_per_day);

        return $totalPrice;
    }

    /**
     * Strict check for overlapping bookings.
     */
    public function checkOverlap(int $carId, string $startDate, string $endDate, ?int $ignoreBookingId = null): bool
    {
        return Booking::where('car_id', $carId)
            ->whereNotIn('status', ['cancelled', 'rejected', 'completed'])
            ->when($ignoreBookingId, function ($query) use ($ignoreBookingId) {
                return $query->where('id', '!=', $ignoreBookingId);
            })
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();
    }

    /**
     * Calculate refundable amount based on 24h rule.
     */
    public function calculateRefund(Booking $booking): float
    {
        $start = Carbon::parse($booking->start_date);
        $now = now();

        if ($now->diffInHours($start, false) >= 24) {
            return (float) $booking->total_price; // Full refund
        }

        return (float) ($booking->total_price * 0.5); // Partial refund (50%)
    }
}
