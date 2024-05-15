<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;

class KeranjangController extends Controller
{
    public function tambahBarang(Request $request)
    {
        // Validasi data yang dikirim
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        // Tambahkan barang ke keranjang
        Keranjang::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('keranjang.lihat')->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    public function hapusBarang($id)
    {
        // Hapus barang dari keranjang
        Keranjang::findOrFail($id)->delete();

        return redirect()->route('keranjang.lihat')->with('success', 'Barang berhasil dihapus dari keranjang.');
    }

    public function lihatKeranjang()
    {
        // Ambil data keranjang
        $keranjang = Keranjang::all();

        return view('keranjang.index', compact('keranjang'));
    }
}
