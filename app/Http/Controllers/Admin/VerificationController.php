<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\User;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        $verifications = Verification::where('status', $status)->with('user')->latest()->paginate(10);
        return view('admin.verifications.index', compact('verifications', 'status'));
    }

    public function update(Request $request, Verification $verification)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $verification->update(['status' => $validated['status']]);
        
        if ($validated['status'] === 'approved') {
            $verification->user()->update(['is_verified' => true]);
        } else {
            $verification->user()->update(['is_verified' => false]);
        }

        return back()->with('success', "Verification document {$validated['status']}.");
    }
}
