<!-- Modal -->
<div class="modal fade" id="complainProduct{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Komplain Pembelian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" action="complain/{{$item->id}}">
                    @csrf
                    @method('POST')
                    <small id="emailHelp" class="form-text text-muted" style="font-style: italic; color: #999;">Cantumkan vidio unboxing produk ataupun barang yang telah dibeli. Vidio diupload pada google drive dan cantumkan link google drive pada formulir komplain dibawah</small>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Deskripsi Komplain Produk</label>
                        <textarea class="form-control rounded-0"  id="floatingTextarea2" name="kontenKomplain" style="height: 100px"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-0">Komplain</button>
                </form>
            </div>
        </div>
    </div>
</div>
