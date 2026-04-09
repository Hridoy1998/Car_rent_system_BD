<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Earning;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'total_cars' => $user->cars()->count(),
            'approved_cars' => $user->cars()->where('status', 'approved')->count(),
            'pending_cars' => $user->cars()->where('status', 'pending')->count(),
            'active_bookings' => Booking::whereHas('car', fn($q) => $q->where('user_id', $user->id))
                ->whereIn('status', ['pending', 'approved'])
                ->count(),
            'total_earnings' => Earning::where('owner_id', $user->id)->sum('amount'),
        ];
        
        $recentCars = $user->cars()->with('images')->latest()->take(3)->get();
        
        $recentBookings = Booking::with('customer', 'car')
            ->whereHas('car', fn($q) => $q->where('user_id', $user->id))
            ->latest()
            ->take(5)
            ->get();

        return view('owner.dashboard', compact('stats', 'recentCars', 'recentBookings'));
    }
}
