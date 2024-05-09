<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Category {{$category['kategori']}}</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($product as $data)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">

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
                        <a href="{{ route('detailProduct', ['id' => $data->id]) }}" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-eye text-dark mr-1"></i> View Detail
                        </a>
                        <a href="" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-shopping-cart text-dark mr-1">
                            </i> Add To Cart
                        </a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>
