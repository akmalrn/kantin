<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjual;

class checkoutController extends Controller
{
    public function HalamanCheckout(){
        return view('Keranjang/checkout');
    }

    public function process(Request $request)
    {
        // Ambil semua barang yang ada di keranjang
        $keranjang = $request->session()->get('keranjang', []);

        // Lakukan iterasi untuk mengurangi stok barang di tabel 'barangs'
        foreach ($keranjang as $item) {
            $barang = Barang::find($item['id_barang']);
            // Kurangi stok barang sesuai dengan jumlah yang dibeli
            $barang->stok -= $item['jumlah_barang'];
            $barang->save();
        }

        // Setelah mengurangi stok barang, kosongkan keranjang belanja
        $request->session()->forget('keranjang');

        // Redirect atau tampilkan halaman sukses pembayaran
        return redirect()->route('HalamanCheckout')->with('success', 'Pembayaran berhasil!');
    }
    
}
