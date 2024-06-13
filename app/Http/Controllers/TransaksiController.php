<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Barang;

class TransaksiController extends Controller
{
    public function halamanTransaksi()
    {
         // Ambil data transaksi dari session
    $transaksiItems = session('transaksiItems', []);

    // Tampilkan halaman transaksi dengan data yang baru saja di-checkout
    return view('transaksi/halamanTransaksi', compact('transaksiItems'));
    }
    
}
