<?php

namespace App\Models;

use App\Traits\HasObfuscatedId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory, HasObfuscatedId;

    protected $fillable = [
        'user_id',
        'title',
        'brand',
        'model',
        'year',
        'type',
        'transmission',
        'fuel_type',
        'license_plate',
        'color',
        'seats',
        'price_per_day',
        'price_per_month',
        'location',
        'latitude',
        'longitude',
        'description',
        'status',
        'engine_capacity',
        'fuel_policy',
        'insurance_info',
        'features',
        'last_edit_reason',
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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavoritedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function scopeActiveOwner($query)
    {
        return $query->whereHas('owner', function ($q) {
            $q->where('is_blocked', false);
        });
    }

    public function scopeAvailable($query, $startDate = null, $endDate = null)
    {
        $startDate = $startDate ?? now()->toDateString();
        $endDate = $endDate ?? now()->addDay()->toDateString();

        return $query->where('status', 'approved')
            ->activeOwner()
            ->whereDoesntHave('bookings', function ($q) use ($startDate, $endDate) {
                $q->whereNotIn('status', ['cancelled', 'rejected', 'completed'])
                    ->where(function ($sq) use ($startDate, $endDate) {
                        // Conventional Date Overlap
                        $sq->where(function ($ssq) use ($startDate) {
                            $ssq->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $startDate);
                        })->orWhere(function ($ssq) use ($endDate) {
                            $ssq->where('start_date', '<=', $endDate)
                                ->where('end_date', '>=', $endDate);
                        })->orWhere(function ($ssq) use ($startDate, $endDate) {
                            $ssq->where('start_date', '>=', $startDate)
                                ->where('end_date', '<=', $endDate);
                        })->orWhere(function ($ssq) use ($startDate) {
                            // Operational Hardening: If status is ongoing/returning/returned,
                            // it blocks everything from NOW until its end_date.
                            $ssq->whereIn('status', ['ongoing', 'returning', 'returned'])
                                ->where('end_date', '>=', $startDate);
                        });
                    });
            });
    }

    public function getIsAvailableAttribute()
    {
        if ($this->status !== 'approved') {
            return false;
        }

        $today = now()->startOfDay()->toDateString();
        $isOccupied = $this->bookings()
            ->whereNotIn('status', ['cancelled', 'rejected', 'completed'])
            ->where(function ($q) use ($today) {
                $q->where(function ($sq) use ($today) {
                    $sq->where('start_date', '<=', $today)
                        ->where('end_date', '>=', $today);
                })->orWhere(function ($sq) {
                    $sq->whereIn('status', ['ongoing', 'returning', 'returned']);
                });
            })
            ->exists();

        return ! $isOccupied;
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        $primary = $this->images()->where('is_primary', true)->first();

        if (! $primary && $this->images()->exists()) {
            $primary = $this->images()->first();
        }

        if ($primary) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($primary->image_path);
        }

        return 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&q=80&w=800'; // Sleek dark car fallback
    }

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'price_per_day' => 'decimal:2',
            'price_per_month' => 'decimal:2',
        ];
    }
}
