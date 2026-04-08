<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'brand',
        'model',
        'year',
        'type',
        'transmission',
        'fuel_type',
        'price_per_day',
        'price_per_month',
        'location',
        'latitude',
        'longitude',
        'description',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getIsAvailableAttribute()
    {
        if ($this->status !== 'approved') {
            return false;
        }

        $today = now()->startOfDay();
        return !$this->bookings()
            ->whereIn('status', ['pending', 'approved'])
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->exists();
    }
}
