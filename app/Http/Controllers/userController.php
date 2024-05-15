<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
        return view('User/halamanUser');
    }
}
