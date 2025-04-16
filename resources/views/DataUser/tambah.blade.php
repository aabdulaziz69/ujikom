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

                    {{-- Form Start --}}
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control rounded-pill" value="{{ old('name') }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control rounded-pill" value="{{ old('username') }}" required>
                            @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control rounded-pill" value="{{ old('email') }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control rounded-pill" required>
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-pill" required>
                        </div>

                        {{-- Role (Opsional, kalau mau aktifkan tinggal buka komen ini) --}}
                        {{--
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-select rounded-pill" required>
                                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        --}}

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user') }}" class="btn btn-danger rounded-pill">Kembali</a>
                            <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
                        </div>
                    </form>
                    {{-- Form End --}}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
