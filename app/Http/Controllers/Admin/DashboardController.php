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
            'pending_cars' => Car::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'blocked_users' => User::where('is_blocked', true)->count(),
            'pending_verifications' => Verification::where('status', 'pending')->count(),
            'total_bookings' => Booking::count(),
            'active_bookings' => Booking::whereIn('status', ['pending', 'approved'])->count(),
            'total_revenue' => Earning::sum('amount'),
        ];

        $recentBookings = Booking::with(['customer', 'car'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
