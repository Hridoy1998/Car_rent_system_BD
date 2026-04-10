<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    public function show(string $id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        // Intelligent Tactical Redirection
        $data = $notification->data;
        $role = auth()->user()->role;
        $redirectUrl = $data['action_url'] ?? route($role.'.dashboard');

        // Extract and resolve potential raw Booking IDs
        $bookingId = $data['booking_id'] ?? ($data['id'] ?? null);
        if ($bookingId && is_numeric($bookingId)) {
            $booking = Booking::find($bookingId);
            if ($booking) {
                $bookingId = $booking->getRouteKey();
            }
        }

        // Context-Aware Deep Linking
        if (isset($data['type'])) {
            switch ($data['type']) {
                case 'damage_report':
                    if ($role === 'admin') {
                        $redirectUrl = route('admin.damage-reports.show', $data['id']);
                    } elseif ($role === 'owner') {
                        $redirectUrl = route('owner.integrity.show', $data['id']);
                    }
                    break;
                case 'finance':
                case 'earning':
                    if ($role === 'admin') {
                        $redirectUrl = route('admin.finance.show', $bookingId);
                    } elseif ($role === 'owner') {
                        $redirectUrl = route('owner.finance.show', $data['id']);
                    }
                    break;
                case 'verification':
                    if ($role === 'admin') {
                        $redirectUrl = route('admin.verifications.show', $data['id']);
                    }
                    break;
                case 'booking':
                case 'handover':
                case 'return':
                    if ($role === 'owner') {
                        $redirectUrl = route('owner.logistics.show', $bookingId);
                    } elseif ($role === 'customer') {
                        $redirectUrl = route('customer.bookings.show', $bookingId);
                    } elseif ($role === 'admin') {
                        $redirectUrl = route('admin.bookings.show', $bookingId);
                    }
                    break;
            }
        } elseif ($bookingId) {
            $redirectUrl = route($role.'.bookings.show', $bookingId);
        }

        return redirect($redirectUrl);
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications cleared.');
    }
}
