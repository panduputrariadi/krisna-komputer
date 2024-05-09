<div class="container-fluid bg-secondary-cs mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Detail Produk</h1>
        <div class="d-inline-flex">
            <div class="" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->nama }} {{ Str::limit($product->seriesproduct['seri'], 20, '...') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <div id="carousel-{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($product->photo as $index => $photo)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img class="d-block w-100" src="{{ asset('storage/' . $photo->path) }}" alt="Product Image" style="height: 550px;">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel-{{ $product->id }}" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next " href="#carousel-{{ $product->id }}" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">{{$product->nama}} {{$product->seriesproduct['seri']}}</h3>
            <h3 class="font-weight-semi-bold mb-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</h3>
            <h6>Stok Produk: {{$product->stok}}</h6>
            <h4 class="mb-4 mt-3">Deskripsi Porduk</h4>
            <p class="mb-4">{!! nl2br(e(mb_substr($product->seriesproduct['deskripsi'], 0, 400))) !!}
                <span id="full-description" style="display: none;">{!! nl2br(e(mb_substr($product->seriesproduct->deskripsi, 100))) !!}</span>
                <a id="show-more" onclick="showFullDescription()" style="cursor: pointer;" class="ps-1">Lihat lebih banyak</a>
            </p>

            <form action="{{ route('customerItem', $product->id) }}" method="post">
                @csrf
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <input type="number" class="form-control text-center" value="1" style="border-radius: 0px;" name="jumlah">
                    </div>
                    <button class="btn btn-primary px-3 ms-3 rounded-0"><i class="fa fa-shopping-cart mr-1"></i> Tambah Ke Keranjang</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">

        </div>
    </div>
</div>
