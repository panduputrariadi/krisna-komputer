<!-- Modal -->
<div class="modal fade" id="updateProduct{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="POST" action="product/{{$data->id}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control rounded-0" name="nama" id="nama"
                            aria-describedby="emailHelp" value="{{ $data->nama }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Seri Produk</label>
                        <select id="series_products_id" name="series_products_id rounded-0" class="form-select">
                            <option value="" disabled>Select Series</option>
                            @foreach ($series as $listSeries)
                                <option
                                    value="{{ $listSeries->id }}"{{ $data->series_products_id == $listSeries->id ? 'selected' : '' }}>
                                    {{ $listSeries->seri }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kategori Produk</label>
                        <select id="categories_id" name="categories_id" class="form-select rounded-0">
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($category as $listCategory)
                            <option
                                value="{{ $listCategory->id }}"{{ $data->categories_id == $listCategory->id ? 'selected' : '' }}>
                                {{ $listCategory->kategori }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input type="number" class="form-control rounded-0" name="harga" id="harga"
                            aria-describedby="emailHelp" value="{{$data->harga}}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Stok</label>
                        <input type="number" class="form-control rounded-0" name="stok" id="stok"
                            aria-describedby="emailHelp" value="{{$data->stok}}">
                    </div>

                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label rounded-0">Foto Produk</label>
                        <input class="form-control" type="file" name="photos[]" id="photos" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-0">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
