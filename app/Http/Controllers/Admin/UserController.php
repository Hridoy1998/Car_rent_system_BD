<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $Role = $request->get('role', 'all');
        $query = User::query();
        if ($Role !== 'all') {
            $query->where('role', $Role);
        }
        $users = $query->latest()->paginate(10);
        return view('admin.users.index', compact('users', 'Role'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'is_blocked' => 'required|boolean'
        ]);

        $user->update(['is_blocked' => $validated['is_blocked']]);

        $status = $validated['is_blocked'] ? 'blocked' : 'unblocked';
        return back()->with('success', "User {$user->name} has been {$status}.");
    }
}
