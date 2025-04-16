@extends('temp')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0" style="max-width: 400px; margin: auto;">
        <div class="card-body">
            <h4 class="text-center mb-0">WANDA SUPPLIER</h4>
            <p class="text-center">Jl. Mutira 1 No. 69</p>
            <hr>
            <p><strong>ID Transaksi:</strong> {{ $transaksi->id_transaksi }}</p>
            <p><strong>Tanggal:</strong> {{ $transaksi->tanggal_transaksi }}</p>
            <p><strong>Nama Pembeli:</strong> {{ $transaksi->nama_pembeli }}</p>
            <p><strong>Jumlah Barang:</strong> {{ $transaksi->jumlah_barang }}</p>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($transaksi->bayar_total, 0, ',', '.') }}</p>
            <hr>
            <p class="text-center mb-0">Terima kasih telah berbelanja!</p>
        </div>
        <div class="card-footer text-center">
            <button onclick="window.print()" class="btn btn-primary btn-sm">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>
</div>
@endsection
