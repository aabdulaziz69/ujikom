@extends('temp')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0" style="max-width: 480px; margin: auto; font-family: 'Courier New', monospace;">
        <div class="card-body">
            <div class="text-center mb-3">
                <h5 class="mb-0" style="letter-spacing: 1px;">WANDA SUPPLIER</h5>
                <small class="text-muted">Jl. Mutiara 1 No. 69, Telp: 0851 7409 </small>
            </div>

            <hr class="my-2">

            <div class="mb-2">
                <small><strong>ID Transaksi:</strong> {{ $transaksi->id_transaksi }}</small><br>
                <small><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i') }}</small>
            </div>

            <hr class="my-2">

            <table class="table table-sm mb-0" style="font-size: 14px;">
                <thead class="border-bottom">
                    <tr>
                        <th>Barang</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->detail as $item)
                        <tr>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td class="text-end">{{ $item->jumlah_barang }}</td>
                            <td class="text-end">Rp {{ number_format($item->barang->harga_barang, 0, ',', '.') }}</td>
                            <td class="text-end">
                                Rp {{ number_format($item->barang->harga_barang * $item->jumlah_barang, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="my-2">

            <div class="text-end mb-3">
                <h6 class="mb-0"><strong>Total Bayar:</strong> Rp {{ number_format($transaksi->bayar_total, 0, ',', '.') }}</h6>
            </div>

            <div class="text-center">
                <small class="text-muted">Terima kasih telah berbelanja!</small>
                <br>
                <small class="text-muted">~ Wanda Supplier ~</small>
            </div>
        </div>

        <div class="card-footer text-center border-0">
            <button onclick="window.print()" class="btn btn-outline-primary btn-sm px-4 rounded-pill">
                <i class="fas fa-print me-1"></i> Cetak Struk
            </button>
        </div>
    </div>
</div>
@endsection
