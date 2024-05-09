<div class="bg-secondary-cs container-fluid mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">KERANJANG</h1>
        <div class="d-inline-flex">
            <div class="" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name }} Keranjang</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-1">
    <div class="row px-xl-5">
        <small id="emailHelp" class="form-text text-muted" style="font-style: italic; color: #999;">dimohon untuk lakukan proses pembayaran dikarenakan<br> 3 jam setelah penambahan barang ke keranjang, <br> barang tersebut otomatis terhapus</small>
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($chart as $item)
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                {{ $item->product['nama'] }} {{ Str::limit($item->product->seriesproduct['seri'], 30, '...') }}
                            </td>
                            <td class="align-middle">Rp {{ number_format($item->product['harga'], 0, ',', '.') }}</td>
                            <td class="align-middle">{{ $item->jumlah }}</td>
                            <td class="align-middle">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            <td>{{$item->status}}</td>
                            <td class="align-middle">
                                <a href="chart/{{$item->id}}" data-confirm-delete="true" class="delete-confirmation">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="card mb-5 rounded-0">
                <div class="card-header bg-light border-0">
                    <h4 class="font-weight-semi-bold m-0">Ringkasan Keranjang</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">Rp {{ number_format($total, 0, ',', '.') }}</h5>
                    </div>
                    <a href="{{ route('checkout') }}">
                        <button class="btn btn-block btn-primary my-3 py-3 rounded-0">Lakukan Checkout</button>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
