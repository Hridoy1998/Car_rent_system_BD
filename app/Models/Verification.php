<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'document_type', 'id_number', 'document_file', 'status'];

    public function getDocumentFileUrlAttribute(): string
    {
        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->document_file);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
