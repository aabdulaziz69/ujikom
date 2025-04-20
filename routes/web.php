<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/proses-login', [AuthController::class, 'proses'])->name('proses.login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/transaksi', [TransaksiController::class, 'transaksi'])->name('transaksi');


    //barang
    Route::get('/barang', [BarangController::class, 'barang'])->name('barang');

    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');

    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('barang', [BarangController::class, 'store'])->name('barang.store');

    // User
    Route::get('/user', [UserController::class, 'user'])->name('user');

    Route::get('user/tambah', [UserController::class, 'create'])->name('user.tambah');

    Route::post('user/tambah', [UserController::class, 'store'])->name('user.store');
    //edit user
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{user}', [UserController::class, 'update'])->name('user.update');

    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');


    //transaksi
    // Tampilkan form tambah transaksi
    Route::get('/transaksi/tambah', [TransaksiController::class, 'create'])->name('transaksi.tambah');

    // Proses simpan transaksi
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');

    Route::delete('/transaksi/{id_transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('/transaksi/tambah-qr', [TransaksiController::class, 'createQr'])->name('transaksi.tambah-qr');
});
