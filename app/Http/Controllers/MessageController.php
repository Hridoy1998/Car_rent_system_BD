<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Booking $booking)
    {
        $userId = auth()->id();
        if ($booking->user_id !== $userId && $booking->car->user_id !== $userId) {
            abort(403);
        }

        $messages = $booking->messages()->with('sender')->orderBy('created_at', 'asc')->get();
        
        // Mark as seen
        $booking->messages()->where('receiver_id', $userId)->where('seen', false)->update(['seen' => true]);

        return view('messages.index', compact('booking', 'messages'));
    }

    public function store(Request $request, Booking $booking)
    {
        $userId = auth()->id();
        if ($booking->user_id !== $userId && $booking->car->user_id !== $userId) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $receiverId = $userId === $booking->user_id ? $booking->car->user_id : $booking->user_id;

        Message::create([
            'booking_id' => $booking->id,
            'sender_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'seen' => false,
        ]);

        return back();
    }
}
