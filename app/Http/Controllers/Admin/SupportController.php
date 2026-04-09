<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class SupportController extends Controller
{
    public function index()
    {
        $activeChats = Booking::with(['customer', 'car.owner', 'messages'])
            ->whereHas('messages')
            ->latest()
            ->paginate(15);

        return view('admin.support.index', compact('activeChats'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['customer', 'car.owner', 'messages.sender']);

        return view('admin.support.show', compact('booking'));
    }
}
