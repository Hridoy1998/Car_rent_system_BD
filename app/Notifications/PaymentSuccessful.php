<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PaymentSuccessful extends Notification
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
            'title' => 'Payment Successful',
            'message' => "Payment for booking #{$this->booking->id} has been confirmed.",
            'action_url' => route('customer.bookings.index'),
        ];
    }
}
