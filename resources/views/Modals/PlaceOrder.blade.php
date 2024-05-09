<!-- Modal -->
<div class="modal fade" id="placeOrder{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir unggah bukti pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" action="{{ url('uploadPayment/' . $data->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Unggah Bukti Pembayaran</label>
                        <input class="form-control rounded-0" type="file" id="photo" name="photo" required>
                    </div>
                    <label for="formFile" class="form-label">Catatan Pembelian</label>
                    <div class="form-floating mb-3">
                        <textarea class="form-control rounded-0" placeholder="Leave a comment here" id="floatingTextarea2" name="keterangan" style="height: 100px"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-0">Unggah</button>
                </form>
            </div>
        </div>
    </div>
</div>
