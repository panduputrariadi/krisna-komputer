<!-- Modal -->
<div class="modal fade" id="transaction{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $data->user->name }} Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="exampleInputEmail1">Bukti Transfer</label>
                    <img src="{{ asset('storage/photo/' . $data->photo) }}" alt=""
                        style="width: 250px; height: 300px;" aria-describedby="emailHelp"
                        class="form-control border border-0">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Catatan</label>
                    <textarea class="form-control" id="floatingTextarea2" name="deskripsi" style="height: 100px; border-radius: 0px;"
                        disabled>{{ $data->keterangan }}</textarea>
                </div>

                <div class="d-flex">
                    <form enctype="multipart/form-data" method="POST" action="transaction/{{ $data->id }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary rounded-0">Tandai Berhasil</button>
                    </form>
                    <form method="POST" action="markAsInvalid/{{$data->id}}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger rounded-0 ms-2">Tandai Invalid</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
