<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Tampilkan daftar pesanan customer yang sedang login
    public function index()
    {
        $orders = Order::with(['user', 'services', 'statuses'])
                        ->where('user_id', Auth::id())
                        ->get();
        return view('customer.DaftarPesanan', compact('orders'));
    }

    // Tampilkan form buat pesanan
    public function create()
    {
        $services = Service::all(); // Ambil semua layanan
        return view('customer.create', compact('services'));
    }

    // Simpan data pesanan ke database
    public function store(Request $request)
    {
        $request->validate([
            'order_date' => 'required|date',
            'services'   => 'required|array',
        ]);

        // Hitung total harga dari layanan yang dipilih
        $totalPrice = 0;
        foreach ($request->services as $id => $detail) {
            if (isset($detail['checked']) && isset($detail['quantity'])) {
                $service = Service::find($id);
                $totalPrice += $service->price * $detail['quantity'];
            }
        }

        // Simpan pesanan
        $order = Order::create([
            'user_id'     => Auth::id(),
            'order_date'  => $request->order_date,
            'total_price' => $totalPrice,
        ]);

        // Simpan layanan terkait dengan quantity
        foreach ($request->services as $id => $detail) {
            if (isset($detail['checked']) && isset($detail['quantity'])) {
                $order->services()->attach($id, ['quantity' => $detail['quantity']]);
            }
        }

        return redirect()->route('customer.pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    // Tampilkan form edit pesanan
    public function edit($id)
    {
        $order = Order::with(['services', 'statuses', 'user'])->findOrFail($id);
        return view('customer.EditOrder', compact('order'));
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('customer.pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
