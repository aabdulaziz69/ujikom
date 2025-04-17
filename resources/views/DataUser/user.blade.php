@extends('temp')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="page-inner">
        <div class="page-header">
            {{-- <h3 class="fw-bold mb-3">DataTables.Net</h3> --}}
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
                    <a href="{{ route('user') }}">Data User</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        <!-- Tambah User Button -->
                        <a href="{{ route('user.tambah') }}" class="btn btn-primary btn-sm">Tambah User</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="user-datatables" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>

                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span>{{ $user->role }}</span>
                                            </td>
                                            <td class="text-center">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm me-1">
                                                    Edit
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
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
            $("#user-datatables").DataTable({});
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
