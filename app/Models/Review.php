<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_id', 'rating', 'comment'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
