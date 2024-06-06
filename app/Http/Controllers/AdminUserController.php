<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'tlp' => 'required|string|max:15',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'tlp' => $request->tlp,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User created successfully.');
    }
    
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'tlp' => 'required|string|max:15',
        ]);

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'alamat' => $request->alamat,
            'tlp' => $request->tlp,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }
}
