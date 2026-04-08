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
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

