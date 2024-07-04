<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjual;
use App\Models\Pembeli;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


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
            'role' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('halamanUser')->with('success', 'Registrasi sukses. Sekarang kamu bisa login.');
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

    // Cari user berdasarkan email
    $user = User::where('email', $request->email)->first();

    // Jika user ditemukan dan password cocok
    if ($user && Hash::check($request->password, $user->password)) {
        // Lakukan login user
        Auth::login($user);

        // Ambil ID user setelah login
        $id_user = $user->id;
        
        // Redirect ke halaman pembelian setelah login
        return redirect()->route('halamanUser', ['id' => $id_user]);
    }

    // Jika email atau password salah, kembalikan ke halaman login dengan pesan error
    return back()->with('error', 'Invalid credentials');
}


    public function halamanUser()
{
    // Periksa apakah pengguna telah login
    if (!Auth::check()) {
        return redirect()->route('HalamanLoginUser')->with('error', 'Anda harus login terlebih dahulu.');
    }
    $userId = Auth::id();
    // Jika pengguna telah login, dapatkan data yang diperlukan dan tampilkan halaman
    $penjuals = Penjual::all();
    $barangs = Barang::all();
    return view('user/halamanUser', compact('penjuals', 'barangs'));
}

public function logoutUser(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('user/loginUser'); // Sesuaikan dengan URL yang diinginkan setelah logout
}

    public function barangdestroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('halamanUser')->with('success', 'Data barang berhasil dihapus!');
    }
    public function penjualdestroy(Penjual $penjual)
    {
        $penjual->delete();

        return redirect()->route('HalamanReadPenjual')->with('success', 'Data penjual berhasil dihapus!');
    }
    public function userdestroy(User $user)
    {
        $user->delete();

        return redirect()->route('HalamanReadPembeli')->with('success', 'Data pembeli berhasil dihapus!');
    }

    public function HalamanReadBarang()
    {
        $barangs = Barang::all();
        return view("User/Read Data/HalamanBarang", compact("barangs"));
    }

    public function HalamanReadPembeli()
    {
        // Initialize the base query
        $query = User::query();

        // Check if a specific role filter is applied
        if (isset($role)) {
            $query->where('role', $role);
        }

        // Get the list of users based on the query
        $users = $query->get();

        // Filter users with the role 'pembeli'
        $pembeli = $users->where('role', 'pembeli');

        // Pass both the full list of users and the filtered list to the view
        return view("User/Read Data/HalamanPembeli", compact("users", "pembeli"));
    }


    public function HalamanReadPenjual()
    {
        $penjuals = Penjual::all();
        return view("User/Read Data/HalamanPenjual", compact("penjuals"));
    }

    public function HalamanUbahBarang($id)
    {
        $barang = Barang::findOrFail($id);
        return view('User.Edit.HalamanEditBarang', compact('barang'));
    }

    // Method to handle the update request

public function MemperbaruiBarangs(Request $request, $id)
{
    $barang = Barang::findOrFail($id);

    // Validasi data
    $validatedData = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jenis_barang' => 'required|string|max:255',
        'harga_barang' => 'required|numeric',
        'jumlah_barang' => 'required|integer',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle upload gambar jika ada gambar baru
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($barang->image && Storage::exists('public/images/' . $barang->image)) {
            Storage::delete('public/images/' . $barang->image);
        }

        // Simpan gambar baru dan update path gambar di database
        $path = $request->file('image')->store('images', 'public');

        // Update path gambar di data yang divalidasi
        $validatedData['image'] = '/' . basename($path);
    }

    // Update detail barang dengan data yang divalidasi
    $barang->update($validatedData);

    return redirect()->route('HalamanReadBarang')->with('success', 'Barang updated successfully.');
    }

    public function HalamanUbahUser($id)
    {
        $user = User::findOrFail($id);
        return view('User.Edit.HalamanEditUser', compact('user'));
    }
    public function MemperbaruiUsers(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // Password tidak wajib
        ]);

        // Update detail pengguna
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        return redirect()->route('HalamanReadPembeli')->with('success', 'User updated successfully.');
    }

    public function HalamanUbahPenjual($id)
    {
        $penjual = Penjual::findOrFail($id);
        return view('User.Edit.HalamanEditPenjual', compact('penjual'));
    }
    public function MemperbaruiPenjuals(Request $request, $id)
    {
        $penjual = Penjual::findOrFail($id);

        // Validasi data
        $validatedData = $request->validate([
            'nama_penjual' => 'required|string|max:255',
            'password_penjual' => 'nullable|string|min:6',
            'alamat_penjual' => 'required|string|max:255',
            'no_hp_penjual' => 'required|string|max:15',
            'email_penjual' => 'required|string|email|max:255|unique:penjuals,email_penjual,'.$id,
            'jk_penjual' => 'required|in:Laki-laki,Perempuan',
            // Add other validations as needed
        ]);

        $penjual = Penjual::findOrFail($id);
        $penjual->nama_penjual = $request->nama_penjual;
        $penjual->alamat_penjual = $request->alamat_penjual;
        $penjual->no_hp_penjual = $request->no_hp_penjual;
        $penjual->email_penjual = $request->email_penjual;
        $penjual->jk_penjual = $request->jk_penjual;

        if (!empty($validatedData['password_penjual'])) {
            $penjual->password = Hash::make($validatedData['password_penjual']);
        }

        $penjual->save();

        return redirect()->route('HalamanReadPenjual')->with('success', 'Data penjual berhasil diperbarui.');
    }
}
