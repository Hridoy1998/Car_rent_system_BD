<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle(Car $car)
    {
        $user = auth()->user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('car_id', $car->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $msg = 'Asset removed from tactical wishlist.';
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'car_id' => $car->id,
            ]);
            $msg = 'Asset deployed to wishlist.';
        }

        return back()->with('success', $msg);
    }
}
