<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Barang;

class KeranjangController extends Controller
{
    public function TambahKeKeranjang(Request $request)
    {
        // Validasi data yang dikirim
        $request->validate([
            'id' => 'required|exists:barangs,id',
            'jumlah_barang' => 'required|integer|min:1'
        ]);

        // Buat data keranjang baru
        Keranjang::create([
            'id_barang' => $request->id,
            'jumlah_barang' => $request->jumlah_barang
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang.');
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
        $barangs = Barang::all();
        $keranjang = Keranjang::all();
        return view('keranjang.index', compact('barangs','keranjang'));
    }
}
