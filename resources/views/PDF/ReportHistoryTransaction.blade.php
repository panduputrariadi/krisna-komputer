<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}

    <title>Admin Dashboard Product Panel</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 5%;
            margin-top: 3%;
            margin-left: auto;
        }

        .container {
            margin-right: auto;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h5 {
            margin: 0;
        }

        p {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .border-bottom {
            border-bottom: 2px solid #ddd;
        }

        .border-top {
            border-top: 2px solid #ddd;
        }

        .text-center {
            text-align: center;
        }
    </style
</head>

<body>

    <div class="container-fluid p-5 border mt-3 ms-auto">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Laporan Riwayat Pembelian</h5>
                    <br>
                    <p>Jalan Wibisana Utara Gang 1 No 2</p>
                </div>
                <div class="col">
                    <h5>Krisna Komputer</h5>
                </div>
                <div class="col">
                    Total Seluruh Transaksi
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <table style="border-collapse: collapse;">
                <thead>
                    <tr class="border-bottom text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Jumlah Pembelian</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($cashier as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td class="text-center">{{$data->product->nama}} - {{($data->product->seriesproduct['seri']) }} </td>
                            <td class="text-center">{{$data->product->category->kategori}}</td>
                            <td class="text-center">{{$data->jumlah}}</td>
                            <td>{{$data->updated_at->format('M d Y')}}</td>
                            <td>Rp {{ number_format($data->product->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($data->total, 0, ',', '.') }}</td>

                        </tr>
                    @endforeach

                    <tr class="border-top">
                        <th scope="row"></th>
                        <td colspan="6"><strong>Total: </strong></td>
                        <td><strong>Rp {{ number_format($cashier->sum('total'), 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
            <strong>Dicetak pada tanggal : {{$printDate->format('d M Y') }}</strong>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
