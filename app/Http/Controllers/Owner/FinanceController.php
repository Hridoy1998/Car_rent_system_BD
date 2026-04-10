<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Earning::where('owner_id', $user->id)
            ->with(['booking.car', 'booking.customer']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('booking.car', fn ($c) => $c->where('brand', 'like', "%{$search}%"))
                    ->orWhereHas('booking.customer', fn ($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        $earnings = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total_gross' => Earning::where('owner_id', $user->id)->sum(\Illuminate\Support\Facades\DB::raw('amount + platform_fee')),
            'total_net' => Earning::where('owner_id', $user->id)->sum('amount'),
            'total_fees' => Earning::where('owner_id', $user->id)->sum('platform_fee'),
            'pending_settlement' => $user->cars()
                ->whereHas('bookings', fn ($q) => $q->where('status', 'ongoing'))
                ->withSum(['bookings as projected' => fn ($q) => $q->where('status', 'ongoing')], 'total_price')
                ->get()
                ->sum('projected'),
        ];

        return view('owner.finance.index', compact('earnings', 'stats'));
    }

    public function show(Earning $earning)
    {
        abort_if($earning->owner_id !== auth()->id(), 403);
        $earning->load(['booking.car', 'booking.customer', 'booking.damageReports']);
        return view('owner.finance.show', compact('earning'));
    }
}
