<div class="container-fluid position-sticky z-3 sticky-top" style="background-color: white; width: 100%;">
    <div class="row align-items-center py-3 px-xl-5 border-bottom">
        <nav class="navbar navbar-expand-lg border-0">
            <div class="container-fluid">
                <div class="col-lg-3 d-none d-lg-block">
                    <a href="/" class="text-dark text-decoration-none">
                        <h5>Krisna komputer</h5>
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="ms-3">
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                        aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Krisna Komputer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Krisna-Komputer') }}#produk">Produk</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Halaman
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('checkout') }}">Checkout</a></li>
                                    <li><a class="dropdown-item" href="{{ route('trackingItem') }}">Pembelian</a></li>
                                    @if (!Auth::check())
                                        <li><a class="dropdown-item" href="register">Registrasi</a></li>
                                    @endif
                                    @if (Auth::check() && Auth::user()->role_id === 1)
                                        <li class="nav-item">
                                            <a href="{{ route('adminDashboard') }}" class="dropdown-item">Admin
                                                Dashboard</a>
                                        </li>
                                    @endif
                                    @if (Auth::check() && Auth::user()->role_id === 2)
                                        <li class="nav-item">
                                            <a href="{{ route('complain') }}" class="dropdown-item">Complain</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}">Profil</a>
                            </li>
                            @if (Auth::check())
                                <!-- User is logged in -->
                                <a class="nav-link" href="logout">Logout</a>
                            @else
                                <!-- User is not logged in -->
                                <a class="nav-link" href="" data-bs-toggle="modal"
                                    data-bs-target="#formLogin">Login</a>
                            @endif
                        </ul>

                    </div>
                </div>

                <div class="col-lg-3 col-6 ">
                    @if (Auth::check() && Auth::user()->role_id === 2)
                        <a href="{{ route('message') }}" class="btn border">
                            <i class=" text-danger fas fa-comment text-primary"></i>
                            <span class="">0</span>
                        </a>
                    @endif

                    <a href="{{ route('chart') }}" class="btn border">
                        <i class="text-primary fas fa-shopping-cart text-primary"></i>
                        @if (auth()->check())
                            @php
                                $uploadProofCount = $chart
                                    ->where('user_id', auth()->user()->id)
                                    ->where('status', \App\Models\Cashier::UPLOAD_YOUR_PROOF_PAYMET)
                                    ->count();
                                $invalidCount = $chart
                                    ->where('user_id', auth()->user()->id)
                                    ->where('status', \App\Models\Cashier::INVALID)
                                    ->count();
                            @endphp
                            @if ($uploadProofCount > 0 || $invalidCount > 0)
                                <span class="">{{ $uploadProofCount + $invalidCount }}</span>
                            @else
                                <span class="">0</span>
                            @endif
                        @else
                            <span class="">0</span>
                        @endif

                    </a>

                </div>

            </div>
        </nav>
    </div>
</div>

@include('Modals.Formlogin')
