<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Earning;

class FinanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $earnings = Earning::where('owner_id', $user->id)
            ->with('booking.car')
            ->latest()
            ->paginate(15);

        $stats = [
            'total_gross' => $earnings->sum('amount') + $earnings->sum('platform_fee'),
            'total_net' => $earnings->sum('amount'),
            'total_fees' => $earnings->sum('platform_fee'),
            'pending_settlement' => $user->cars()
                ->whereHas('bookings', fn ($q) => $q->where('status', 'ongoing'))
                ->withSum(['bookings as projected' => fn ($q) => $q->where('status', 'ongoing')], 'total_price')
                ->get()
                ->sum('projected'),
        ];

        return view('owner.finance.index', compact('earnings', 'stats'));
    }
}
