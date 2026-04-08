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
        
        $query = Car::where('status', 'approved')->with(['images', 'reviews']);
        
        if ($location) {
            $query->where(function($q) use ($location) {
                $q->where('location', 'like', "%{$location}%")
                  ->orWhere('brand', 'like', "%{$location}%")
                  ->orWhere('title', 'like', "%{$location}%");
            });
        }
        
        $cars = $query->latest()->paginate(12);
        
        return view('search.index', compact('cars', 'location'));
    }
}
