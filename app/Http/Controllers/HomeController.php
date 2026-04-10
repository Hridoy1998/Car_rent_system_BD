<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCars = Car::available()
            ->with(['images', 'owner', 'reviews'])
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact('featuredCars'));
    }

    public function show(Car $car)
    {
        $car->load(['images', 'owner', 'reviews']);

        return view('cars.show', compact('car'));
    }

    public function search(Request $request)
    {
        $location = $request->input('location');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Car::available($startDate, $endDate)->with(['images', 'owner', 'reviews'])->withAvg('reviews', 'rating');

        if ($location) {
            $query->where(function ($q) use ($location) {
                $q->where('location', 'like', "%{$location}%")
                    ->orWhere('brand', 'like', "%{$location}%")
                    ->orWhere('title', 'like', "%{$location}%");
            });
        }

        $cars = $query->latest()->paginate(12)->withQueryString();

        return view('search.index', compact('cars', 'location'));
    }
}
