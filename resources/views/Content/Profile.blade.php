<div class="container-fluid bg-secondary-cs mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Your Profile</h1>
        <div class="d-inline-flex">
            <div class="" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name }} Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card mb-4 mx-5 rounded-0">
        <form action="{{ route('profileUpdate') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h5 class="card-header bg-transparent">Profile Details</h5>
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="d-block rounded-0"
                        height="100" />
                    <div class="button-wrapper">
                        <label for="photo" class="btn btn-primary me-2 mb-4 rounded-0" type="file">
                            <span class="d-none d-sm-block rounded-0">Upload new photo</span>
                            <input type="file" id="photo" name="photo" class="account-file-input rounded-0" hidden/>
                        </label>
                        <p class="text-body-tertiary mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </div>
            </div>

            <hr class="my-0" />
            <div class="card-body">
                <form method="POST" action="{{ route('profileUpdate') }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nama Pembeli</label>
                            <input class="form-control rounded-0" type="text" id="name" name="name"
                                value="{{ Auth::user()->name }}" />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control rounded-0" type="text" id="email" name="email"
                                value="{{ Auth::user()->email }}" />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Nomor Telepon</label>
                            <input type="text" class="form-control rounded-0" id="no_hp" name="no_hp"
                                placeholder="Phone Number" value="{{ Auth::user()->no_hp }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control rounded-0" id="alamat" name="alamat"
                                placeholder="Address" value="{{ Auth::user()->alamat }}" />
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2 rounded-0">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary rounded-0">Cancel</button>
                    </div>
                </form>
            </div>
        </form>

    </div>
</div>
