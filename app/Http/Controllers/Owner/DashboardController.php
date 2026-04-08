<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = auth()->user()->cars()->count();
        $pendingCars = auth()->user()->cars()->where('status', 'pending')->count();
        $activeBookings = 0; // Placeholder for Phase 2
        $totalEarnings = 0; // Placeholder for Phase 2
        
        $recentCars = auth()->user()->cars()->latest()->take(3)->get();

        return view('owner.dashboard', compact('totalCars', 'pendingCars', 'activeBookings', 'totalEarnings', 'recentCars'));
    }
}
