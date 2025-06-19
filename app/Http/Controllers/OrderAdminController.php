<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    /**
     * Tampilkan semua pesanan customer
     */
    public function index()
    {
        $orders = Order::with(['user', 'services', 'statuses'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
}
