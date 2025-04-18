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

                            <div id="barang-container">
                                <div class="row mb-3 barang-group">
                                    <div class="col-md-6">
                                        <label>Nama Barang</label>
                                        <select name="barang_id[]" class="form-select barang-select" required>
                                            <option value="">-- Pilih Barang --</option>
                                            @foreach ($barangs as $barang)
                                                <option value="{{ $barang->id_barang }}"
                                                    data-harga="{{ $barang->harga_barang }}"
                                                    data-diskon="{{ $barang->diskon }}">

                                                    {{ $barang->nama_barang }} - Rp
                                                    {{ number_format($barang->harga_barang, 0, ',', '.') }}
                                                    @if ($barang->diskon > 0)
                                                        - Diskon {{ $barang->diskon }}%
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah[]" class="form-control jumlah-barang" required>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-barang">Hapus</button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="tambah-barang" class="btn btn-primary mb-3">+ Tambah Barang</button>

                            <div class="mb-3">
                                <label>Total Bayar <i>(sudah termasuk diskon)</i> </label>
                                <input type="text" name="bayar_total" id="total_bayar" class="form-control" readonly>
                            </div>

                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('transaksi') }}" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
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


        document.getElementById('tambah-barang').addEventListener('click', function() {
            const container = document.getElementById('barang-container');
            const newItem = document.querySelector('.barang-group').cloneNode(true);

            // Reset inputan
            newItem.querySelector('select').value = '';
            newItem.querySelector('input').value = '';

            container.appendChild(newItem);
            hitungTotal();
        });

        // Hapus barang
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-barang')) {
                const group = e.target.closest('.barang-group');
                const container = document.getElementById('barang-container');
                if (container.children.length > 1) {
                    group.remove();
                    hitungTotal();
                }
            }
        });

        // Hitung total saat ganti barang atau jumlah
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('barang-select') || e.target.classList.contains('jumlah-barang')) {
                hitungTotal();
            }
        });

        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('.barang-group').forEach(group => {
                const select = group.querySelector('.barang-select');
                const harga = parseFloat(select.options[select.selectedIndex]?.dataset?.harga || 0);
                const diskon = parseFloat(select.options[select.selectedIndex]?.dataset?.diskon || 0);
                const jumlah = parseInt(group.querySelector('.jumlah-barang').value || 0);

                // Hitung harga setelah diskon
                const hargaSetelahDiskon = harga - (harga * diskon / 100);

                total += hargaSetelahDiskon * jumlah;
            });

            document.getElementById('total_bayar').value = total.toLocaleString('id-ID');
        }
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
