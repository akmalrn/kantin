<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Keranjang;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
class KeranjangController extends Controller
{
    public function tambahKeKeranjang(Request $request)
{
    Log::info('Method tambahKeKeranjang dipanggil');
    Log::info('Request data: ', $request->all());

    // Validasi input
    $request->validate([
        'id' => 'required|exists:barangs,id',
        'jumlah_barang' => 'required|integer|min:1',
        'tempat' => 'required|',
        'pembayaran' => 'required|'
    ]);
    $barang = Barang::findOrFail($request->id);
    if ($barang->jumlah_barang < $request->jumlah_barang) {
        return response()->json(['error' => 'Stok tidak mencukupi'], 400);
    }
    // Ambil data barang dari request
    $id_barang = $request->input('id');
    $jumlah_barang = $request->input('jumlah_barang');
    $tempat = $request->input('tempat');
    $pembayaran = $request->input('pembayaran');

    $user_id = Auth::id();
    // Tambahkan barang ke keranjang
    Keranjang::create([
        'user_id' => $user_id,
        'id_barang' => $id_barang,
        'jumlah_barang' => $jumlah_barang,
        'status_barang' => 'belum_checkout', // Set status barang sebagai belum checkout
        'tempat' => $tempat,
        'pembayaran' => $pembayaran,
    ]);

    Log::info('Barang berhasil ditambahkan ke keranjang', ['id_barang' => $id_barang, 'jumlah_barang' => $jumlah_barang]);

    // Return response JSON
    return response()->json(['success' => 'Barang berhasil ditambahkan ke keranjang!']);
}


public function HalamanKeranjang2()
{
    // Dapatkan ID pengguna yang sedang login
    $id_user = Auth::id();

    // Gunakan ID pengguna untuk mengambil data keranjang yang terkait
    $keranjang = Keranjang::where('user_id', $id_user)->get();
    
    // Ambil data user
    $user = Auth::user();

    // Ambil semua data barang
    $barangs = Barang::all();

    // Kirim data ke tampilan
    return view('Keranjang/halamanKeranjang', compact('barangs', 'keranjang', 'user'));
}


    public function destroyKeranjang($id)
    {
        $keranjang = Keranjang::find($id);
    
        if ($keranjang) {
            $keranjang->delete();
            return redirect()->route('HalamanKeranjang')->with('success', 'Data penjual berhasil dihapus!');
        }
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    public function destroyKeranjang2($id)
{
    $keranjang = Keranjang::find($id);

    if ($keranjang) {
        $keranjang->delete();
        return redirect()->route('HalamanKeranjang2')->with('success', 'Data penjual berhasil dihapus!');
    }
    return response()->json(['error' => 'Data tidak ditemukan'], 404);
}

}