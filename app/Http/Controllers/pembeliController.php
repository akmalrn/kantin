<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pembeli;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class pembeliController extends Controller
{

    public function HalamanRegistrasiPembeli()
    {
        return view('Pembeli/registrasiPembeli');
    }

    public function registrasiPembeli(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pembeli' => 'required|string|max:255',
            'password_pembeli' => 'required|string|min:8|confirmed',
            'alamat_pembeli' => 'required|string|max:255',
            'no_hp_pembeli' => 'required|string|max:15', // Misalnya, maksimal 15 karakter
            'jk_pembeli' => 'required|string|in:Laki-laki,Perempuan',
    
        ]);
    
        pembeli::create([
            'nama_pembeli' => $request->input('nama_pembeli'),
            'password_pembeli' => Hash::make($request->input('password_pembeli')),
            'alamat_pembeli' => $request->input('alamat_pembeli'),
            'no_hp_pembeli' => $request->input('no_hp_pembeli'),
            'jk_pembeli' => $request->input('jk_pembeli'),
            
        ]);
    
        return redirect()->route('HalamanLoginPembeli')->with('success', 'Registrasi sukses. Sekarang Anda bisa login.');
    }

    public function HalamanLoginPembeli()
    {
        return view('Pembeli/loginPembeli');
    }

    public function loginPembeli(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string',
            'password_pembeli' => 'required|string',
        ]);
    
        // Cari pembeli berdasarkan nama
        $pembeli = Pembeli::where('nama_pembeli', $request->nama_pembeli)->first();
    
        // Jika pembeli ditemukan dan kata sandi cocok
        if ($pembeli && Hash::check($request->password_pembeli, $pembeli->password_pembeli)) {
            // Lakukan login pembeli
            Auth::login($pembeli);
    
            // Ambil ID pembeli setelah login
            $id_pembeli = $pembeli->id;
    
            // Redirect ke halaman pembeli dengan membawa ID pembeli
            return redirect()->route('Pembelian', ['id' => $id_pembeli]);
        }
    
        // Jika nama pembeli atau kata sandi salah, kembalikan ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['loginError' => 'Nama pembeli atau password salah.']);
    }
}
