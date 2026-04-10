<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\DamageReport;
use Illuminate\Http\Request;

class IntegrityController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = DamageReport::whereHas('booking.car', fn ($q) => $q->where('user_id', $user->id))
            ->with(['booking.customer', 'booking.car.images']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('booking.car', fn ($c) => $c->where('brand', 'like', "%{$search}%"))
                    ->orWhereHas('booking.customer', fn ($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        $breaches = $query->latest()->paginate(10)->withQueryString();

        return view('owner.integrity.index', compact('breaches'));
    }

    public function show(DamageReport $damageReport)
    {
        abort_if($damageReport->booking->car->user_id !== auth()->id(), 403);
        $damageReport->load(['booking.customer', 'booking.car.images', 'booking.messages']);
        return view('owner.integrity.show', compact('damageReport'));
    }
}
