<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DamageReport;
use Illuminate\Http\Request;

class DamageReportController extends Controller
{
    public function update(Request $request, DamageReport $damageReport)
    {
        if ($damageReport->booking->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:acknowledged,disputed',
            'customer_notes' => 'nullable|string|max:1000',
        ]);

        $damageReport->update([
            'status' => $validated['status'],
            'customer_notes' => $validated['customer_notes'] ?? null,
        ]);

        if ($validated['status'] === 'acknowledged') {
            $booking = $damageReport->booking;
            $booking->increment('total_price', $damageReport->cost);
            $msg = 'Damage report acknowledged. Fee added to final settlement.';
        } else {
            $msg = 'Damage report disputed. Admin mediation initiated.';
        }

        return back()->with('success', $msg);
    }
}
