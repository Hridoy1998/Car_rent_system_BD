<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'description',
        'image',
        'cost',
        'status',
        'admin_notes',
        'resolution_cost',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
