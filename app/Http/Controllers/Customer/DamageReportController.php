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

        $updateData = ['status' => $validated['status']];

        // If we had a customer_notes field in the migration, we'd use it.
        // For now, let's just update the status as per the plan.

        $damageReport->update($updateData);

        $msg = $validated['status'] === 'acknowledged'
            ? 'Damage report acknowledged. Thank you.'
            : 'Damage report disputed. An admin will review the evidence.';

        return back()->with('success', $msg);
    }
}
