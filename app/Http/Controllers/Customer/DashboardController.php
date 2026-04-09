<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Verification;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $verification = Verification::where('user_id', $user->id)
            ->latest()
            ->first();

        $stats = [
            'total_bookings' => Booking::where('user_id', $user->id)->count(),
            'active_bookings' => Booking::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'approved'])
                ->count(),
            'completed_bookings' => Booking::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count(),
        ];

        $latestBooking = Booking::with('car.images')
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        return view('customer.dashboard', compact('verification', 'stats', 'latestBooking'));
    }
}
