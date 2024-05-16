<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\http\Controllers\userController;
use App\http\Controllers\pembeliController;
use App\http\Controllers\penjualController;
use App\http\Controllers\barangController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\checkoutController;
use Illuminate\Routing\Route as RoutingRoute;

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
    return redirect('Transaksi')->with('message', 'Selamat Datang');
});

//Index
// web.php
Route::get('/Transaksi', [Controller::class, 'welcome'])->name('Pembelian');
Route::get('/Transaksi', [Controller::class, 'index'])->name('Pembelian');
Route::get('/Transaksi/keranjang', [Controller::class, 'keranjang'])->name('keranjang');
Route::post('/Transaksi/keranjang', [Controller::class, 'keranjang']);

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
Route::delete('/halamanUser/{penjual}', [UserController::class, 'penjualdestroy'])->name('penjualdestroy');
Route::delete('/halamanUser/{pembeli}', [UserController::class, 'pembelidestroy'])->name('pembelidestroy');

//Barang
Route::get('Penjual/tambahbarang/tambahBarang', [barangController::class, 'HalamanTambahBarang'])->name('HalamanTambahBarang');
Route::post('Penjual/tambahbarang/tambahBarang', [barangController::class, 'tambahBarang'])->name('tambahBarang');
Route::get('/transaksi/index', [barangController::class, 'search'])->name('search');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('destroy');

//Keranjang
Route::get('/keranjang/index', [KeranjangController::class, 'HalamanKeranjang'])->name('HalamanKeranjang');
Route::post('/keranjang/index/tambah', [KeranjangController::class, 'TambahKeKeranjang'])->name('TambahKeKeranjang');
Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
Route::post('/keranjang/index', [KeranjangController::class, 'destroy'])->name('Keranjang.destroy');

//checkoutcontroller
Route::post('/Keranjang/suksesPembayaran', [CheckoutController::class, 'HalamanCheckout'])->name('HalamanCheckout');
Route::get('/Keranjang/suksesPembayaran', [CheckoutController::class, 'process'])->name('process');
Route::get('/sukses-pembayaran', function() {
    return view('sukses-pembayaran');
})->name('suksesPembayaran');

//test
Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
Route::delete('/keranjang/{id}', [barangController::class, 'destroy'])->name('destroy');