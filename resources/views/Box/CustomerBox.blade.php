<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check .text-warning-emphasis m-0 me-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast .text-warning-emphasis m-0 me-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt .text-warning-emphasis m-0 me-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume .text-warning-emphasis m-0 me-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Daftar Kategori</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($categories as $category)
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-end">{{ $category->total_products }} Produk Tersedia</p>
                    <a href="categoryProduct/{{ $category->id }}"
                        class="cat-img position-relative overflow-hidden mb-3">
                        {{-- ambil salah satu foto --}}
                        @if ($category->product->isNotEmpty())
                            <img class="img-fluid"
                                src="{{ asset('storage/' . $category->product->first()->photo->first()->path) }}"
                                alt="">
                        @else
                            <p>No product available</p>
                        @endif
                    </a>
                    <h5 class="font-weight-semi-bold m-0">{{ $category->kategori }}</h5>
                </div>
            </div>
        @endforeach
    </div>
</div>


<div class="container-fluid pt-5" id="produk">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Semua Produk</span></h2>
    </div>
    <div class="row px-xl-6 pb-3">
        @foreach ($product as $data)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1" id="">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <div id="carousel-{{ $data->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($data->photo as $index => $photo)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img class="d-block w-100" src="{{ asset('storage/' . $photo->path) }}"
                                            alt="Product Image" style="height:400px;">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel-{{ $data->id }}" role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next " href="#carousel-{{ $data->id }}" role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3 border">
                        <h6 class="text-truncate mb-3">{{ $data->nama }}
                            {{ Str::limit($data->seriesproduct['seri'], 20, '...') }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>Rp {{ number_format($data->harga, 0, ',', '.') }}</h6>
                            <h6 class="text-muted ml-2"></h6>
                        </div>
                    </div>
                    <div class="bg-transparent card-footer d-flex justify-content-between border">
                        <a href="detailProduct/{{ $data->id }}" class="btn btn-sm text-dark p-0"><i
                                class="fas fa-eye text-dark mr-1"></i> Lihat Detail</a>

                        <form action="{{ route('customerItem', $data->id) }}" method="post">
                            @csrf
                            <div class="">
                                <div class="input-group quantity mr-3" style="width: 130px;">
                                    <input type="number" class="form-control text-center" value="1" style="border-radius: 0px;" name="jumlah" hidden>
                                </div>
                                <button type="submit" class="btn btn-sm text-dark p-0" style="border: none; background: none; padding: 0; margin: 0; display: inline;"><i class="fas fa-shopping-cart text-dark mr-1"></i> Tambah Ke Keranjang</button>
                                {{-- <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-dark mr-1"></i> Tambah Ke Keranjang</a> --}}
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>
