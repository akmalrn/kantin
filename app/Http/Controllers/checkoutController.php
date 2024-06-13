<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Keranjang;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiDefinisi; // Pastikan Anda menambahkan model ini

class checkoutController extends Controller
{

    public function process(Request $request)
    {
        $keranjangItems = Keranjang::where('user_id', Auth::id())
                                    ->where('status_barang', 'belum_checkout')
                                    ->get();
    
        $transaksiItems = [];
        $totalHarga = 0; // Inisialisasi total harga
    
        // Loop melalui setiap item di keranjang
        foreach ($keranjangItems as $item) {
            // Hitung subtotal untuk item ini
            $subtotal = $item->jumlah_barang * $item->barang->harga_barang;
            $totalHarga += $subtotal;
    
            // Simpan transaksi ke dalam tabel Transaksi
            $transaksi = Transaksi::create([
                'user_id' => $item->user_id,
                'id_barang' => $item->id_barang,
                'jumlah_barang' => $item->jumlah_barang,
                'status_barang' => 'sudah_checkout',
                'total_harga' => $subtotal,
                'tempat' => $item->tempat,
                'pembayaran' => $item->pembayaran,
            ]);
    
            $transaksiItems[] = $transaksi;
    
            // Kurangi stok barang di tabel Barang
            $barang = Barang::find($item->id_barang);
            if ($barang) {
                $barang->jumlah_barang -= $item->jumlah_barang;
                $barang->save();
            }
    
            // Hapus item dari keranjang
            $item->delete();
    
            // Tambahkan data ke tabel transaksi_definisi
            TransaksiDefinisi::create([
                'transaksi_id' => $transaksi->id,
                'user_id' => $item->user_id,
                'id_barang' => $item->id_barang,
            ]);
        }
    
        // Simpan data transaksi ke session
        session(['transaksiItems' => $transaksiItems]);
    
        // Redirect ke halaman sukses
        return redirect()->route('HalamanTransaksi');
    }


}
    

