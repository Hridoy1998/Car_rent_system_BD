<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DamageReport;
use Illuminate\Http\Request;

class DamageReportController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        if ($booking->car->user_id !== auth()->id() || $booking->status !== 'completed') {
            abort(403);
        }

        $request->validate([
            'description' => 'required|string|max:2000',
            'cost' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:5120',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('damages', 'public');
        }

        DamageReport::create([
            'booking_id' => $booking->id,
            'description' => $request->description,
            'cost' => $request->cost,
            'image' => $path,
        ]);

        return back()->with('success', 'Damage report filed successfully.');
    }
}
