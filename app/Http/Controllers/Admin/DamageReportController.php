<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DamageReport;
use Illuminate\Http\Request;

class DamageReportController extends Controller
{
    public function index()
    {
        $breaches = DamageReport::with(['booking.customer', 'booking.car'])
            ->latest()
            ->paginate(15);

        return view('admin.damage-reports.index', compact('breaches'));
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
