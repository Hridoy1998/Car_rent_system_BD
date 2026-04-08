<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Earning extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'booking_id', 'amount'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}

