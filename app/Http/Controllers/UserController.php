<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Hanya admin yang boleh akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        // Ambil semua user kecuali admin
        $users = User::where('role', '!=', 'admin')->get();

        return view('AdminUser', compact('users'));
    }

    public function destroy($id)
    {
        // Hanya admin yang boleh akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        $user = User::findOrFail($id);

        // Cegah penghapusan admin lain
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
