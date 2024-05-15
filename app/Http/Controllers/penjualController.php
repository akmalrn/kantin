<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjual;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class penjualController extends Controller
{
    public function HalamanRegistrasiPenjual()
    {
        return view('Penjual/registrasiPenjual');
    }

    public function registrasiPenjual(Request $request)
{   
    $validator = Validator::make($request->all(), [
        'nama_penjual' => 'required|string|max:255',
        'password_penjual' => 'required|string|min:8|confirmed',
            'alamat_penjual' => 'required|string|max:255',
        'no_hp_penjual' => 'required|string|max:15', // Misalnya, maksimal 15 karakter
        'email_penjual' => 'required|string|email|max:255|unique:penjuals,email_penjual',
        'jk_penjual' => 'required|string|in:Laki-laki,Perempuan',

    ]);

    Penjual::create([
        'nama_penjual' => $request->input('nama_penjual'),
        'password_penjual' => Hash::make($request->input('password_penjual')),
        'alamat_penjual' => $request->input('alamat_penjual'),
        'no_hp_penjual' => $request->input('no_hp_penjual'),
        'email_penjual' => $request->input('email_penjual'),
        'jk_penjual' => $request->input('jk_penjual'),
        
    ]);

    return redirect()->route('HalamanLoginPenjual')->with('success', 'Registrasi sukses. Sekarang Anda bisa login.');
}

    public function HalamanLoginPenjual()
    {
        return view('Penjual/loginPenjual');
    }

    public function loginPenjual(Request $request)
{
    $request->validate([
        'nama_penjual' => 'required|string',
        'password_penjual' => 'required|string',
    ]);

    // Cari penjual berdasarkan nama
    $penjual = Penjual::where('nama_penjual', $request->nama_penjual)->first();

    // Jika penjual ditemukan dan kata sandi cocok
    if ($penjual && Hash::check($request->password_penjual, $penjual->password_penjual)) {
        // Lakukan login penjual
        Auth::login($penjual);

        // Ambil ID penjual setelah login
        $id_penjual = $penjual->id;

        // Redirect ke halaman penjual dengan membawa ID penjual
        return redirect()->route('halamanPenjual', ['id' => $id_penjual]);
    }

    // Jika nama penjual atau kata sandi salah, kembalikan ke halaman login dengan pesan error
    return redirect()->back()->withErrors(['loginError' => 'Nama penjual atau password salah.']);
}

    
    public function halamanPenjual()
    {
        $barangs = Barang::all(); // Mengambil semua data barang
        return view('Penjual/halamanPenjual', compact('barangs'));
    }
    
}
