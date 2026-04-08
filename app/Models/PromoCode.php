<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount_type', 'discount_value', 'expiry_date'];

    protected function casts(): array
    {
        return [
            'expiry_date' => 'date',
            'discount_value' => 'decimal:2',
        ];
    }

    public function isValid(): bool
    {
        return Carbon::parse($this->expiry_date)->gte(today());
    }
}
