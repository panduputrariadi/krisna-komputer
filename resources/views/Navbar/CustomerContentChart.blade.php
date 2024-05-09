<div class="container-fluid">
    <div class="row border-top px-xl-4">
        <div class="col-lg-3 d-none d-lg-block mt-3 ps-4">
            <h3>Your Chart</h3>
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
                    <div class="ms-auto p-2">
                        <div class="d-flex">
                            <a href="{{route('profile')}}" class="nav-item nav-link">Profile</a>
                            <a href="logout" class="nav-item nav-link mx-4">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
