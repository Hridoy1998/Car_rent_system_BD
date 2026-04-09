<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Earning;
use App\Models\Setting;

class FinancialController extends Controller
{
    public function index()
    {
        $commissionPercent = Setting::where('key', 'platform_commission')->first()->value ?? 10;

        $settledRevenue = Earning::sum('amount');
        $platformCut = ($settledRevenue * $commissionPercent) / 100;
        $hostTotalEarning = $settledRevenue - $platformCut;

        $pendingBookings = Booking::whereIn('status', ['approved', 'completed'])
            ->where('payment_status', 'paid')
            ->get();

        $projectedVolume = $pendingBookings->sum('total_price');

        $stats = [
            'total_volume' => $settledRevenue + $projectedVolume,
            'settled_revenue' => $settledRevenue,
            'platform_cut' => $platformCut,
            'host_earnings' => $hostTotalEarning,
            'projected_volume' => $projectedVolume,
            'commission' => $commissionPercent,
        ];

        $transactions = Booking::with(['customer', 'car.owner'])
            ->where('payment_status', 'paid')
            ->latest()
            ->paginate(15);

        return view('admin.finance.index', compact('stats', 'transactions'));
    }
}
