<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function barang()
    {
        $title = "Barang"; // Judul halaman
        $barang = Barang::all(); // Mengambil semua barang
        return view("Databarang/barang", compact("barang", "title"));
    }

    public function create()
    {
        // Menentukan title untuk halaman tambah barang
        $title = 'Tambah Barang';
        return view('DataBarang.tambah', compact('title'));
    }

    // Menampilkan form untuk mengedit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id); // Mencari barang berdasarkan id
        $title = "Edit Barang"; // Judul halaman
        return view('DataBarang.edit', compact('barang', 'title'));
    }

    // Proses untuk memperbarui data barang
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'barcode' => 'nullable|string|max:255',
        ]);

        // Menemukan data barang berdasarkan id
        $barang = Barang::findOrFail($id);

        // Cek jika ada gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
                Storage::disk('public')->delete($barang->gambar);
            }

            // Simpan gambar baru
            $path = $request->file('gambar')->store('barang', 'public');
            $validated['gambar'] = $path;
        }

        // Perbarui data barang
        $barang->update($validated);

        // Kembali ke halaman barang dengan pesan sukses
        return redirect()->route('barang')->with('success', 'Data barang berhasil diperbarui!');
    }

    // Proses untuk menyimpan barang baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'barcode' => 'nullable|string|max:255',
        ]);

        // Jika ada gambar yang diupload
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('barang', 'public');
            $validated['gambar'] = $path;
        }

        // Simpan barang baru
        Barang::create($validated);

        // Kembali ke halaman barang dengan pesan sukses
        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Proses untuk menghapus barang
    public function destroy($id)
    {
        $barang = Barang::find($id);

        // Jika barang tidak ditemukan
        if (!$barang) {
            return redirect()->route('barang')->with('error', 'Barang tidak ditemukan!');
        }

        // Hapus barang
        if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
            Storage::disk('public')->delete($barang->gambar); // Hapus gambar jika ada
        }

        $barang->delete(); // Hapus data barang

        // Kembali ke halaman barang dengan pesan sukses
        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus!');
    }
}
