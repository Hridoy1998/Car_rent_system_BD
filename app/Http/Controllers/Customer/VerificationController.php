<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        $verification = Verification::where('user_id', auth()->id())->latest()->first();
        return view('customer.verifications.index', compact('verification'));
    }

    public function store(Request $request)
    {
        // Check for existing pending or approved
        $existing = Verification::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have an active verification.');
        }

        $request->validate([
            'document_type' => 'required|string|max:100',
            'document_file' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $path = $request->file('document_file')->store('verifications', 'public');

        Verification::create([
            'user_id' => auth()->id(),
            'document_type' => $request->document_type,
            'document_file' => $path,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Verification document submitted! Please wait for Admin approval.');
    }
}
