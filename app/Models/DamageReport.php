<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DamageReport extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'description', 'image', 'cost'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}

