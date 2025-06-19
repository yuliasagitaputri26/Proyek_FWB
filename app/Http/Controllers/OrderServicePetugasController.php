<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderService;
use App\Models\Order;
use App\Models\Service;

class OrderServicePetugasController extends Controller
{
    /**
     * Tampilkan daftar order service untuk petugas
     */
    public function index()
    {
        // Perbaikan: relasi 'service' bukan 'services'
        $orderServices = OrderService::with(['order.user', 'service'])->get();
        return view('OrderServicePetugas', compact('orderServices'));
    }

    /**
     * Tampilkan form untuk membuat order service
     */
    public function create()
    {
        $orders = Order::all();
        $services = Service::all();
        return view('CreateOrderServicePetugas', compact('orders', 'services'));
    }

    /**
     * Simpan data order service baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        OrderService::create($request->all());

        return redirect()->route('petugas.order_service.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit
     */
    public function edit($id)
    {
        $orderService = OrderService::findOrFail($id);
        $orders = Order::all();
        $services = Service::all();
        return view('EditOrderServicePetugas', compact('orderService', 'orders', 'services'));
    }

    /**
     * Simpan hasil edit
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $orderService = OrderService::findOrFail($id);
        $orderService->update($request->all());

        return redirect()->route('petugas.order_service.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $orderService = OrderService::findOrFail($id);
        $orderService->delete();

        return redirect()->route('petugas.order_service.index')->with('success', 'Data berhasil dihapus.');
    }

}
