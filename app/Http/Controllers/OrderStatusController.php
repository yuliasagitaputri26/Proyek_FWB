<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    // Menampilkan semua status
    public function index()
    {
        $statuses = OrderStatus::with('order')->latest()->get();
        return view('StatusPetugas', compact('statuses'));
    }

    // Tampilkan form tambah status
    public function create()
    {
        $orders = Order::all(); // Untuk dropdown pilih order
        return view('CreateStatus', compact('orders'));
    }

    // Simpan data status baru
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'order_id' => 'required|exists:orders,id',
        ]);

        OrderStatus::create([
            'status' => $request->status,
            'order_id' => $request->order_id,
        ]);

        return redirect()->route('order-status.index')->with('success', 'Status berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $status = OrderStatus::findOrFail($id);
        $orders = Order::all(); // Untuk dropdown pilih order
        return view('EditStatus', compact('status', 'orders'));
    }

    // Simpan perubahan status
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'order_id' => 'required|integer',
        ]);

        $status = OrderStatus::findOrFail($id);
        $status->update([
            'status' => $request->status,
            'order_id' => $request->order_id,
        ]);

        return redirect()->route('order-status.index')->with('success', 'Status berhasil diperbarui.');
    }

    // Hapus status
    public function destroy($id)
    {
        $status = OrderStatus::findOrFail($id);
        $status->delete();

        return redirect()->route('order-status.index')->with('success', 'Status berhasil dihapus.');
    }
}
