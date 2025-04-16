@extends('temp')

@section('content')

<div class="page-inner">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm rounded-4 border-0">

                {{-- Card Header --}}
                <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-white">{{ $title }}</h4>
                </div>

                {{-- Card Body --}}
                <div class="card-body">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama Barang --}}
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control rounded-pill" value="{{ old('nama_barang') }}" required>
                            @error('nama_barang') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Harga Barang --}}
                        <div class="mb-3">
                            <label for="harga_barang" class="form-label">Harga Barang</label>
                            <input type="number" name="harga_barang" class="form-control rounded-pill" value="{{ old('harga_barang') }}" required>
                            @error('harga_barang') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Gambar Barang --}}
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Barang</label>
                            <input type="file" name="gambar" class="form-control rounded-pill">
                            @error('gambar') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Barcode (Opsional) --}}
                        <div class="mb-3">
                            <label for="barcode" class="form-label">Barcode (Opsional)</label>
                            <input type="text" name="barcode" class="form-control rounded-pill" value="{{ old('barcode') }}">
                            @error('barcode') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

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
