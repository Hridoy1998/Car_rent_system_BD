<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        $verifications = Verification::with('user')->latest()->paginate(10);
        return view('admin.verifications.index', compact('verifications'));
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
