<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class PagesController extends Controller
{
    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function safety()
    {
        return view('pages.safety');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function bookingSuccess(Booking $booking)
    {
        // Ensure user owns this booking
        if (auth()->id() !== $booking->user_id) {
            abort(403);
        }

        return view('success.booking', compact('booking'));
    }

    public function carSuccess()
    {
        return view('success.car');
    }

    public function mediation()
    {
        return view('pages.mediation-hub');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function termination()
    {
        return view('pages.termination');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }
}
