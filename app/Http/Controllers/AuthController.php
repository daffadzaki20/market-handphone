<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        User::create([
            'name' => $request->name,
            'username'=> $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect('/login');
    }

    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // 1. Validasi input (gunakan nama 'login' agar fleksibel)
    $request->validate([
        'login' => 'required', // Ini bisa berisi email atau username
        'password' => 'required'
    ]);

    // 2. Tentukan apakah input adalah email atau username
    $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // 3. Masukkan ke dalam array kredensial
    $credentials = [
        $fieldType => $request->login,
        'password' => $request->password
    ];

    // 4. Proses Autentikasi
    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    // Jika gagal login
    return back()->withErrors([
        'login' => 'Email/Username atau password salah.',
    ])->onlyInput('login');
}
public function logout()
{
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
}
}