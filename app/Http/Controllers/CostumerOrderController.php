<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostumerOrderController extends Controller
{
    // Tampilkan daftar layanan ke customer
    public function index()
    {
        $services = Service::all();
        return view('customer.layanan', compact('services'));
    }

    // Tampilkan form pemesanan manual (create)
    public function create($id)
    {
        $service = Service::findOrFail($id);
        return view('customer.create', compact('service'));
    }

    // Simpan pesanan dari form manual (POST)
    public function storePesanan(Request $request)
    {
        $service = Service::findOrFail($request->service_id);
        $quantity = $request->input('quantity', 1);
        $subtotal = $service->price * $quantity;

        // ✅ Selalu buat pesanan baru
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_date' => now(),
            'total_price' => $subtotal, // Gunakan field total_price yang konsisten
            'status' => 'pending',
        ]);

        // Tambahkan layanan ke order_service
        OrderService::create([
            'order_id' => $order->id,
            'service_id' => $service->id,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'notes' => $request->input('notes') ?? null,
        ]);

        return redirect()->route('customer.pesanan.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    // Tampilkan daftar pesanan customer
    public function daftarPesanan()
    {
        $orders = Order::with('orderServices.service')
                    ->where('user_id', Auth::id())
                    ->get();

        return view('customer.DaftarPesanan', compact('orders'));
    }
}
