<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DamageReport;
use Illuminate\Http\Request;

class DamageReportController extends Controller
{
    public function index(Request $request)
    {
        $query = DamageReport::with(['booking.customer', 'booking.car']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhereHas('booking.customer', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('booking.car', fn ($c) => $c->where('brand', 'like', "%{$search}%"));
            });
        }

        $breaches = $query->latest()->paginate(15)->withQueryString();

        return view('admin.damage-reports.index', compact('breaches'));
    }

    public function show(DamageReport $damageReport)
    {
        $damageReport->load(['booking.customer', 'booking.car.owner', 'booking.messages']);
        return view('admin.damage-reports.show', compact('damageReport'));
    }

    public function resolve(Request $request, DamageReport $damageReport)
    {
        $validated = $request->validate([
            'resolution_cost' => 'required|numeric|min:0',
            'admin_notes' => 'required|string|max:2000',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($damageReport, $validated) {
            $damageReport->update([
                'resolution_cost' => $validated['resolution_cost'],
                'admin_notes' => $validated['admin_notes'],
                'status' => 'resolved',
            ]);

            if ($validated['resolution_cost'] > 0) {
                $damageReport->booking->increment('total_price', $validated['resolution_cost']);
            }
        });

        return back()->with('success', 'Damage dispute resolved. Financial artifacts adjusted.');
    }
}
