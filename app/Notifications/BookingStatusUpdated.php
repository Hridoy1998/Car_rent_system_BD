<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusUpdated extends Notification
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
            'booking_id' => $this->booking->getRouteKey(),
            'title' => 'Booking '.ucfirst($this->booking->status),
            'message' => "Your booking for {$this->booking->car->title} has been ".$this->booking->status.'.',
            'action_url' => route('customer.bookings.index'),
        ];
    }
}
