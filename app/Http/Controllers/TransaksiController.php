<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function transaksi()
    {
        $title = "transaksi"; // Corrected typo here

        return view("DataTransaksi/transaksi", compact("title"));
    }
}
