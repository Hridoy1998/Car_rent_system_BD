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

        // Owner can approve/reject/complete - Customer can cancel
        $allowedStatuses = match ($user?->role) {
            'owner' => 'in:approved,rejected,completed',
            'customer' => 'in:cancelled',
            'admin' => 'in:approved,rejected,completed,cancelled',
            default => 'in:cancelled',
        };

        return [
            'status' => 'required|string|'.$allowedStatuses,
        ];
    }
}
