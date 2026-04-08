<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCars = Car::where('status', 'approved')
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
        
        $query = Car::where('status', 'approved')->with(['images', 'reviews']);
        
        if ($location) {
            $query->where(function($q) use ($location) {
                $q->where('location', 'like', "%{$location}%")
                  ->orWhere('brand', 'like', "%{$location}%")
                  ->orWhere('title', 'like', "%{$location}%");
            });
        }
        
        if ($startDate && $endDate) {
            $query->whereDoesntHave('bookings', function ($q) use ($startDate, $endDate) {
                $q->whereIn('status', ['pending', 'approved'])
                  ->where(function ($q2) use ($startDate, $endDate) {
                      $q2->whereBetween('start_date', [$startDate, $endDate])
                         ->orWhereBetween('end_date', [$startDate, $endDate])
                         ->orWhere(function ($q3) use ($startDate, $endDate) {
                             $q3->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                         });
                  });
            });
        }
        
        $cars = $query->latest()->paginate(12)->withQueryString();
        
        return view('search.index', compact('cars', 'location'));
    }
}
