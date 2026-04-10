<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        $query = Car::where('status', $status)->with('owner', 'images');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $cars = $query->latest()->paginate(10)->withQueryString();

        return view('admin.cars.index', compact('cars', 'status'));
    }

    public function show(Car $car)
    {
        $car->load(['owner', 'images', 'bookings', 'reviews']);

        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Handle Quick Status Authorization (Tactical Path)
        if ($request->has('status') && count($request->except(['_token', '_method'])) === 1) {
            $validated = $request->validate([
                'status' => 'required|in:pending,approved,rejected',
            ]);
            $car->update($validated);
            return back()->with('success', "Asset #{$car->id} status successfully transitioned to [{$validated['status']}].");
        }

        // Full Asset Calibration (Strategic Path)
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'type' => 'required|string|max:255',
            'transmission' => 'required|in:manual,automatic',
            'fuel_type' => 'required|string|max:255',
            'license_plate' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'seats' => 'required|integer|min:1|max:100',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_month' => 'nullable|numeric|min:0',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'engine_capacity' => 'nullable|string|max:255',
            'fuel_policy' => 'nullable|string|max:255',
            'insurance_info' => 'nullable|string',
            'features' => 'nullable|array',
            'images.*' => 'nullable|image|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:car_images,id',
        ]);

        // Handle Image Purging
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $car->images()->find($imageId);
                if ($image) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Handle New Image Ingestion
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('cars', 'public');
                $car->images()->create([
                    'image_path' => $path,
                    'is_primary' => $car->images()->count() === 0,
                ]);
            }
        }

        $car->update($validated);

        return redirect()->route('admin.cars.show', $car)->with('success', "Asset calibration for [{$car->brand} {$car->model}] has been successfully committed.");
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Listing deleted securely by Admin.');
    }
}
