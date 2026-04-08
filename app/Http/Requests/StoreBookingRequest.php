<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'customer';
    }

    public function rules(): array
    {
        return [
            'car_id' => 'required|integer|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'promo_code' => 'nullable|string|exists:promo_codes,code',
        ];
    }

    public function messages(): array
    {
        return [
            'car_id.exists' => 'The selected car does not exist.',
            'start_date.after_or_equal' => 'Start date cannot be in the past.',
            'end_date.after' => 'End date must be after start date.',
        ];
    }
}
