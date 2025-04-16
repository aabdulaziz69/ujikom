<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user()
    {
        $title = "User";
        $users = User::all();

        return view("DataUser/user", compact("title", "users"));
    }

    // Tampilkan form
    public function create()
    {
        $title = 'Tambah User';
        return view('Datauser.tambah', compact('title'));
    }

    // Simpan data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Enkripsi password
        $validated['password'] = Hash::make($validated['password']);

        // Simpan user baru ke database
        User::create($validated);

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan!');
    }


    // edit

    public function edit(User $user)
    {
        $title = "Edit User";
        return view('DataUser.edit', compact('user', 'title'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user')->with('success', 'User berhasil diupdate.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success', 'User berhasil dihapus!');
    }
}
