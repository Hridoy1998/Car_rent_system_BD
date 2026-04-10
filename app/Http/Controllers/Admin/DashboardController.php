<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\DamageReport;
use App\Models\Earning;
use App\Models\Setting;
use App\Models\User;
use App\Models\Verification;

class DashboardController extends Controller
{
    public function index()
    {
        // Enforce default commission if missing
        Setting::firstOrCreate(['key' => 'platform_commission'], [
            'value' => '10',
            'description' => 'Platform commission percentage on every booking.',
        ]);

        $totalBookings = Booking::count();
        $completedBookings = Booking::where('status', 'completed')->count();

        $stats = [
            'pending_cars_count' => Car::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'blocked_users' => User::where('is_blocked', true)->count(),
            'pending_verifications_count' => Verification::where('status', 'pending')->count(),
            'pending_damages_count' => DamageReport::where('status', 'disputed')->count(),
            'total_bookings' => $totalBookings,
            'active_bookings' => Booking::whereIn('status', ['pending', 'approved'])->count(),
            'success_rate' => $totalBookings > 0 ? round(($completedBookings / $totalBookings) * 100, 1) : 0,

            'settled_revenue' => Earning::sum('amount'),
            'projected_revenue' => Booking::whereIn('status', ['approved', 'completed'])
                ->where('payment_status', 'paid')
                ->sum('total_price'),

            'velocity_24h' => [
                'users' => User::where('created_at', '>=', now()->subDay())->count(),
                'cars' => Car::where('created_at', '>=', now()->subDay())->count(),
                'bookings' => Booking::where('created_at', '>=', now()->subDay())->count(),
            ],

            'monthly_revenue' => collect(range(0, 5))->mapWithKeys(function ($i) {
                $date = now()->subMonths($i);
                $month = $date->month;
                $sum = Earning::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $month)
                    ->sum(\DB::raw('amount + platform_fee'));
                return [$month => $sum];
            })->reverse()->toArray(),
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
