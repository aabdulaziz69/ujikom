@extends('temp')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Barang</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('barang') }}">Data Barang</a>
                </li>
            </ul>
        </div>
        {{-- @if (auth()->check())
            <p>Welcome, {{ auth()->user()->name }}</p>
        @else
            <p>Welcome, Guest</p>
        @endif --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        <!-- Tambah User Button -->
                        <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">Tambah Barang</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="barang-datatables" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Gambar</th>
                                        <th>Barcode</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Diskon</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $item)
                                        <tr>
                                            <td>{{ $item->id_barang }}</td>
                                            <td>
                                                @if ($item->gambar)
                                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                                        alt="{{ $item->nama_barang }}" width="130" class="img-thumbnail">
                                                @else
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                            <td>{!! QrCode::size(150)->generate($item->id_barang) !!}
                                            </td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>Rp {{ number_format($item->harga_barang, 0, ',', '.') }}</td>
                                            <td>
                                                {{ $item->diskon ? $item->diskon . '%' : '0%' }}
                                            </td> <!-- Tampilkan diskon -->
                                            <td class="text-center">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('barang.edit', $item->id_barang) }}"
                                                    class="btn btn-warning btn-sm me-1">Edit</a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('barang.destroy', $item->id_barang) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm show-confirm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#barang-datatables").DataTable();

        });
        document.addEventListener('DOMContentLoaded', function() {
            // ✅ Toast setelah aksi sukses
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            // ❗ SweetAlert untuk tombol hapus
            const deleteButtons = document.querySelectorAll('.show-confirm');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data user akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
