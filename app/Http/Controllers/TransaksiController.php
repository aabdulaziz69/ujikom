<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
class TransaksiController extends Controller
{
    public function transaksi()
    {
        $title = "Transaksi"; // Corrected typo here
        $transaksi = Transaksi::all();
        return view("DataTransaksi/transaksi", compact("transaksi", "title"));
    }

    public function create()
    {
        $title = "Tambah Transaksi";
        $users = User::all(); // untuk dropdown user
        return view('DataTransaksi.tambah', compact('title', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'jumlah_barang' => 'required|numeric',
            'id' => 'required|exists:users,id',
            'bayar_total' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
        ]);

        Transaksi::create([
            'nama_pembeli' => $request->nama_pembeli,
            'jumlah_barang' => $request->jumlah_barang,
            'id' => $request->id, // foreign key ke user
            'bayar_total' => $request->bayar_total,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect()->route('transaksi')->with('success', 'Transaksi berhasil ditambahkan');
    }
    public function cetakStruk($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('transaksi.struk', compact('transaksi'));
    }
}
