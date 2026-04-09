<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\DamageReport;

class IntegrityController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. All breaches associated with owner's fleet
        $breaches = DamageReport::whereHas('booking.car', fn ($q) => $q->where('user_id', $user->id))
            ->with(['booking.customer', 'booking.car.images'])
            ->latest()
            ->paginate(10);

        // 2. Critical Breaches (Disputed or Pending)
        $criticalBreaches = DamageReport::whereHas('booking.car', fn ($q) => $q->where('user_id', $user->id))
            ->whereIn('status', ['pending', 'disputed'])
            ->with(['booking.customer', 'booking.car'])
            ->get();

        return view('owner.integrity.index', compact('breaches', 'criticalBreaches'));
    }
}
