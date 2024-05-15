<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Penjual;

class barangController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $barangs = Barang::when($search, function ($query) use ($search) {
            return $query->where('nama_barang', 'like', "%$search%");
        })->get();
        $barangs = Barang::when($search, function ($query) use ($search) {
            return $query->where('jenis_barang', 'like', "%$search%");
        })->get();
        return view('Transaksi/index', compact('barangs'));
    }

    public function HalamanTambahBarang()
    {   
        
        $penjuals = Penjual::all();
        return view('Penjual/tambahbarang/tambahBarang', ['penjuals' => $penjuals]);
    }

    public function tambahBarang(Request $request)
    {
        $request->validate([
            'jenis_barang' => 'required|string',
            'nama_barang' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga_barang' => 'required|numeric',
            'jumlah_barang' => 'required|integer',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/images', $imageName);
        } else {
            $imageName = null;
        }
    
        // Dapatkan ID penjual aktif (pengguna yang sedang login)
        $id_penjual = Auth::id();
    
        // Simpan data barang ke dalam database
        Barang::create([
            'id_penjual' => $request->id_penjual,
            'jenis_barang' => $request->jenis_barang,
            'nama_barang' => $request->nama_barang,
            'image' => $imageName,
            'jumlah_barang' => $request->jumlah_barang,
            'harga_barang' => $request->harga_barang,
        ]);
    
        // Redirect ke halaman tertentu setelah penyimpanan berhasil
        return redirect()->route('halamanPenjual')->with('success', 'Barang berhasil ditambahkan.');
    }
    
}
