<div class="bg-secondary-cs container-fluid mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Message</h1>
        <div class="d-inline-flex">
            <div class="" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name }} Message</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-1">
    <div class="row px-xl-5">
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="chat3">
                        <div class="card-body">
                            {{-- Sidebar --}}
                            <div class="row">
                                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                                    <div class="p-3">
                                        <!-- Search Bar -->
                                        <div class="input-group rounded mb-3">
                                            <input type="search" class="form-control rounded" placeholder="Search"
                                                aria-label="Search" aria-describedby="search-addon" />
                                            <span class="input-group-text border-0" id="search-addon">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <!-- Customer List -->
                                        <div data-mdb-perfect-scrollbar="true"
                                            style="position: relative; height: 400px" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <ul class="list-unstyled mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">

                                                @if (auth()->user()->role_id === 1)
                                                    @foreach ($customers as $customer)
                                                        <li class="p-2 border-bottom" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            <a href="#"
                                                                class="chat-link d-flex justify-content-between"
                                                                style="text-decoration: none;"
                                                                data-content-id="message-content-{{ $customer->id }}">
                                                                <div class="d-flex flex-row" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                    <div>
                                                                        <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                                                            alt="avatar"
                                                                            class="d-flex align-self-center me-3"
                                                                            width="60">
                                                                        <!-- You might need to adjust the avatar URL -->
                                                                        <span class="badge bg-success badge-dot"></span>
                                                                    </div>
                                                                    <div class="pt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                        <p class="fw-bold mb-0">{{ $customer->name }}
                                                                        </p>
                                                                        <p class="small text-muted" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                            @if ($customer->lastMessage)
                                                                                {{ $customer->lastMessage->content }}
                                                                            @else
                                                                                No messages yet.
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <div data-mdb-perfect-scrollbar="true"
                                                        style="position: relative; height: 400px" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <ul class="list-unstyled mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            <li class="p-2 border-bottom">
                                                                <a href="#"
                                                                    class="chat-link d-flex justify-content-between"
                                                                    style="text-decoration: none;"
                                                                    data-content-id="message-content-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal">
                                                                    <div class="d-flex flex-row">
                                                                        <div>
                                                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                                                alt="avatar"
                                                                                class="d-flex align-self-center me-3"
                                                                                width="60">
                                                                            <span class="badge bg-success badge-dot"></span>
                                                                        </div>
                                                                        <div class="pt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                            <p class="fw-bold mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Admin</p>
                                                                        </div>
                                                                    </div>

                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content rounded-0">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ruangan Obrolan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="pt-3 pe-3 overflow-auto"
                                                        data-mdb-perfect-scrollbar="true"
                                                        style="position: relative; height: 400px; display: none;"
                                                        id="message-content-1" class="message-content">
                                                        <div id="message-container">
                                                            @foreach ($messages as $message)
                                                                @if ($message->sender_id === Auth::user()->id)
                                                                    <div class="d-flex flex-row justify-content-end">
                                                                        <div>
                                                                            <p
                                                                                class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                                                                                {{ $message->content }}
                                                                            </p>
                                                                            <p
                                                                                class="small me-3 mb-3 rounded-3 text-muted">
                                                                                {{ $message->created_at->format('h:i A | M d') }}
                                                                            </p>
                                                                        </div>
                                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                                                            alt="avatar 1"
                                                                            style="width: 45px; height: 100%;">
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex flex-row justify-content-start">
                                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                                                            alt="avatar 1"
                                                                            style="width: 45px; height: 100%;">
                                                                        <div>
                                                                            <p class="small p-2 ms-3 mb-1 rounded-3"
                                                                                style="background-color: #f5f6f7;">
                                                                                {{ $message->content }}
                                                                            </p>
                                                                            <p
                                                                                class="small me-3 mb-3 rounded-3 text-muted">
                                                                                {{ $message->created_at->format('h:i A | M d') }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <form class="ajax">
                                                        @csrf
                                                        <div id="input-form" class="input-group mb-3 mt-5 rounded-0"
                                                            style="display: none;">
                                                            <input type="text" class="form-control"
                                                                placeholder="Leave Message Here"
                                                                aria-label="Leave Message Here"
                                                                aria-describedby="basic-addon2" class="input-form"
                                                                name="content" id="content">
                                                            <button type="button" class="btn btn-primary btn-sm ms-2 rounded-0"
                                                                id="btn-send-message">
                                                                <i class="fas fa-paper-plane"></i> Send
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
