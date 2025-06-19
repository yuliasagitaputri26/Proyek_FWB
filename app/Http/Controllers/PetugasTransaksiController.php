<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PetugasTransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        // Ambil semua transaksi beserta relasi order & user
        $transaksis = Transaction::with('order.user')->latest()->get();

        return view('TransaksiPetugas.index', compact('transaksis'));
    }
}
