<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function barang()
    {
        $title = "barang"; // Corrected typo here

        return view("Databarang/barang", compact("title"));
    }
}
