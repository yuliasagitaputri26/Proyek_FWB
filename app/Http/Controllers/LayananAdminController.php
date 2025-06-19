<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; // Pastikan model Service sudah ada

class LayananAdminController extends Controller
{
    /**
     * Tampilkan semua data layanan ke halaman admin
     */
    public function index()
    {
        $services = Service::all(); // Ambil semua data layanan dari DB
        return view('LayananAdmin', compact('services'));
    }

    /**
     * Tampilkan form tambah layanan (opsional)
     */
    public function create()
    {
        return view('CreateLayananAdmin');
    }

    /**
     * Simpan layanan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
        ]);

        Service::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit layanan
     */
    public function edit($id)
    {
        $layanan = Service::findOrFail($id);
        return view('EditLayananAdmin', compact('layanan'));
    }

    /**
     * Update layanan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
        ]);

        $layanan = Service::findOrFail($id);
        $layanan->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Hapus layanan
     */
    public function destroy($id)
    {
        $layanan = Service::findOrFail($id);
        $layanan->delete();

        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil dihapus.');
    }
}
