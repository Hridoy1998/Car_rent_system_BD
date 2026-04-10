<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Earning;
use App\Models\Setting;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function index(Request $request)
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

        $query = Booking::with(['customer', 'car.owner'])
            ->where('payment_status', 'paid');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('customer', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('car.owner', fn ($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        $transactions = $query->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.finance.index', compact('stats', 'transactions'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['customer', 'car.owner', 'earnings', 'damageReports']);
        
        $commissionPercent = Setting::where('key', 'platform_commission')->first()->value ?? 10;
        $platformFee = ($booking->total_price * $commissionPercent) / 100;
        $hostEarning = $booking->total_price - $platformFee;

        return view('admin.finance.show', compact('booking', 'platformFee', 'hostEarning', 'commissionPercent'));
    }
}
