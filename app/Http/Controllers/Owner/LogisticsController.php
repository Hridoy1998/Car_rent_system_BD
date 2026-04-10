<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class LogisticsController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Booking::whereHas('car', fn ($q) => $q->where('user_id', $user->id));

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('car', fn ($c) => $c->where('brand', 'like', "%{$search}%"))
                    ->orWhereHas('customer', fn ($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        // 1. Upcoming Handovers
        $upcomingHandovers = (clone $query)->where('status', 'approved')
            ->where('start_date', '>=', now())
            ->where('start_date', '<=', now()->addDays(7))
            ->with(['customer.verifications', 'car.images'])
            ->orderBy('start_date')
            ->get();

        // 2. Active Returns
        $activeReturns = (clone $query)->where('status', 'ongoing')
            ->where('end_date', '<=', now()->addDays(2))
            ->with(['customer', 'car.images'])
            ->orderBy('end_date')
            ->get();

        // 3. Operational Timeline
        $timeline = $query->whereIn('status', ['approved', 'ongoing', 'returned'])
            ->with(['customer', 'car'])
            ->latest()
            ->limit(15)
            ->get();

        return view('owner.logistics.index', compact('upcomingHandovers', 'activeReturns', 'timeline'));
    }

    public function show(Booking $booking)
    {
        abort_if($booking->car->user_id !== auth()->id(), 403);
        $booking->load(['customer.verifications', 'car.images', 'messages']);
        return view('owner.logistics.show', compact('booking'));
    }
}
