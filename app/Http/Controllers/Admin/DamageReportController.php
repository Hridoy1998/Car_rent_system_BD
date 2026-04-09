<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DamageReport;
use Illuminate\Http\Request;

class DamageReportController extends Controller
{
    public function resolve(Request $request, DamageReport $damageReport)
    {
        $validated = $request->validate([
            'resolution_cost' => 'required|numeric|min:0',
            'admin_notes' => 'required|string|max:2000',
        ]);

        $damageReport->update([
            'resolution_cost' => $validated['resolution_cost'],
            'admin_notes' => $validated['admin_notes'],
            'status' => 'resolved',
        ]);

        return back()->with('success', 'Damage dispute resolved successfully.');
    }
}
