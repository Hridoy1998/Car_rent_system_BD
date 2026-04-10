<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\UserReview;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        // Calculate rating from cars owned by this user
        $avgRating = Review::whereHas('car', fn ($q) => $q->where('user_id', $user->id))
            ->avg('rating');

        $totalTripsAsHost = $user->cars()->withCount('bookings')->get()->sum('bookings_count');
        $totalTripsAsCustomer = $user->bookings()->count();

        $userReviews = UserReview::where('reviewee_id', $user->id)->with('reviewer')->latest()->get();
        $userAvgRating = $userReviews->count() > 0 ? $userReviews->avg('rating') : ($avgRating ?: 5.0);

        $stats = [
            'rating' => $userAvgRating,
            'host_trips' => $totalTripsAsHost,
            'renter_trips' => $totalTripsAsCustomer,
        ];

        $cars = $user->cars()->with('images', 'reviews')->where('status', 'approved')->latest()->take(6)->get();

        return view('profiles.show', compact('user', 'stats', 'cars', 'userReviews'));
    }
}
