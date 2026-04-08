<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount_type', 'discount_value', 'expiry_date'];
}

