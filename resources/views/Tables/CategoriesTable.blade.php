<div class="card mt-3 overflow-x-auto rounded-0">
    <div class="card-body">
        <button type="button" class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#createCategory"><i class="uil uil-plus-square"></i> Kategori</button>
        @include('Modals.CreateCategoryModal')
        <table class="table overflow-x-auto">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    {{-- <th scope="col">Image</th> --}}
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($category as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->kategori }}</td>
                            <td>
                                <a href="category/{{ $data->id }}" data-confirm-delete="true" class="delete-confirmation"><button type="button" class="btn btn-danger rounded-0"><i class="uil uil-trash-alt"></i></button></a>
                                <a href="" data-bs-toggle="modal" data-bs-target="#updateCategory{{$data->id}}"><button type="button" class="btn btn-warning rounded-0"><i class="uil uil-edit"></i></button></a>
                            </td>
                        </tr>
                        @include('Modals.UpdateCategoryModal')
                    @endforeach
                </tr>

            </tbody>

        </table>
        {{$category->links('vendor.pagination.simple-bootstrap-5')}}
    </div>
</div>
