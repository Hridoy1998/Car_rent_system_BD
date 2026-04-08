<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        $cars = Car::where('status', $status)->with('owner', 'images')->latest()->paginate(10);
        return view('admin.cars.index', compact('cars', 'status'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected'
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
