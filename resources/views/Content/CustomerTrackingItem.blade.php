<div class="bg-secondary-cs container-fluid mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Pembelian</h1>
        <div class="d-inline-flex">
            <div class="" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name }} Pembelian Barang
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-3 mb-5">
    <div class="row px-xl-5">
        <small id="emailHelp" class="form-text text-muted" style="font-style: italic; color: #999;">Maksimal durasi
            komplain barang dengan kurun waktu 10 hari dan sertakan vidio unboxing yang di upload di google
            drive. Tombol komplain tidak akan muncul setelah 10 hari pembelian
        </small>
        <div class="col-lg-12 table-responsive align-middle">
            <table class="table table-bordered text-center mb-0 overflow-x-auto">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Produk</th>
                        <th>Foto</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>complain</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($chart as $item)
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                {{ $item->product['nama'] }}
                                {{ Str::limit($item->product->seriesproduct['seri'], 30, '...') }}
                            </td>
                            <td class="d-flex align-items-center">
                                @if ($item->product->photo->count() > 0)
                                    <div id="carousel{{ $item->product->id }}" class="carousel slide "
                                        data-bs-ride="carousel" style="width: 100px;">
                                        <div class="carousel-inner">
                                            @foreach ($item->product->photo as $key => $photo)
                                                <div class="carousel-item{{ $key == 0 ? ' active' : '' }} ">
                                                    <img src="{{ asset('storage/' . $photo->path) }}"
                                                        alt="Image {{ $key + 1 }}"
                                                        style="width: 100px; height: 100px;"
                                                        class="mx-auto d-block img-fluid ">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel{{ $item->product->id }}"
                                            role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel{{ $item->product->id }}"
                                            role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle">Rp {{ number_format($item->product['harga'], 0, ',', '.') }}</td>
                            <td class="align-middle">{{ $item->jumlah }}</td>
                            <td class="align-middle">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            <td>{{ $item->status }}</td>
                            @php

                                $updatedDate = \Carbon\Carbon::parse($item->updated_at);
                                $now = \Carbon\Carbon::now();
                                $daysDifference = $updatedDate->diffInDays($now);
                            @endphp
                            @if ($daysDifference <= 7)
                                <td>
                                    <a href="" data-bs-toggle="modal"
                                    data-bs-target="#complainProduct{{ $item->id }}">
                                    <button type="button" class="btn btn-warning rounded-0"><i
                                            class="uil uil-edit"></i></button>
                                </a>
                                </td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        @include('Modals.ComplainModal')

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
