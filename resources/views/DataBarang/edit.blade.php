@extends('temp')

@section('content')
    <div class="page-inner">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm rounded-4 border-0">

                    {{-- Card Header --}}
                    <div
                        class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">Edit Barang</h4>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">

                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- Form --}}
                        <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Nama Barang --}}
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control rounded-pill"
                                    value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                                @error('nama_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Harga Barang --}}
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Harga Barang</label>
                                <input type="number" name="harga_barang" class="form-control rounded-pill"
                                    value="{{ old('harga_barang', $barang->harga_barang) }}" required>
                                @error('harga_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Gambar Barang --}}
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Barang</label>
                                <input type="file" name="gambar" class="form-control rounded-pill">
                                @if ($barang->gambar)
                                    <small class="text-muted">Gambar saat ini: <a href="{{ asset('storage/' . $barang->gambar) }}" target="_blank">Lihat</a></small>
                                @endif
                                @error('gambar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Diskon --}}
                            <div class="mb-3">
                                <label for="diskon" class="form-label">Diskon (%)</label>
                                <input type="number" name="diskon" class="form-control rounded-pill" min="0" max="100"
                                    value="{{ old('diskon', $barang->diskon) }}">
                                @error('diskon')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('barang') }}" class="btn btn-danger rounded-pill">Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
                            </div>
                        </form>
                        {{-- End Form --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
