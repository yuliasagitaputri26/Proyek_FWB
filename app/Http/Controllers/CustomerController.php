<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderStatus;

class CustomerController extends Controller
{
    // Menampilkan halaman dashboard customer
    public function index()
    {
        $user = Auth::user();

        // Ambil total order dan status terakhir (jika ada)
        $totalOrders = Order::where('user_id', $user->id)->count();
        $lastStatus = OrderStatus::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->latest('updated_at')->first();

        return view('customer.dashboard', [
            'user' => $user,
            'totalOrders' => $totalOrders,
            'lastStatus' => $lastStatus ? $lastStatus->status : 'Belum Ada',
        ]);
    }

    // Menampilkan halaman profil customer
    public function profile()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }
}
