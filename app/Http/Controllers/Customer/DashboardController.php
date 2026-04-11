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
            ->with('car')
            ->get();
        foreach ($pendingPayments as $b) {
            $actionQueue[] = [
                'type' => 'PAYMENT',
                'title' => 'Settlement Required',
                'desc' => "Finalize payment protocol for deployment: {$b->car->brand} {$b->car->model}",
                'link' => route('customer.bookings.checkout', $b), // Direct to checkout
                'priority' => 'high',
            ];
        }

        // B. Integrity Breach Responses
        $disputes = $user->bookings()->whereHas('damageReports', function ($q) {
            $q->where('status', 'pending');
        })->with(['damageReports', 'car'])->get();
        foreach ($disputes as $b) {
            foreach ($b->damageReports->where('status', 'pending') as $dr) {
                $actionQueue[] = [
                    'type' => 'BREACH',
                    'title' => 'Integrity Breach Defense',
                    'desc' => "Host logged breach for #BR-{$dr->id}. Tactical response required.",
                    'link' => route('customer.bookings.show', $b), // Respond in booking details
                    'priority' => 'critical',
                ];
            }
        }

        // C. Upcoming Handovers
        $upcoming = Booking::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('payment_status', 'paid')
            ->where('start_date', '>=', now())
            ->where('start_date', '<=', now()->addDays(2))
            ->with('car')
            ->get();
        foreach($upcoming as $b) {
            $actionQueue[] = [
                'type' => 'LOGISTICS',
                'title' => 'Deployment Imminent',
                'desc' => "Asset handover scheduled in " . \Carbon\Carbon::parse($b->start_date)->diffForHumans() . ".",
                'link' => route('customer.bookings.show', $b),
                'priority' => 'medium',
            ];
        }

        // D. Identity Verification Protocol
        if (!$verification || $verification->status === 'rejected') {
            $actionQueue[] = [
                'type' => 'VERIFICATION',
                'title' => 'Identity Protocol Required',
                'desc' => $verification ? 'Previous verification was rejected. Re-upload credentials for audit.' : 'Complete identity verification to unlock booking privileges.',
                'link' => route('customer.verifications.index'),
                'priority' => 'critical',
            ];
        } elseif ($verification->status === 'pending') {
            $actionQueue[] = [
                'type' => 'VERIFICATION',
                'title' => 'Verification Pending',
                'desc' => 'Admin is reviewing your credentials. Deployment access pending.',
                'link' => route('customer.verifications.index'),
                'priority' => 'medium',
            ];
        }

        // 4. Reputation Shield
        $reputation = [
            'avg_rating' => UserReview::where('reviewee_id', $user->id)->avg('rating') ?: 0,
            'review_count' => UserReview::where('reviewee_id', $user->id)->count(),
        ];

        // 5. Fiscal Pulse (Spending Analytics - Last 6 months)
        $fiscalPulse = collect(range(0, 5))->mapWithKeys(function ($i) use ($user) {
            $date = now()->subMonths($i);
            $month = $date->month;
            $sum = Booking::where('user_id', $user->id)
                ->where('payment_status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $month)
                ->sum('total_price');
            return [$month => $sum];
        })->reverse()->toArray();

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
