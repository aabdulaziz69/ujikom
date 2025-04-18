<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon; // opsional, tapi bisa bantu kalau mau custom


class TransaksiController extends Controller
{


    public function transaksi()
    {
        $title = "Transaksi";

        $query = DB::table('transaksi')
            ->join('barang', 'transaksi.id_barang', '=', 'barang.id_barang')
            ->join('users', 'transaksi.id', '=', 'users.id')
            ->select(
                'transaksi.*',
                'barang.nama_barang',
                'barang.harga_barang',
                'users.name as nama_user'
            );

        // Cek role user yang login
        if (Auth::user()->role === 'petugas') {
            $query->where('transaksi.id', Auth::id());
        }

        $transaksi = $query->get();

        return view("DataTransaksi.transaksi", compact("transaksi", "title"));
    }




    public function create()
    {
        $title = "Tambah Transaksi";
        $users = User::all(); // untuk dropdown user
        $barangs = Barang::all(); // untuk dropdown user
        return view('DataTransaksi.tambah', compact('title', 'users', 'barangs'));
    }

    public function store(Request $request)
{
    $transaksi = Transaksi::create([
        'id' => $request->id,
        'bayar_total' => str_replace('.', '', $request->bayar_total), // hilangkan titik
        'tanggal_transaksi' => now(),
    ]);

    foreach ($request->barang_id as $index => $id_barang) {
        if ($id_barang) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_barang' => $id_barang,
                'jumlah_barang' => $request->jumlah[$index],
            ]);
        }
    }

    return redirect()->route('transaksi')->with('success', 'Transaksi berhasil disimpan!');
}


    public function update(Request $request, $id)
{
    $request->validate([
        'nama_barang' => 'required|exists:barang,id_barang',
        'jumlah_barang' => 'required|numeric|min:1',
        'diskon' => 'nullable|numeric|min:0|max:100',
    ]);

    $barang = Barang::findOrFail($request->nama_barang);

    $subtotal = $barang->harga_barang * $request->jumlah_barang;
    $potongan = ($subtotal * ($request->diskon ?? 0)) / 100;
    $total = $subtotal - $potongan;

    $transaksi = Transaksi::findOrFail($id);

    $transaksi->update([
        'id_barang' => $request->nama_barang,
        'jumlah_barang' => $request->jumlah_barang,
        'diskon' => $request->diskon ?? 0,
        'bayar_total' => $total,
        'tanggal_transaksi' => now()->setTimezone('Asia/Jakarta'),
    ]);

    return redirect()->route('transaksi')->with('success', 'Transaksi berhasil diupdate');
}


    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::find($id_transaksi);

        // Cek apakah data transaksi ditemukan
        if (!$transaksi) {
            return redirect()->route('transaksi')->with('error', 'Transaksi tidak ditemukan!');
        }

        // Hapus transaksi
        $transaksi->delete();

        return redirect()->route('transaksi')->with('success', 'Transaksi berhasil dihapus!');
    }


    public function struk($id)
    {
        $title = "Struk";
        $transaksi = Transaksi::findOrFail($id);

        return view('DataTransaksi.struk', compact('transaksi', 'title'));
    }
}
