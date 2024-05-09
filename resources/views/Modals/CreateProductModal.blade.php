<!-- Modal -->
<div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" action="product">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control rounded-0" name="nama" id="nama"
                            aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Seri Produk</label>
                        <select id="series_products" name="series_products_id" class="form-select rounded-0">
                            <option value="" disabled selected>Pilih Seri</option>
                            @foreach ($series as $data)
                                <option value="{{ $data->id }}">{{ $data->seri }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kategori Produk</label>
                        <select id="categories" name="categories_id" class="form-select rounded-0">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($category as $data)
                                <option value="{{ $data->id }}">{{ $data->kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input type="text" class="form-control rounded-0" name="harga" id="harga"
                            aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Stok</label>
                        <input type="text" class="form-control rounded-0" name="stok" id="stok"
                            aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Foto Produk</label>
                        <input class="form-control rounded-0" type="file" name="photos[]" id="photos" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-0">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
