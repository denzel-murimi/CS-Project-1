<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'is_admin' => 'required|boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
