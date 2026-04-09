<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class LogisticsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. Upcoming Handovers (Approved bookings starting in the next 7 days)
        $upcomingHandovers = Booking::whereHas('car', fn ($q) => $q->where('user_id', $user->id))
            ->where('status', 'approved')
            ->where('start_date', '>=', now())
            ->where('start_date', '<=', now()->addDays(7))
            ->with(['customer.verifications', 'car.images'])
            ->orderBy('start_date')
            ->get();

        // 2. Active Returns (Ongoing bookings ending in the next 48 hours)
        $activeReturns = Booking::whereHas('car', fn ($q) => $q->where('user_id', $user->id))
            ->where('status', 'ongoing')
            ->where('end_date', '<=', now()->addDays(2))
            ->with(['customer', 'car.images'])
            ->orderBy('end_date')
            ->get();

        // 3. Operational Timeline
        $timeline = Booking::whereHas('car', fn ($q) => $q->where('user_id', $user->id))
            ->whereIn('status', ['approved', 'ongoing', 'returned'])
            ->with(['customer', 'car'])
            ->latest()
            ->limit(15)
            ->get();

        return view('owner.logistics.index', compact('upcomingHandovers', 'activeReturns', 'timeline'));
    }
}
