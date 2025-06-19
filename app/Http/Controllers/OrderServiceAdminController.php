<?php

namespace App\Http\Controllers;

use App\Models\OrderService;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderServiceAdminController extends Controller
{
    /**
     * Tampilkan semua data order_service
     */
    public function index()
    {
        $orderServices = OrderService::with(['order', 'service'])->get();
        return view('OrderServiceAdmin', compact('orderServices'));
    }

    /**
     * Form tambah order_service
     */
    public function create()
    {
        $orders = Order::all();
        $services = Service::all();
        return view('CreateOrderServiceAdmin', compact('orders', 'services'));
    }

    /**
     * Simpan data order_service
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

        return redirect()->route('admin.order_service.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Form edit order_service
     */
    public function edit($id)
    {
        $orderService = OrderService::findOrFail($id);
        $orders = Order::all();
        $services = Service::all();

        return view('EditOrderServiceAdmin', compact('orderService', 'orders', 'services'));
    }

    /**
     * Update data order_service
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

        return redirect()->route('admin.order_service.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus data order_service
     */
    public function destroy($id)
    {
        $orderService = OrderService::findOrFail($id);
        $orderService->delete();

        return redirect()->route('admin.order_service.index')->with('success', 'Data berhasil dihapus.');
    }
}
