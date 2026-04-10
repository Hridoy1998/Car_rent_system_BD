<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DamageReport;
use App\Models\Earning;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_cars' => $user->cars()->count(),
            'approved_cars' => $user->cars()->where('status', 'approved')->count(),
            'pending_cars' => $user->cars()->where('status', 'pending')->count(),
            'active_bookings' => Booking::whereHas('car', fn ($q) => $q->where('user_id', $user->id))
                ->whereIn('status', ['pending', 'approved', 'ongoing', 'returned'])
                ->count(),
            'total_earnings' => Earning::where('owner_id', $user->id)->sum('amount'),
            'pending_damages' => DamageReport::whereHas('booking.car', fn ($q) => $q->where('user_id', $user->id))
                ->where('status', 'pending')
                ->count(),
            'revenue_24h' => Earning::where('owner_id', $user->id)
                ->where('created_at', '>=', now()->subDay())
                ->sum('amount'),
            'monthly_earnings' => collect(range(0, 5))->mapWithKeys(function ($i) use ($user) {
                $date = now()->subMonths($i);
                $month = $date->month;
                $sum = Earning::where('owner_id', $user->id)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $month)
                    ->sum('amount');
                return [$month => $sum];
            })->reverse()->toArray(),
        ];

        $recentCars = $user->cars()->with('images')->latest()->take(4)->get();

        $actionQueue = Booking::with('customer', 'car')
            ->whereHas('car', fn ($q) => $q->where('user_id', $user->id))
            ->whereIn('status', ['pending', 'approved', 'ongoing', 'returned'])
            ->latest()
            ->take(6)
            ->get();

        return view('owner.dashboard', compact('stats', 'recentCars', 'actionQueue'));
    }
}
