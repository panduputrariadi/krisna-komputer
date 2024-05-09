<div class="card mt-3 overflow-x-auto rounded-0">
    <div class="card-body">
        <button type="button" class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#createSeriesProduct"><i
                class="uil uil-plus-square rounded-0"></i> Seri Produk</button>
        @include('Modals.CreateSeriesProductModal')
        <table class="table overflow-x-auto">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    {{-- <th scope="col">Image</th> --}}
                    <th scope="col">Seri</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($series as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit($data->seri, 20, '...') }}</td>
                        <td>{{ Str::limit($data->deskripsi, 20, '...') }}</td>
                        <td>
                            <a href="SeriesProduct/{{ $data->id }}" data-confirm-delete="true"
                                class="delete-confirmation"><button type="button" class="btn btn-danger rounded-0"><i
                                        class="uil uil-trash-alt"></i></button></a>
                            <a href="" data-bs-toggle="modal"
                                data-bs-target="#updateSeriesProduct{{ $data->id }}"><button type="button"
                                    class="btn btn-warning rounded-0"><i class="uil uil-edit"></i></button></a>
                        </td>
                    </tr>
                    @include('Modals.UpdateSeriesProductModal')
                @endforeach
            </tbody>
        </table>
        {{$series->links('vendor.pagination.simple-bootstrap-5')}}
    </div>
</div>
