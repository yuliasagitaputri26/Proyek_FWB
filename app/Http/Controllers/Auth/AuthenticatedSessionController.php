<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentikasi pengguna
        $request->authenticate();

        // Regenerasi session agar aman
        $request->session()->regenerate();

        // Ambil pengguna yang login
        $user = Auth::user();
        $role = $user->role;

        // Arahkan pengguna berdasarkan role
        if ($role === 'admin' || $role === 'petugas') {
    return redirect()->route('dashboard');
} elseif ($role === 'customer') {
    return redirect('/'); // langsung ke halaman utama (landing page)
}


        // Default fallback
        return redirect('/');
    }

    /**
     * Logout pengguna dan hancurkan sesi.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
