<div class="card mt-3 overflow-x-auto rounded-0">
    <div class="card-body">
        <div class="border-bottom mb-3">
            <form action="" method="get" class="d-flex">
                <div class="mb-3 ms-2 d-flex">
                    <input type="date" class="form-control rounded-0" aria-describedby="emailHelp" name="keyword">
                    <button class="btn btn-outline-primary rounded-0" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="d-inline-flex">
            <a href="reportTransaction">
                <button type="button" class="btn btn-primary rounded-0 ms-2"><i class="uil uil-file-download"></i>Cetak Semua Transaksi</button>
            </a>
        </div>

        <div class="table-responsive overflow-auto">
            <table class="table table-responsive overflow-x-auto">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Seri Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Jumlah Pembelian</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cashier as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td>{{$data->product->nama}} </td>
                            <td>{{Str::limit($data->product->seriesproduct['seri'], 20, '...') }}</td>
                            <td>{{$data->product->category->kategori}}</td>
                            <td>{{$data->jumlah}}</td>
                            <td>Rp {{ number_format($data->product->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($data->total, 0, ',', '.') }}</td>
                            <td>{{$data->status}}</td>
                            <td>{{$data->updated_at->format(' M d Y')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
