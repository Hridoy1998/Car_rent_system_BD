<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingRequested extends Notification
{
    use Queueable;

    public function __construct(public Booking $booking) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'title' => 'New Booking Request',
            'message' => "{$this->booking->customer->name} requested a booking for {$this->booking->car->title}.",
            'action_url' => route('owner.bookings.index'),
        ];
    }
}
