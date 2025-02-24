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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/proses-login', [AuthController::class, 'proses'])->name('proses.login');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/barang', [BarangController::class, 'barang'])->name('barang');
Route::get('/transaksi', [TransaksiController::class, 'transaksi'])->name('transaksi');

// User
Route::get('/user', [UserController::class, 'user'])->name('user');

Route::get('user/tambah', [UserController::class, 'create'])->name('user.tambah');

Route::post('user', [UserController::class, 'store'])->name('user.store');




