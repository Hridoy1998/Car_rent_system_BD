<?php

namespace App\Models;

use App\Events\NotificationCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($notification) {
            broadcast(new NotificationCreated($notification))->toOthers();
        });
    }
}
