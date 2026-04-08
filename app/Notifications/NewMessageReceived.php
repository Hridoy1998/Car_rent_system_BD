<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageReceived extends Notification
{
    use Queueable;

    public function __construct(public Message $message) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->message->booking_id,
            'title' => 'New Message',
            'message' => "You have a new message from {$this->message->sender->name}.",
            'action_url' => route('bookings.messages.index', $this->message->booking_id),
        ];
    }
}
