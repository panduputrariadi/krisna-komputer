<div class="card mt-3 overflow-x-auto rounded-0">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#createProduct"><i
                    class="uil uil-plus-square"></i> Produk
            </button>
            <form class="d-flex" role="search" method="get">
                <input class="form-control me-2 rounded-0" type="search" placeholder="Search" aria-label="Search" name="keyword">
                <button class="btn btn-outline-primary rounded-0" type="submit">Search</button>
            </form>
        </div>
        @include('Modals.CreateProductModal')
        <table class="table overflow-x-auto">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Seri Produk</th>
                    <th scope="col">Kategori Produk</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($data->photo->count() > 0)
                                <div id="carousel{{ $data->id }}" class="carousel slide" data-bs-ride="carousel"
                                    style="width: 100px;">
                                    <div class="carousel-inner" style="width: 100px;">
                                        @foreach ($data->photo as $key => $photo)
                                            <div class="carousel-item{{ $key == 0 ? ' active' : '' }}">
                                                <img src="{{ asset('storage/' . $photo->path) }}"
                                                    alt="Image {{ $key + 1 }}"
                                                    style="width: 100px; height: 100px;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel{{ $data->id }}" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel{{ $data->id }}" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            @endif
                        </td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ Str::limit($data->seriesproduct['seri'], 20, '...') }}</td>
                        <td>{{ $data->category['kategori'] }}</td>

                        <td>{{ $data->stok }}</td>
                        <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>

                        <td>
                            <a href="product/{{ $data->id }}" data-confirm-delete="true"
                                class="delete-confirmation"><button type="button" class="btn btn-danger rounded-0"><i
                                        class="uil uil-trash-alt"></i></button></a>
                            <a href="" data-bs-toggle="modal"
                                data-bs-target="#updateProduct{{ $data->id }}"><button type="button"
                                    class="btn btn-warning rounded-0"><i class="uil uil-edit"></i></button></a>
                        </td>
                    </tr>
                    @include('Modals.UpdateProductModal')
                @endforeach
            </tbody>
        </table>
        {{ $product->links('vendor.pagination.simple-bootstrap-5') }}
    </div>
</div>
