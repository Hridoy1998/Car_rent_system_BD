<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function download(Booking $booking)
    {
        // Must be authorized
        $user = auth()->user();
        if ($user->role !== 'admin' && $user->id !== $booking->user_id && $user->id !== $booking->car->user_id) {
            abort(403);
        }

        // Must be approved or completed
        if (!in_array($booking->status, ['approved', 'completed'])) {
            return back()->with('error', 'Invoice not yet available context.');
        }

        $booking->load(['car.owner', 'customer']);

        $pdf = Pdf::loadView('invoices.pdf', compact('booking'));
        return $pdf->download("Invoice-CarRentBD-{$booking->id}.pdf");
    }
}
