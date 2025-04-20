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
                                    <div class="col-md-4">
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

                                    <div class="col-md-2">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah[]" class="form-control jumlah-barang" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Harga Awal</label>
                                        <input type="text" class="form-control harga-awal" readonly>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Setelah Diskon</label>
                                        <input type="text" class="form-control harga-diskon" readonly>
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
                            <div class="mb-3">
                                <label>Total Setelah Pajak (12%)</label>
                                <input type="text" id="total_pajak" name="total_pajak" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label>Uang Bayar</label>
                                <input type="text" name="uang_bayar" id="uang_bayar" class="form-control" required>
                            </div>
                            {{-- <input type="text" id="uang_bayar" class="form-control" autocomplete="off"> --}}
                            <input type="hidden" id="uang_bayar_hidden" name="uang_bayar">

                            <div class="mb-3">
                                <label>Kembalian / Kurang</label>
                                <input type="text" id="kembalian" name="kembalian" class="form-control" readonly>
                                <input type="hidden" id="kembalian_hidden" name="kembalian_hidden" class="form-control"
                                    readonly>
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

            newItem.querySelector('select').selectedIndex = 0;
            newItem.querySelectorAll('input').forEach(input => input.value = '');

            container.appendChild(newItem);
            hitungTotal();
        });

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

        document.addEventListener('input', function(e) {
            if (
                e.target.classList.contains('barang-select') ||
                e.target.classList.contains('jumlah-barang') ||
                e.target.id === 'uang_bayar'
            ) {
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

                const hargaAwal = harga * jumlah;
                const hargaSetelahDiskon = harga - (harga * diskon / 100);
                const hargaDiskonTotal = hargaSetelahDiskon * jumlah;

                group.querySelector('.harga-awal').value = hargaAwal.toLocaleString('id-ID');
                group.querySelector('.harga-diskon').value = hargaDiskonTotal.toLocaleString('id-ID');

                total += hargaDiskonTotal;
            });

            const pajak = total * 0.12;
            const totalSetelahPajak = total + pajak;

            document.getElementById('total_bayar').value = total.toLocaleString('id-ID');
            document.getElementById('total_pajak').value = totalSetelahPajak.toLocaleString('id-ID');

            const uangBayarInput = document.getElementById('uang_bayar');
            const kembalianInput = document.getElementById('kembalian');
            const kembalianHiddenInput = document.getElementById('kembalian_hidden');

            // const uangBayar = parseFloat(uangBayarInput.value || 0);
            const uangBayar = parseInt(document.getElementById('uang_bayar_hidden').value || 0);
            const selisih = uangBayar - totalSetelahPajak;

            if (!isNaN(selisih)) {
                if (selisih >= 0) {
                    kembalianInput.value = 'Kembalian: Rp ' + selisih.toLocaleString('id-ID');
                    kembalianHiddenInput.value = selisih.toLocaleString('id-ID');
                } else {
                    kembalianInput.value = 'Kurang: Rp ' + Math.abs(selisih).toLocaleString('id-ID');
                    kembalianHiddenInput.value = Math.abs(selisih).toLocaleString('id-ID');
                }
            } else {
                kembalianInput.value = '';
            }
        }

        document.querySelector('form').addEventListener('submit', function() {
            const total = document.getElementById('total_bayar');
            total.value = total.value.replace(/\./g, '');
        });

        // format rupiah
        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }

        document.getElementById('uang_bayar').addEventListener('input', function(e) {
            let raw = e.target.value.replace(/\D/g, ''); // hapus semua kecuali angka
            e.target.value = formatRupiah(raw); // tampilkan dalam format
            document.getElementById('uang_bayar_hidden').value = raw; // simpan asli untuk hitung
            hitungTotal(); // lanjut hitung kembalian
        });
    </script>
@endsection
