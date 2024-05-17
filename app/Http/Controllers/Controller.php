<?php

namespace App\Http\Controllers;
use App\Models\Barang;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function welcome($id)
    {
        $barangs = Barang::find($id);

        // Pass the id and item to the view
        return view('Transaksi.index', compact('id', 'barangs'));
    }

    public function index()
    {
        $barangs = Barang::all(); // Ambil semua data barang
        return view('Transaksi.index', compact('barangs')); 
    }
}

