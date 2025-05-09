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
            ->join('users', 'transaksi.id', '=', 'users.id')
            ->select(
                'transaksi.*',
                'users.name as nama_user'
            );

        // Cek role user yang login
        if (Auth::user()->role === 'petugas') {
            $query->where('transaksi.id', Auth::id());
        }

        $transaksi = $query->get();
        // $transaksi = "";
        return view("DataTransaksi.transaksi", compact("transaksi", "title"));
    }




    public function create()
    {
        $title = "Tambah Transaksi";
        $users = User::all(); // untuk dropdown user
        $barangs = Barang::all(); // untuk dropdown user
        return view('DataTransaksi.tambah', compact('title', 'users', 'barangs'));
    }

    public function createQr()
    {
        $title = "Tambah Transaksi";
        $users = User::all(); // untuk dropdown user
        $barangs = Barang::all(); // untuk dropdown user
        return view('DataTransaksi.tambah-qr', compact('title', 'users', 'barangs'));
    }



    public function store(Request $request)
    {
        // Membuat transaksi baru
        $transaksi = Transaksi::create([
            'id' => $request->id,
            'bayar_total' => str_replace('.', '', $request->bayar_total), // hilangkan titik
            'total_pajak' => str_replace('.', '', $request->total_pajak), // pajak 12%
            // 'total_setelah_pajak' => str_replace('.', '', $request->total_setelah_pajak), // total setelah pajak
            'uang_bayar' => str_replace('.', '', $request->uang_bayar), // uang bayar
            'kembalian' => str_replace('.', '', $request->kembalian_hidden), // kembalian
            'tanggal_transaksi' => now(),
        ]);

        // Menyimpan detail transaksi untuk setiap barang
        foreach ($request->barang_id as $index => $id_barang) {
            if ($id_barang) {
                // Ambil data barang berdasarkan id_barang
                $barang = Barang::find($id_barang);

                // Hitung harga setelah diskon
                $harga_awal = $barang->harga_barang;
                $diskon = $barang->diskon;
                $harga_diskon = $harga_awal - ($harga_awal * ($diskon / 100));

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_barang' => $id_barang,

                    'harga_awal' => $harga_awal,
                    'harga_diskon' => $harga_diskon, // Simpan harga setelah diskon
                    'jumlah_barang' => $request->jumlah[$index],
                ]);
            }
        }

        // Redirect dengan pesan sukses
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
        $transaksi = Transaksi::with(['detail.barang'])->findOrFail($id);

        return view('DataTransaksi.struk', compact('transaksi', 'title'));
    }
}
