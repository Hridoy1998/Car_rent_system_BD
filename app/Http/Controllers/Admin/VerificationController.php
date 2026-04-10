<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Verification::with('user');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('status', 'like', "%{$search}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('user', fn ($u) => $u->where('email', 'like', "%{$search}%"));
            });
        }

        $verifications = $query->latest()->paginate(10)->withQueryString();
        return view('admin.verifications.index', compact('verifications'));
    }

    public function show(Verification $verification)
    {
        $verification->load(['user.bookings', 'user.reviews']);
        return view('admin.verifications.show', compact('verification'));
    }

    public function update(Request $request, Verification $verification)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $verification->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Verification status updated successfully.');
    }
}
