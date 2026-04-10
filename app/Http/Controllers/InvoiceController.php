<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function download(Booking $booking)
    {
        // Must be authorized
        $user = auth()->user();
        if ($user->role !== 'admin' && $user->id !== $booking->user_id && $user->id !== $booking->car->user_id) {
            abort(403);
        }

        // Must be approved, ongoing, returning, returned, or completed
        if (! in_array($booking->status, ['approved', 'ongoing', 'returning', 'returned', 'completed'])) {
            return back()->with('error', 'Invoice is not yet available for this booking.');
        }

        $booking->load(['car.owner', 'customer']);

        $pdf = Pdf::loadView('invoices.pdf', compact('booking'));

        return $pdf->download("Invoice-CarRentBD-{$booking->id}.pdf");
    }
}
