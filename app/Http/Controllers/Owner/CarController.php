<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->cars()->with('images');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $cars = $query->latest()->paginate(10)->withQueryString();

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

        if (auth()->user()->role === 'owner') {
            $data['status'] = 'pending';
            $data['last_edit_reason'] = $request->edit_reason;
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

        $msg = auth()->user()->role === 'owner'
            ? 'Strategic update submitted. Awaiting administrative authorization.'
            : 'Car updated successfully.';

        return redirect()->route('owner.cars.index')->with('success', $msg);
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
