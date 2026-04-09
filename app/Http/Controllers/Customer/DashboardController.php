<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\UserReview;
use App\Models\Verification;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $verification = Verification::where('user_id', $user->id)
            ->latest()
            ->first();

        // 1. Core Stats
        $stats = [
            'total_bookings' => Booking::where('user_id', $user->id)->count(),
            'active_bookings' => Booking::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'approved', 'ongoing', 'returned'])
                ->count(),
            'completed_bookings' => Booking::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count(),
        ];

        // 2. Active Trip Tracker
        $activeTrip = Booking::with('car.images', 'car.owner')
            ->where('user_id', $user->id)
            ->where('status', 'ongoing')
            ->first();

        // 3. Protocol Action Queue
        $actionQueue = [];

        // A. Pending Payments
        $pendingPayments = Booking::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('payment_status', 'pending')
            ->get();
        foreach ($pendingPayments as $b) {
            $actionQueue[] = [
                'type' => 'PAYMENT',
                'title' => 'Settlement Required',
                'desc' => "Finalize payment for {$b->car->brand} {$b->car->model}",
                'link' => route('customer.bookings.index'),
                'priority' => 'high',
            ];
        }

        // B. Return Confirmation Needed (Handover acknowledgment from user side? Not in current schema, but let's check for completed trips with no customer acknowledgement of return?)
        // Actually, let's use Damage Disputes as actions
        $disputes = $user->bookings()->whereHas('damageReports', function ($q) {
            $q->where('status', 'pending');
        })->with('damageReports')->get();
        foreach ($disputes as $b) {
            foreach ($b->damageReports->where('status', 'pending') as $dr) {
                $actionQueue[] = [
                    'type' => 'BREACH',
                    'title' => 'Integrity Breach Dispute',
                    'desc' => "Owner claimed damage on {$b->car->brand}. Response required.",
                    'link' => route('customer.bookings.index'),
                    'priority' => 'critical',
                ];
            }
        }

        // 4. Reputation Shield
        $reputation = [
            'avg_rating' => UserReview::where('reviewee_id', $user->id)->avg('rating') ?: 0,
            'review_count' => UserReview::where('reviewee_id', $user->id)->count(),
        ];

        // 5. Fiscal Pulse (Spending Analytics - Last 6 months)
        $fiscalPulse = Booking::selectRaw('SUM(total_price) as sum, MONTH(created_at) as month')
            ->where('user_id', $user->id)
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('sum', 'month')
            ->toArray();

        // 6. Tactical Wishlist
        $wishlist = $user->favorites()->with('car.images', 'car.owner')->latest()->limit(4)->get();

        return view('customer.dashboard', compact(
            'verification',
            'stats',
            'activeTrip',
            'actionQueue',
            'reputation',
            'fiscalPulse',
            'wishlist'
        ));
    }
}
