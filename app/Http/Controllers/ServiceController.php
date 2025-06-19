<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Untuk admin: Menampilkan semua layanan
    public function index()
    {
        $services = Service::all(); 
        return view('LayananPetugas', compact('services'));
    }

    // Untuk petugas: Menampilkan layanan di halaman petugas
    public function indexPetugas()
    {
        $services = Service::all();
        return view('LayananPetugas', compact('services'));
    }

    // Form tambah layanan
    public function create()
    {
        return view('CreateLayanan');
    }

    // Simpan layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tersedia' => 'required|integer',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    // Form edit layanan
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('EditLayanan', compact('service'));
    }

    // Update layanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'tersedia' => 'required|integer',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    // Hapus layanan
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Data Layanan berhasil dihapus.');
    }
}
