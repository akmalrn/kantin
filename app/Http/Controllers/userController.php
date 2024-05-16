<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjual;
use App\Models\Pembeli;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function HalamanRegistrasiUser()
    {
        return view('User/registrasiUser');
    }

    public function registrasiUser(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('HalamanLoginUser')->with('success', 'Registrasi sukses. Sekarang kamu bisa login.');
    }
    
    public function HalamanLoginUser()
    {
        return view('User/loginUser');
    }
    public function loginUser(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('halamanUser');
        }
        return back()->with('error', 'Invalid credentials');
    }

    public function halamanUser()
    {
        $penjuals = Penjual::all();
        $barangs = Barang::all();
        $pembelis = Pembeli::all();
        return view('user/halamanUser', compact('penjuals', 'barangs', 'pembelis'));
    }

    public function halamanuser2(){

    }

    public function halamanuser3(){
        
    }

    public function barangdestroy(Barang $barang)
    {
        $barang->delete();
        
        return redirect()->route('halamanUser')->with('success', 'Data barang berhasil dihapus!');
    }
    public function penjualdestroy(Penjual $penjual)
    {
        $penjual->delete();
        
        return redirect()->route('halamanUser')->with('success', 'Data penjual berhasil dihapus!');
    }
    public function pembelidestroy(Pembeli $pembeli)
    {
        $pembeli->delete();
        
        return redirect()->route('halamanUser')->with('success', 'Data pembeli berhasil dihapus!');
    }
}
