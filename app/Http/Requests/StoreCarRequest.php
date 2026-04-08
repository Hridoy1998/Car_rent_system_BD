<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'owner';
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1990|max:'.(date('Y') + 1),
            'type' => 'required|in:SUV,Sedan,Hatchback,Van,Other',
            'color' => 'nullable|string|max:50',
            'license_plate' => 'required|string|max:50|unique:cars,license_plate',
            'transmission' => 'required|in:Manual,Auto',
            'fuel_type' => 'required|string|max:50',
            'seats' => 'nullable|integer|min:1|max:20',
            'price_per_day' => 'required|numeric|min:100',
            'price_per_month' => 'required|numeric|min:1000',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ];
    }

    public function messages(): array
    {
        return [
            'license_plate.unique' => 'This license plate is already registered.',
            'price_per_day.min' => 'Daily price must be at least ৳100.',
            'price_per_month.min' => 'Monthly price must be at least ৳1,000.',
        ];
    }
}
