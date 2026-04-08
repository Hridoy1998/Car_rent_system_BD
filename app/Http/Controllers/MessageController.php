<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageReceived;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Booking $booking)
    {
        $this->authorize('viewAny', [Message::class, $booking]);

        $messages = $booking->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark unread messages as seen
        $booking->messages()
            ->where('receiver_id', auth()->id())
            ->where('seen', false)
            ->update(['seen' => true]);

        return view('messages.index', compact('booking', 'messages'));
    }

    public function store(Request $request, Booking $booking)
    {
        $this->authorize('create', [Message::class, $booking]);

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userId = auth()->id();
        $receiverId = $userId === $booking->user_id
            ? $booking->car->user_id
            : $booking->user_id;

        $message = Message::create([
            'booking_id' => $booking->id,
            'sender_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'seen' => false,
        ]);

        // Notify the receiver
        $receiver = User::find($receiverId);
        $receiver?->notify(new NewMessageReceived($message->load('sender')));

        return back();
    }
}
