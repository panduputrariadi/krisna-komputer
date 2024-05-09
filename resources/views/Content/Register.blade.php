<div class="bg-secondary-cs container-fluid mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Register Akun</h1>
        <div class="d-inline-flex">
            <div class="" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="d-inline-flex">
            <div class="card border" style="width: 30rem; border-radius: 0px;">
                <div class="card-body">
                    <form method="post" action="/register">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama Pengguna</label>
                            <input class="form-control" type="text" name="name" id="name" style="border-radius: 0px;">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label><br>
                            <small id="emailHelp" class="form-text text-muted" style="font-style: italic; color: #999;">Direkomendasikan untuk menggunakan email dari akun Google.</small>
                            <input type="email" class="form-control" type="email" name="email" id="email" aria-describedby="emailHelp" style="border-radius: 0px;">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" id="password" style="border-radius: 0px;">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat</label>
                            <input class="form-control" type="text" name="alamat" id="alamat" style="border-radius: 0px;">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nomor Telepon</label>
                            <input class="form-control" type="text" name="no_hp" id="no_hp" style="border-radius: 0px;">
                        </div>
                        <button type="submit" class="btn btn-primary" style="border-radius: 0px;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
