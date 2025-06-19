<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderStatus;
use App\Models\Order; // Pastikan model Order ada

class OrderStatusAdminController extends Controller
{
    /**
     * Tampilkan semua status pesanan ke halaman admin
     */
    public function index()
    {
        $statuses = OrderStatus::with('order')->get(); // relasi order
        return view('StatusAdmin', compact('statuses'));
    }

    /**
     * Tampilkan form tambah status
     */
    public function create()
    {
        $orders = Order::all(); // Ambil data order untuk dropdown
        return view('CreateStatusAdmin', compact('orders'));
    }

    /**
     * Simpan status baru ke database
     */
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

        return redirect()->route('admin.status')->with('success', 'Status berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit status
     */
    public function edit($id)
    {
        $status = OrderStatus::findOrFail($id);
        $orders = Order::all();
        return view('EditStatusAdmin', compact('status', 'orders'));
    }

    /**
     * Update status
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255|unique:order_status,status,' . $id,
            'order_id' => 'required|exists:orders,id',
        ]);

        $status = OrderStatus::findOrFail($id);
        $status->update([
            'status' => $request->status,
            'order_id' => $request->order_id,
        ]);

        return redirect()->route('admin.status')->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Hapus status
     */
    public function destroy($id)
    {
        $status = OrderStatus::findOrFail($id);
        $status->delete();

        return redirect()->route('admin.status')->with('success', 'Status berhasil dihapus.');
    }
}
