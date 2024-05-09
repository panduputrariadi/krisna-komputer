<div class="container-fluid bg-secondary-cs mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout Barang</h1>
        <div class="d-inline-flex">
            <div class="" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name }} Checkout</li>
                </ol>
            </div>
        </div>
    </div>
</div>

@if ($chart->isEmpty())
<div class="container-fluid" style="height: 300px;">
    <table class="table table-bordered text-center mb-5 overflow-x-auto" >
        <thead class="bg-secondary text-dark">
            <tr>
                <th>Produk</th>
                <th>Foto</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
</div>
@else
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <small id="emailHelp" class="form-text text-muted" style="font-style: italic; color: #999;">Jika pelanggan membeli 2 barang, maka unggah bukti pembayaran dengan nominal total semua pembelanjaan serta bisa beri catatan pada formuir unggah bukti pembayaran</small>
            <br>
            <small id="emailHelp" class="form-text text-muted" style="font-style: italic; color: #999;">Dimohon untuk transfer pembayaran melalui nomor rekening sebagai berikut:</small>
            <div class="row">
                <div class="col">
                    <li><small class="text-muted">Dana: 0881 0824 24608</small></li>
                    <li><small class="text-muted">Bank BRI ke Dana:8881 0 0881 0824 24608</small></li>
                    <li><small class="text-muted">Bank BNI ke Dana:8810 0881 0824 24608</small></li>
                </div>
                <div class="col">
                    <li><small class="text-muted">Bank BCA ke Dana:3901 0881 0824 24608</small></li>
                    <li><small class="text-muted">Bank Mandiri ke Dana:8950 8 0881 0824 24608</small></li>
                    <li><small class="text-muted">Bank Danamon ke Dana:8528 0881 0824 24608</small></li>
                </div>
            </div>
            <small id="emailHelp" class="form-text text-muted" style="font-style: italic; color: #999;">Tangkap Layar bukti transfer atau ScreenShoot bukti transfer dan unggah bukti tersebut dengan klik tombol "unggah pembayaran"</small>
            <div class="col-lg-8 mt-3">
                <div class="mb-4">
                    @if (!$chart->isEmpty() && $chart->first()->user)
                        <h4 class="font-weight-semi-bold mb-2">Informasi Pembeli</h4>
                        <div class="row">
                            <div class="col">
                                <label for="">Nama</label>
                                <input type="text" class="form-control mt-2 mb-3 rounded-0"
                                    placeholder="{{ $chart->first()->user->name }}" aria-label="First name" disabled>

                                <label for="">Email</label>
                                <input type="email" class="form-control mt-2 mb-3 rounded-0"
                                    placeholder="Email Address" value="{{ $chart->first()->user->email }}"
                                    name="email" disabled>
                            </div>
                            <div class="col">
                                <label for="">Nomor Telepon</label>
                                <input type="text" class="form-control mt-2 mb-3 rounded-0"
                                    value="{{ $chart->first()->user->no_hp }}" disabled>

                                <label for="">Alamat</label>
                                <input type="text" class="form-control mt-2 mb-3 rounded-0"
                                    value="{{ $chart->first()->user->alamat }}" disabled>
                            </div>
                        </div>

                    @endif

                </div>

            </div>
            <div class="col-lg-4 mt-3">
                @foreach ($chart as $data)
                    <div class="card mb-5 rounded-0">
                        <div class="card-header">
                            <h4 class="font-weight-semi-bold m-0">Total Pemesanan</h4>
                        </div>

                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3 border-bottom">Produk</h5>
                            <div class="d-flex justify-content-between border-bottom">
                                <p>{{ $data->product->nama }}
                                    {{ Str::limit($data->product->seriesproduct['seri'], 20, '...') }}</p>
                                <p>{{ $data->jumlah }}</p>
                                <p>Rp {{ number_format($data->product->harga, 0, ',', '.') }}</p>
                            </div>
                            <h6 class="mt-2">Total</h6>
                            <div class="d-flex justify-content-between ">
                                <p>Checkout</p>
                                <p>Rp {{ number_format($data->total, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary font-weight-bold my-3 py-3 rounded-0" data-bs-toggle="modal"
                                data-bs-target="#placeOrder{{ $data->id }}">Unggah Pembayaran</button>
                        </div>
                        @include('Modals.PlaceOrder')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
