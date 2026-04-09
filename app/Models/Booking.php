<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'payment_status',
        'checked_in_at',
        'returned_at',
        'start_odo',
        'renter_end_odo',
        'end_odo',
        'end_fuel',
        'inspection_notes',
        'inspection_images',
        'security_deposit_amount',
        'security_deposit_status',
        'dispute_held_at',
    ];

    /**
     * Integrity Lock Check
     * Prevents trip completion if unresolved damage disputes exist.
     */
    public function isLocked(): bool
    {
        return $this->damageReports()
            ->whereIn('status', ['pending', 'disputed'])
            ->exists();
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function damageReports()
    {
        return $this->hasMany(DamageReport::class);
    }
}

