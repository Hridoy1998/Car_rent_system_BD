<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Earning;
use App\Models\User;
use App\Models\Verification;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending_cars_count' => Car::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'blocked_users' => User::where('is_blocked', true)->count(),
            'pending_verifications_count' => Verification::where('status', 'pending')->count(),
            'total_bookings' => Booking::count(),
            'active_bookings' => Booking::whereIn('status', ['pending', 'approved'])->count(),
            'total_revenue' => Earning::sum('amount'),
            'monthly_revenue' => Earning::selectRaw('SUM(amount) as sum, MONTH(created_at) as month')
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('sum', 'month')
                ->toArray(),
        ];

        $recentBookings = Booking::with(['customer', 'car'])
            ->latest()
            ->limit(8)
            ->get();

        $pendingCars = Car::with('owner')
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        $pendingVerifications = Verification::with('user')
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'pendingCars', 'pendingVerifications'));
    }
}
