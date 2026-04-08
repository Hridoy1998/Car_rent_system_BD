<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'profile_photo', 'is_verified', 'is_blocked'];

    public function cars()
    {
        return $this->hasMany(Car::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
