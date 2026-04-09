<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $user = auth()->user();

        // Owner: full operational lifecycle | Customer: cancel & return request
        $allowedStatuses = match ($user?->role) {
            'owner' => 'in:approved,rejected,ongoing,returned,completed',
            'customer' => 'in:cancelled,returning',
            'admin' => 'in:approved,rejected,completed,cancelled,ongoing,returned,returning',
            default => 'in:cancelled',
        };

        return [
            'status' => 'required|string|'.$allowedStatuses,
            'start_odo' => 'nullable|integer|min:0',
            'renter_end_odo' => 'nullable|integer|min:0',
            'end_odo' => 'nullable|integer|min:0',
            'end_fuel' => 'nullable|string|in:Empty,1/4,1/2,3/4,Full',
            'inspection_notes' => 'nullable|string|max:2000',
            'inspection_image' => 'nullable|image|max:5120', // 5MB limit
            'damage_description' => 'nullable|string|max:2000',
            'damage_cost' => 'nullable|numeric|min:0',
            'damage_image' => 'nullable|image|max:5120',
        ];
    }
}
