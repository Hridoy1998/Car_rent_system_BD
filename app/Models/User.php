<?php

namespace App\Models;

use App\Traits\HasObfuscatedId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasObfuscatedId, Notifiable;

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'profile_photo', 'bio', 'address', 'is_verified', 'is_blocked'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_blocked' => 'boolean',
        ];
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function receivedBookings()
    {
        return $this->hasManyThrough(Booking::class, Car::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }

    public function earnings()
    {
        return $this->hasMany(Earning::class, 'owner_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function receivedReviews()
    {
        return $this->hasMany(UserReview::class, 'reviewee_id');
    }

    public function latestVerification()
    {
        return $this->hasOne(Verification::class)->latestOfMany();
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($this->profile_photo);
        }

        return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=050B1A&color=fff';
    }

    public function isVerified(): bool
    {
        return $this->verifications()->where('status', 'approved')->exists();
    }

    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
