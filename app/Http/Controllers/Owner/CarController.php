<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = auth()->user()->cars()->with('images')->latest()->paginate(10);

        return view('owner.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('owner.cars.create');
    }

    public function store(StoreCarRequest $request)
    {
        $data = $request->validated();
        $images = $data['images'] ?? null;
        unset($data['images']);

        $car = auth()->user()->cars()->create(array_merge($data, ['status' => 'pending']));

        if ($images) {
            foreach ($images as $index => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()->route('success.car');
    }

    public function show(Car $car)
    {
        $this->authorize('view', $car);
        $car->load('images', 'reviews.user', 'bookings');

        return view('owner.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $this->authorize('update', $car);

        return view('owner.cars.edit', compact('car'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $this->authorize('update', $car);

        $data = $request->validated();
        $images = $data['images'] ?? null;
        unset($data['images']);

        // Owner cannot change status directly
        if (auth()->user()->role === 'owner') {
            unset($data['status']);
        }

        $car->update($data);

        if ($images) {
            foreach ($images as $index => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('owner.cars.index')
            ->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);

        // Prevent deletion if there are active bookings
        $hasActive = $car->bookings()
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($hasActive) {
            return back()->with('error', 'Cannot delete a car with active bookings.');
        }

        $car->delete();

        return redirect()->route('owner.cars.index')
            ->with('success', 'Car removed successfully.');
    }
}
