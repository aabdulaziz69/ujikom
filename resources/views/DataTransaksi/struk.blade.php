<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ env('APP_NAME') }} - {{ $title }}</title>

    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>

    <style>
        .table>tbody>tr>td,
        .table>tbody>tr>th {
            A padding: 0px !important;
        }
    </style>

    <div class="container mt-4">
        <div class="card shadow border-0"
            style="max-width: 480px; margin: auto; font-family: 'Courier New', monospace;">
            <div class="card-body">
                <div class="text-center mb-3">
                    <h5 class="mb-0" style="letter-spacing: 1px;">WANDA SUPPLIER</h5>
                    <small class="text-muted">Jl. Mutiara 1 No. 69, Telp: 0851 7409 </small>
                </div>

                <hr class="my-2">

                <div class="mb-2">
                    <small><strong>ID Transaksi:</strong> {{ $transaksi->id_transaksi }}</small><br>
                    <small><strong>Tanggal:</strong>
                        {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i') }}</small>
                </div>

                <hr class="my-2">

                <table class="table"">
                    <thead class="border-bottom">
                        <tr>
                            <th>Barang</th>
                            <th class="">Qty</th>
                            <th class="">Harga</th>
                            {{-- <th class="">Harga Setelah Diskon</th> --}}
                            <th class="">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->detail as $item)
                            <tr>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td class="">{{ $item->jumlah_barang }}</td>
                                <td class="">
                                    @php
                                        if ($item->harga_diskon != $item->harga_awal) {
                                            echo '<s> Rp. ' .
                                                number_format($item->harga_awal, 0, ',', '.') .
                                                '</s>' .
                                                '<br>Disc.' .
                                                $item->barang->diskon .
                                                '% <br>Rp. ' .
                                                number_format($item->harga_diskon, 0, ',', '.');
                                        } else {
                                            echo 'Rp. ' . number_format($item->harga_awal, 0, ',', '.');
                                        }
                                    @endphp

                                </td>

                                {{-- <td class="">
                                    Rp {{ number_format($item->harga_diskon, 0, ',', '.') }}
                                </td> --}}
                                <td class="">
                                    Rp {{ number_format($item->harga_diskon * $item->jumlah_barang, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr class="my-2">

                <div class="text-end mb-3">
                    <h6 class="mb-0"><strong>Total Bayar:</strong> Rp
                        {{ number_format($transaksi->bayar_total, 0, ',', '.') }}</h6>
                </div>

                <div class="text-end mb-3">
                    <div class=" mb-3">
                        <h6 class="mb-0"><strong>Total Setelah Pajak (12%):</strong> Rp
                            {{ number_format($transaksi->total_pajak, 0, ',', '.') }}</h6>
                    </div>
                    <div class="text-end mb-3">
                        <div class=" mb-3">
                            <h6 class="mb-0"><strong>Uang Bayar</strong> Rp
                                {{ number_format($transaksi->uang_bayar, 0, ',', '.') }}</h6>
                        </div>
                        <div class=" mb-3">
                            <h6 class="mb-0"><strong>Kembalian</strong> Rp
                                {{ number_format($transaksi->kembalian, 0, ',', '.') }}</h6>
                        </div>

                        <div class="text-center">
                            <small class="text-muted">Terima kasih telah berbelanja!</small><br>
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

            <script src=" {{ asset('kaiadmin') }}/assets/js/core/jquery-3.7.1.min.js"></script>
            <script src=" {{ asset('kaiadmin') }}/assets/js/core/popper.min.js"></script>
            <script src=" {{ asset('kaiadmin') }}/assets/js/core/bootstrap.min.js"></script>

            <!-- jQuery Scrollbar -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

            <!-- Chart JS -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/chart.js/chart.min.js"></script>

            <!-- jQuery Sparkline -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

            <!-- Chart Circle -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/chart-circle/circles.min.js"></script>

            <!-- Datatables -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/datatables/datatables.min.js"></script>

            <!-- Bootstrap Notify -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

            <!-- jQuery Vector Maps -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/jsvectormap/world.js"></script>

            <!-- Sweet Alert -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

            <!-- Kaiadmin JS -->
            <script src=" {{ asset('kaiadmin') }}/assets/js/kaiadmin.min.js"></script>
            <script src=" {{ asset('kaiadmin') }}/assets/js/plugin/datatables/datatables.min.js"></script>



            <script>
                $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#177dff",
                    fillColor: "rgba(23, 125, 255, 0.14)",
                });

                $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#f3545d",
                    fillColor: "rgba(243, 84, 93, .14)",
                });

                $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#ffa534",
                    fillColor: "rgba(255, 165, 52, .14)",
                });
            </script>
</body>

</html>
