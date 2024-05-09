<div class="container-fluid">
    <div class="row border-top px-xl-4">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="accordion" id="accordionExample">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed border-bottom" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Category
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <ul class="list-group border-bottom">
                                @foreach ($category as $data)
                                    <li class="list-group-item border-bottom" style="border-radius: 0px;">{{ $data->kategori }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 mt-2 ">
            <div class="align-item-center">
                <div class="d-flex mb-3">
                    <div class="">
                        <ul class="nav justify-content-start">
                            <li class="nav-item">
                                <a class="nav-link text-dark" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="#">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="#">Service</a>
                            </li>
                        </ul>
                    </div>
                    <div class="ms-auto p-2">
                        <div class="d-flex">
                            <a href="" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#formLogin">Login</a>
                            <a href="" class="nav-item nav-link mx-4" data-bs-toggle="modal" data-bs-target="#formRegister">Register</a>
                        </div>
                    </div>
                </div>
            </div>

            @include('Modals.Formlogin')
            @include('Modals.FormRegister')

            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/imgs/01.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/imgs/03.webp" class="d-block w-100 img-fluid"alt="..." style="height: 367px">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

    </div>
</div>
