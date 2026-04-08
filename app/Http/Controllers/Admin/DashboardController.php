<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\Verification;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending_cars' => Car::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'blocked_users' => User::where('is_blocked', true)->count(),
            'pending_verifications' => Verification::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
