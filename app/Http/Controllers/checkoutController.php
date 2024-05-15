<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjual;

class checkoutController extends Controller
{
    public function index()
    {
     // Ambil data keranjang belanja dari sesi
     $keranjang = Session::get('keranjang');
    
     // Tampilkan halaman checkout dan kirimkan data keranjang belanja
     return view('checkout', compact('keranjang'));
}
public function checkout(Request $request)
{
    // Ambil semua barang yang ada di keranjang dari session
    $keranjang = $request->session()->get('keranjang');

    // Pastikan keranjang tidak kosong sebelum melakukan iterasi
    if (!$keranjang) {
        return redirect()->back()->with('error', 'Keranjang belanja kosong.');
    }

    // Lakukan iterasi untuk mengurangi jumlah_barang barang di tabel 'barangs'
    foreach ($keranjang as $item) {
        // Ambil barang dari database berdasarkan ID
        $barang = Barang::find($item['id_barang']);
        
        // Validasi apakah barang ditemukan
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Kurangi jumlah_barang barang sesuai dengan jumlah yang dibeli
        $barang->jumlah_barang -= $item['jumlah_barang'];
        
        // Simpan perubahan pada jumlah_barang barang
        $barang->save();
    }

    // Setelah mengurangi jumlah_barang barang, kosongkan keranjang belanja
    $request->session()->forget('keranjang');

    // Redirect atau tampilkan halaman sukses pembayaran
    return redirect()->route('suksesPembayaran')->with('success', 'Pembayaran berhasil.');
}

    
}
