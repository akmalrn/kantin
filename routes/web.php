<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\http\Controllers\userController;
use App\http\Controllers\pembeliController;
use App\http\Controllers\penjualController;
use App\http\Controllers\barangController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Middleware\PembeliMiddleware;
use App\Http\Controllers\Auth_PembeliController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('Transaksi/halamanPembelian')->with('message', 'Selamat Datang');
});

//Index
// web.php
Route::get('/Transaksi', [Controller::class, 'welcome'])->name('Pembelian');
Route::get('/Transaksi/halamanPembelian', [Controller::class, 'halamanPembelian'])->name('Pembelian');

//loginPembeli
Route::get('Pembeli/registrasiPembeli', [pembeliController::class, 'HalamanRegistrasiPembeli'])->name('HalamanRegistrasiPembeli');
Route::post('Pembeli/registrasiPembeli', [pembeliController::class, 'registrasiPembeli']);
Route::get('Pembeli/loginPembeli', [pembeliController::class, 'HalamanLoginPembeli'])->name('HalamanLoginPembeli');
Route::post('Pembeli/loginPembeli', [pembeliController::class, 'loginPembeli']);

//LoginPenjual
Route::get('Penjual/registrasiPenjual', [penjualController::class, 'HalamanRegistrasiPenjual'])->name('HalamanRegistrasiPenjual');
Route::post('Penjual/registrasiPenjual', [penjualController::class, 'registrasiPenjual']);
Route::get('Penjual/loginPenjual', [penjualController::class, 'HalamanLoginPenjual'])->name('HalamanLoginPenjual');
Route::post('Penjual/loginPenjual', [penjualController::class, 'loginPenjual']);
Route::get('Penjual/halamanPenjual', [penjualController::class, 'halamanPenjual'])->name('halamanPenjual');

//User
Route::get('user/registrasiUser', [userController::class, 'HalamanRegistrasiUser'])->name('HalamanRegistrasiUser');
Route::post('user/registrasiUser', [userController::class, 'registrasiUser']);
Route::get('user/loginUser', [userController::class, 'HalamanLoginUser'])->name('HalamanLoginUser');
Route::post('user/loginUser', [userController::class, 'loginUser']);
Route::get('user/halamanUser', [userController::class, 'halamanUser'])->name('halamanUser');
Route::delete('/halamanUser/{barang}', [UserController::class, 'barangdestroy'])->name('barangdestroy');
Route::delete('/User/Read Data/HalamanPenjual/{penjual}', [UserController::class, 'penjualdestroy'])->name('penjualdestroy');
Route::delete('User/Read Data/HalamanPembeli/{user}', [UserController::class, 'userdestroy'])->name('userdestroy');
Route::get('User/Read Data/HalamanBarang', [userController::class, 'HalamanReadBarang'])->name('HalamanReadBarang');
Route::get('User/Read Data/HalamanPembeli', [userController::class, 'HalamanReadPembeli'])->name('HalamanReadPembeli');
Route::get('User/Read Data/HalamanPenjual', [userController::class, 'HalamanReadPenjual'])->name('HalamanReadPenjual');
Route::get('User/Edit/{id}/HalamanEditBarang', [userController::class, 'HalamanUbahBarang'])->name('HalamanUbahBarang');
Route::put('User/Edit/{id}/HalamanEditBarang', [userController::class, 'MemperbaruiBarangs'])->name('MemperbaruiBarangs');
Route::get('User/Edit/{id}/HalamanEditUser', [userController::class, 'HalamanUbahUser'])->name('HalamanUbahUser');
Route::put('User/Edit/{id}/HalamanEditUser', [userController::class, 'MemperbaruiUsers'])->name('MemperbaruiUsers');
Route::get('User/Edit/{id}/HalamanEditPenjual', [userController::class, 'HalamanUbahPenjual'])->name('HalamanUbahPenjual');
Route::put('User/Edit/{id}/HalamanEditPenjual', [userController::class, 'MemperbaruiPenjuals'])->name('MemperbaruiPenjuals');

//Barang
Route::get('Penjual/tambahbarang/tambahBarang', [barangController::class, 'HalamanTambahBarang'])->name('HalamanTambahBarang');
Route::post('Penjual/tambahbarang/tambahBarang', [barangController::class, 'tambahBarang'])->name('tambahBarang');
Route::get('/transaksi/halamanPembelian', [barangController::class, 'search'])->name('search');
Route::get('/transaksi/halamanDefinisi/{id}', [BarangController::class, 'HalamanDefinisiBarang'])->name('HalamanDefinisiBarang');

//Keranjang
Route::get('/Keranjang/index', [KeranjangController::class, 'HalamanKeranjang'])->name('HalamanKeranjang');
Route::get('/Keranjang/halamanKeranjang', [KeranjangController::class, 'HalamanKeranjang2'])->name('HalamanKeranjang2');
Route::post('/tambah-ke-keranjang', [KeranjangController::class, 'TambahKeKeranjang'])->name('TambahKeKeranjang');
Route::delete('/Keranjang/{id}', [KeranjangController::class, 'destroyKeranjang'])->name('destroyKeranjang');
Route::delete('/Keranjang/halamanKeranjang/{id}', [KeranjangController::class, 'destroyKeranjang2'])->name('destroyKeranjang2');

//checkoutcontroller
Route::post('/Keranjang/halamanKeranjang', [CheckoutController::class, 'process'])->name('process');

//Transaksi
Route::get('/transaksi/halamanTransaksi', [TransaksiController::class, 'halamanTransaksi'])->name('HalamanTransaksi');

//route middwlare
Route::get('/definisibarang', function () {
    // Halaman definisi barang
})->middleware([PembeliMiddleware::class, 'auth']);


//Logout Pembeli
Route::post('/transaksi/halamanPembelian', [Auth_PembeliController::class, 'logout'])->name('logout');      
//Logout Admin
Route::post('/logout-admin', [UserController::class, 'logoutUser'])->name('logoutUser');  


Route::post('/logout-pembeli', [Auth_PembeliController::class, 'logoutya'])->name('logoutya'); 