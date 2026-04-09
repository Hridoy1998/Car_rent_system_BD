<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        $car = $this->route('car');

        return auth()->check()
            && ($car->user_id === auth()->id() || auth()->user()->role === 'admin');
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'brand' => 'sometimes|required|string|max:100',
            'model' => 'sometimes|required|string|max:100',
            'year' => 'sometimes|required|integer|min:1990|max:'.(date('Y') + 1),
            'type' => 'sometimes|required|in:SUV,Sedan,Hatchback,Van,Other',
            'color' => 'nullable|string|max:50',
            'license_plate' => 'sometimes|required|string|max:50|unique:cars,license_plate,'.$this->route('car')?->id,
            'transmission' => 'sometimes|required|in:Manual,Auto',
            'fuel_type' => 'sometimes|required|string|max:50',
            'seats' => 'nullable|integer|min:1|max:20',
            'price_per_day' => 'sometimes|required|numeric|min:100',
            'price_per_month' => 'sometimes|required|numeric|min:1000',
            'location' => 'sometimes|required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'engine_capacity' => 'nullable|string|max:100',
            'fuel_policy' => 'nullable|string|max:255',
            'insurance_info' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:5000',
            'edit_reason' => auth()->user()->role === 'owner' ? 'required|string|max:1000' : 'nullable|string|max:1000',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ];
    }
}
