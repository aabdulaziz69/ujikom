@extends('temp')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('transaksi') }}">Data Transaksi</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">Tambah Transaksi</li>
            </ul>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h4 class="card-title mb-0 text-white">{{ $title }}</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Terjadi kesalahan!</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <select name="nama_barang" id="nama_barang" class="form-select rounded-pill" required>
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id_barang }}" data-harga="{{ $barang->harga_barang }}" data-diskon="{{ $barang->diskon }}">
                                            {{ $barang->nama_barang . ' - Rp ' . number_format($barang->harga_barang, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" name="jumlah_barang" id="jumlah_barang"
                                    class="form-control rounded-pill" required>
                            </div>

                            <div class="mb-3">
                                <label for="bayar_total" class="form-label">Total Bayar</label>
                                <input type="text" name="bayar_total" id="total_bayar" class="form-control rounded-pill"
                                    readonly>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="id" class="form-label">Petugas</label>
                                <select name="id" class="form-select rounded-pill" required>
                                    <option value="">-- Pilih Petugas --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <input type="hidden" name="id" class="form-control rounded-pill"
                                value = "{{ auth()->user()->id }}" type = "hidden">

                            {{-- <div class="mb-3">
                                <label for="bayar_total" class="form-label">Total Bayar</label>
                                <input type="number" name="bayar_total" class="form-control rounded-pill" required>
                            </div> --}}

                            {{-- <div class="mb-3">
                                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                                <input type="datetime-local" name="tanggal_transaksi" class="form-control rounded-pill"
                                    required>
                            </div> --}}

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('transaksi') }}" class="btn btn-danger rounded-pill">Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectBarang = document.getElementById('nama_barang');
        const jumlahInput = document.getElementById('jumlah_barang');
        const totalBayar = document.getElementById('total_bayar');

        function hitungTotal() {
            const selectedOption = selectBarang.options[selectBarang.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const diskon = parseFloat(selectedOption.getAttribute('data-diskon')) || 0;
            const jumlah = parseInt(jumlahInput.value) || 0;

            const subtotal = harga * jumlah;
            const potongan = subtotal * (diskon / 100);
            const total = subtotal - potongan;

            totalBayar.value = total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
        }

        selectBarang.addEventListener('change', hitungTotal);
        jumlahInput.addEventListener('input', hitungTotal);
    });
</script>
@endsection













{{-- @extends('temp')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="{{ route('transaksi') }}">Data Transaksi</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item">Tambah Transaksi</li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header"><h4 class="card-title">{{ $title }}</h4></div>
                <div class="card-body">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pembeli</label>
                            <input type="text" name="nama_pembeli" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Barang</label>
                            <input type="number" name="jumlah_barang" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>User</label>
                            <select name="id" class="form-control" required>
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Total Bayar</label>
                            <input type="number" name="bayar_total" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <input type="datetime-local" name="tanggal_transaksi" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <a href="{{ route('transaksi') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
