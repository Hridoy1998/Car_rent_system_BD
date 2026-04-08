<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = auth()->user()->cars()->latest()->get();
        return view('owner.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required|in:SUV,Sedan,Hatchback,Van,Other',
            'transmission' => 'required|in:Manual,Auto',
            'fuel_type' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_month' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $car = auth()->user()->cars()->create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image_path' => $path,
                    'is_primary' => false, // Will setup primary if it's the first one, let's just default to false for now, or true for the first
                ]);
            }
            // Make the first image primary
            if ($firstImage = $car->images()->first()) {
                $firstImage->update(['is_primary' => true]);
            }
        }

        return redirect()->route('owner.cars.index')->with('success', 'Car listed successfully and is pending approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        if ($car->user_id !== auth()->id()) abort(403);
        return view('owner.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        if ($car->user_id !== auth()->id()) abort(403);
        return view('owner.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        if ($car->user_id !== auth()->id()) abort(403);
        // Add basic update logic
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required|in:SUV,Sedan,Hatchback,Van,Other',
            'transmission' => 'required|in:Manual,Auto',
            'fuel_type' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_month' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $car->update($validated);
        return redirect()->route('owner.cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->user_id !== auth()->id()) abort(403);
        $car->delete();
        return redirect()->route('owner.cars.index')->with('success', 'Car removed successfully.');
    }
}
