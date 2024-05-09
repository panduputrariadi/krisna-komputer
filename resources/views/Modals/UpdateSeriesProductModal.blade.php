<!-- Modal -->
<div class="modal fade" id="updateSeriesProduct{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Seri Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" action="SeriesProduct/{{$data->id}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Seri Produk</label>
                        <input type="text" class="form-control rounded-0"aria-describedby="emailHelp" name="seri" id="seri" value="{{$data->seri}}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control rounded-0" placeholder="Leave a comment here" id="floatingTextarea2" name="deskripsi" style="height: 100px">{{$data->deskripsi}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-0">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
