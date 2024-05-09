<div class="bg-secondary-cs container-fluid mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Komplain</h1>
        <div class="d-inline-flex">
            <div class="" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name }} Komplain Barang</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-3 mb-5">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive align-middle">
            <table class="table table-bordered text-center mb-0 overflow-x-auto">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Produk</th>
                        <th>Foto</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Deskripsi Komplain Anda</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    @foreach ($complain as $item)
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                {{ $item->cashier->product['nama'] }}
                                {{ Str::limit($item->cashier->product->seriesproduct['seri'], 30, '...') }}
                            </td>
                            <td class="d-flex align-items-center">
                                @if ($item->cashier->product->photo->count() > 0)
                                    <div id="carousel{{ $item->cashier->product->id }}" class="carousel slide "
                                        data-bs-ride="carousel" style="width: 100px;">
                                        <div class="carousel-inner">
                                            @foreach ($item->cashier->product->photo as $key => $photo)
                                                <div class="carousel-item{{ $key == 0 ? ' active' : '' }} ">
                                                    <img src="{{ asset('storage/' . $photo->path) }}"
                                                        alt="Image {{ $key + 1 }}"
                                                        style="width: 100px; height: 100px;"
                                                        class="mx-auto d-block img-fluid ">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel{{ $item->cashier->product->id }}"
                                            role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel{{ $item->cashier->product->id }}"
                                            role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle">Rp {{ number_format($item->cashier->product['harga'], 0, ',', '.') }}</td>
                            <td class="align-middle">{{ $item->cashier['jumlah'] }}</td>
                            <td class="align-middle">Rp {{ number_format($item->cashier['total'], 0, ',', '.') }}</td>
                            <td>{!! nl2br(e($item->kontenKomplain))!!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
