<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $title = "login"; // Corrected typo here

        return view("auth.login", compact("title"));
    }
    public function proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'usn' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil input dari form
        $username = $request->input('usn');
        $password = $request->input('password');

        // Cek kredensial atau lakukan login sesuai kebutuhan
        // Misalnya, gunakan Auth::attempt untuk login pengguna

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            // Berhasil login
            return redirect()->intended('/dashboard');
        }

        // Gagal login
        return back()->withErrors(['login' => 'User tidak terdaftar.']);
    }

    public function logout(Request $request)
    {
        // Melakukan logout pengguna yang sedang login
        Auth::logout();

        // Menghapus sesi atau cookie yang terkait
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama atau halaman login setelah logout
        return redirect()->route('login');
    }
}
