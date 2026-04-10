<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $Role = $request->get('role', 'all');
        $query = User::query();
        if ($Role !== 'all') {
            $query->where('role', $Role);
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users', 'Role'));
    }

    public function show(User $user)
    {
        $user->load([
            'cars.images', 
            'bookings.car', 
            'receivedBookings.car', 
            'receivedBookings.customer', 
            'verifications', 
            'reviews'
        ]);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => 'sometimes|nullable|string|max:20',
            'role' => 'sometimes|in:admin,owner,customer',
            'is_blocked' => 'sometimes|boolean',
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'profile_photo' => 'sometimes|nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.show', $user)->with('success', "Identity node [{$user->name}] has been successfully recalibrated.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Critical Error: Self-destruction protocol blocked.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User node purged from the system.');
    }
}
