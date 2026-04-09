<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'is_blocked' => 'required|boolean',
        ]);

        $user->update(['is_blocked' => $validated['is_blocked']]);

        $status = $validated['is_blocked'] ? 'blocked' : 'unblocked';

        return back()->with('success', "User {$user->name} has been {$status}.");
    }
}
