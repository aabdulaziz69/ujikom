<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $title = "dashboard"; // Corrected typo here
        $totalUser = User::count(); // hitung total user
        $totalBarang = Barang::count(); // hitung total barang
        $totalTransaksi = Transaksi::count(); // hitung total transaksi

        return view('dashboard', compact('title', 'totalUser', 'totalBarang', 'totalTransaksi'));
    }
}
