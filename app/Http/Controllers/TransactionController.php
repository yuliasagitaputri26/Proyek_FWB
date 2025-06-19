<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    // Tampilkan form input transaksi
    public function create()
    {
        $orders = Order::all(); // jika ingin dropdown pilihan order
        return view('Transaksi.create', compact('orders'));
    }

    // Simpan transaksi
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'payment_method' => 'required|string|max:50',
                'amount_paid' => 'required|numeric|min:0',
                'transaction_date' => 'required|date',
            ]);

            // ❗ Cek apakah transaksi untuk order_id ini sudah ada
            $existing = Transaction::where('order_id', $validated['order_id'])->first();
            if ($existing) {
                return redirect()->back()->with('error', 'Transaksi untuk pesanan ini sudah ada.');
            }

            // Simpan transaksi
            Transaction::create($validated);

            return redirect()->route('Transaksi.create')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Transaksi gagal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan transaksi.');
        }
    }
}
