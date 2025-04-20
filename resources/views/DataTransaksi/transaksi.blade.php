@extends('temp')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('transaksi') }}">Data Transaksi</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        @auth
                            @if (auth()->user()->role === 'petugas')
                                <a href="{{ route('transaksi.tambah') }}" class="btn btn-primary btn-sm">Tambah Transaksi</a>
                            @endif
                        @endauth


                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="user-datatables" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Nama Petugas</th>
                                        <th>Total Bayar</th>
                                        <th>Tanggal Transaksi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $trx)
                                        <tr>
                                            <td>{{ $trx->id_transaksi }}</td>
                                            <td>{{ $trx->nama_user }}</td>
                                            <td>{{ $trx->bayar_total }}</td>
                                            <td>{{ $trx->tanggal_transaksi }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('transaksi.struk', $trx->id_transaksi) }}"
                                                        class="btn btn-info btn-sm me-1" target="_blank">
                                                        Struk
                                                    </a>
                                                    @auth
                                                        @if (auth()->user()->role === 'admin')
                                                            <a href="#" class="btn btn-warning btn-sm me-1">Edit</a>

                                                            <form action="{{ route('transaksi.destroy', $trx->id_transaksi) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm show-confirm">Hapus</button>

                                                            </form>
                                                        @endif
                                                    @endauth
                                                </div>
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
            $("#user-datatables").DataTable();
        });

        document.addEventListener('DOMContentLoaded', function() {
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

            const deleteButtons = document.querySelectorAll('.show-confirm');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data transaksi akan dihapus permanen!",
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
