<div class="card mt-3 overflow-x-auto rounded-0">
    <div class="card-body">
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
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cashier as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td>{{ $data->product->nama }} </td>
                            <td>{{ Str::limit($data->product->seriesproduct['seri'], 20, '...') }}</td>
                            <td>{{ $data->product->category->kategori }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>Rp {{ number_format($data->product->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($data->total, 0, ',', '.') }}</td>
                            <td>{{ $data->status }}</td>
                            <td>{{ $data->user->alamat }}</td>
                            <td>
                                <a href="" data-bs-toggle="modal" data-bs-target="#transaction{{ $data->id }}"><button type="button" class="btn btn-warning rounded-0"><i class="uil uil-edit"></i></button></a>
                            </td>
                        </tr>
                        @include('Modals.TransactionModal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
