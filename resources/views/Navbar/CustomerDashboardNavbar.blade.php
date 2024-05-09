<div class="container-fluid">
    <div class="nav-list row border-top px-xl-4">
        <div class="icon-list" id="menu-icon">
            <i class="fas fa-sharp fa-solid fa-list"></i>
        </div>
        <div class="col-lg-3 d-none d-lg-block">
            <div class="accordion" id="accordionExample">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed border-bottom" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Category
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <ul class="list-group border-bottom">
                                @foreach ($category as $data)
                                    <li class="list-group-item border-bottom" style="border-radius: 0px;">
                                        {{ $data->kategori }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 mt-2 ">
            <div class="align-item-center">
                <div class="hidden d-flex mb-3">
                    <div class="nav-list">
                        <ul class="hidden nav justify-content-start" id="menu-list">
                            <li class="nav-item">
                                <a class="nav-link text-dark" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="#">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{route('trackingItem')}}">Your Item</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{route('checkout')}}">Checkout</a>
                            </li>
                            @if (Auth::check() && Auth::user()->role_id === 1)
                                <li class="nav-item">
                                    <a href="{{route('adminDashboard')}}" class="nav-link text-dark">Admin Dashboard</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="hidden nav-list ms-auto p-2" id="menu-list">
                        <div class="d-flex">
                            <a href="{{route('profile')}}" class="nav-item nav-link">Profile</a>
                            <a href="logout" class="nav-item nav-link mx-4">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/imgs/01.jpg" class="d-block w-100 img-fluid" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/imgs/03.webp" class="d-block w-100 img-fluid"alt="...">
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
