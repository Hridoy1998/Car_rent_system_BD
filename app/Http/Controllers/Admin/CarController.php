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

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $car->update(['status' => $validated['status']]);

        return back()->with('success', "Car {$validated['status']} successfully.");
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Listing deleted securely by Admin.');
    }
}
