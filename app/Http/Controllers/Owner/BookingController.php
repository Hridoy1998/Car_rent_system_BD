<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\DamageReport;
use App\Notifications\BookingStatusUpdated;
use App\Services\EarningService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct(protected EarningService $earningService) {}

    public function index(Request $request)
    {
        $query = Booking::whereHas('car', fn ($q) => $q->where('user_id', auth()->id()))
            ->with(['customer', 'car.images', 'damageReports']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('customer', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('car', fn ($c) => $c->where('brand', 'like', "%{$search}%"));
            });
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('owner.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        if ($booking->car->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->load([
            'customer.verifications',
            'car.images',
            'damageReports',
            'messages.sender',
        ]);

        return view('owner.bookings.show', compact('booking'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $newStatus = $request->validated()['status'];

        // Sovereign Fleet Lifecycle: can only progress forward
        $allowed = [
            'pending' => ['approved', 'rejected'],
            'approved' => ['ongoing', 'cancelled'],
            'ongoing' => ['returning', 'returned'], // Owner can skip 'returning' if needed
            'returning' => ['returned'],            // Owner verifies renter's request
            'returned' => ['completed'],
        ];

        $currentStatus = $booking->status;
        if (! isset($allowed[$currentStatus]) || ! in_array($newStatus, $allowed[$currentStatus])) {
            return back()->with('error', "Cannot transition booking from '{$currentStatus}' to '{$newStatus}'. Protocol Violation.");
        }

        // Integrity Checks
        if ($newStatus === 'completed' && $booking->isLocked()) {
            return back()->with('error', 'Integrity Lock active. Resolve all damage disputes before finalizing mission.');
        }

        if ($newStatus === 'ongoing' && $booking->payment_status !== 'paid') {
            return back()->with('error', 'Cannot initiate handover for unpaid booking. Verify financial settlement first.');
        }

        $validated = $request->validated();

        DB::transaction(function () use ($booking, $newStatus, $validated, $request) {
            $updateData = ['status' => $newStatus];

            if ($newStatus === 'ongoing') {
                $updateData['checked_in_at'] = now();
                if (isset($validated['start_odo'])) {
                    $updateData['start_odo'] = $validated['start_odo'];
                }
            } elseif ($newStatus === 'returned') {
                $updateData['returned_at'] = now();

                // Final Physical Audit
                if (isset($validated['end_odo'])) {
                    $updateData['end_odo'] = $validated['end_odo'];
                }
                if (isset($validated['end_fuel'])) {
                    $updateData['end_fuel'] = $validated['end_fuel'];
                }
                if (isset($validated['inspection_notes'])) {
                    $updateData['inspection_notes'] = $validated['inspection_notes'];
                }

                if ($request->hasFile('inspection_image')) {
                    $path = $request->file('inspection_image')->store('inspections', 'public');
                    $updateData['inspection_images'] = json_encode([$path]);
                }

                // Integrated Sovereign Damage Reporting
                if (isset($validated['damage_description']) && isset($validated['damage_cost'])) {
                    $damageData = [
                        'booking_id' => $booking->id,
                        'description' => $validated['damage_description'],
                        'cost' => $validated['damage_cost'],
                        'status' => 'pending',
                    ];

                    if ($request->hasFile('damage_image')) {
                        $damageData['image'] = $request->file('damage_image')->store('damages', 'public');
                    }

                    DamageReport::create($damageData);
                    $updateData['security_deposit_status'] = 'disputed';
                }
            }

            if ($newStatus === 'completed') {
                $updateData['security_deposit_status'] = 'released';
            }

            $booking->update($updateData);

            // Settle earnings on completion
            if ($newStatus === 'completed') {
                $this->earningService->settleBooking($booking->load('car'));
            }
        });

        // Notify the customer
        $booking->customer->notify(new BookingStatusUpdated($booking->load('car')));

        return back()->with('success', "Booking status transitioned to '{$newStatus}'.");
    }
}
