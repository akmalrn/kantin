<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Auth_PembeliController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('transaksi/halamanPembelian'); // Sesuaikan dengan URL yang diinginkan setelah logout
    }

    public function logoutya(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('user/loginUser'); // Sesuaikan dengan URL yang diinginkan setelah logout
    }
}
