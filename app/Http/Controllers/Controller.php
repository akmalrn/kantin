<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function welcome($id)
    {
        $barangs = Barang::find($id);

        // Pass the id and item to the view
        return view('Transaksi.index', compact('id', 'barangs'));
    }

    public function halamanPembelian()
    {
        $makanan = Barang::where('jenis_barang', 'Makanan')->get();
        $minuman = Barang::where('jenis_barang', 'Minuman')->get();
        $user = User::all();
        $barangs = Barang::all(); // Ambil semua data barang
        return view('Transaksi.halamanPembelian', compact('barangs', 'user', 'makanan', 'minuman')); 
    }
}

