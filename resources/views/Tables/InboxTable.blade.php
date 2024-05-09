<div class="container-fluid pt-1">
    <div class="row px-xl-5">
        <section>
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" id="chat3">
                            <div class="card-body">
                                {{-- content --}}
                                <div class="row">
                                    <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                                        <div class="p-3">
                                            {{-- <form action="" method="get" class="d-flex">
                                                <div class="mb-3 ms-2 d-flex">
                                                    <input type="text" class="form-control rounded-0" aria-describedby="emailHelp" name="keyword">
                                                    <button class="btn btn-outline-primary rounded-0" type="submit">Search</button>
                                                </div>
                                            </form> --}}
                                            <div data-mdb-perfect-scrollbar="true"
                                                style="position: relative; height: 400px" class="overflow-auto">
                                                <ul class="list-unstyled mb-0">

                                                    @if (auth()->user()->role_id === 1)
                                                        @foreach ($customers as $customer)
                                                            <li class="p-2 border-bottom overflow-auto">
                                                                <a href="#"
                                                                    class="chat-link d-flex justify-content-between"
                                                                    style="text-decoration: none;"
                                                                    data-content-id="message-content-{{ $customer->id }}"
                                                                    data-customer-id="{{ $customer->id }}">
                                                                    <div class="d-flex flex-row">
                                                                        <div>
                                                                            <img src="{{ asset('storage/' . $customer->photo) }}"
                                                                                alt="avatar"
                                                                                class="d-flex align-self-center me-3"
                                                                                width="60">
                                                                            <!-- You might need to adjust the avatar URL -->
                                                                            <span
                                                                                class="badge bg-success badge-dot"></span>
                                                                        </div>
                                                                        <div class="pt-1">
                                                                            <p class="fw-bold mb-0">
                                                                                {{ $customer->name }}</p>
                                                                            <p class="small text-muted">
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
                                                            style="position: relative; height: 400px" class="overflow-auto">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="p-2 border-bottom">
                                                                    <a href="#"
                                                                        class="chat-link d-flex justify-content-between"
                                                                        style="text-decoration: none;"
                                                                        data-content-id="message-content-1">
                                                                        <div class="d-flex flex-row">
                                                                            <div>
                                                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                                                    alt="avatar"
                                                                                    class="d-flex align-self-center me-3"
                                                                                    width="60">
                                                                                <span
                                                                                    class="badge bg-success badge-dot"></span>
                                                                            </div>
                                                                            <div class="pt-1">
                                                                                <p class="fw-bold mb-0">Marie Horwitz
                                                                                </p>
                                                                                <p class="small text-muted">Hello, Are
                                                                                    you
                                                                                    there?
                                                                                </p>
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

                                    <div class="col-md-6 col-lg-7 col-xl-8">
                                        <div class="pt-3 pe-3 overflow-auto" data-mdb-perfect-scrollbar="true"
                                            style="position: relative; height: 400px;">

                                            @foreach ($messages as $customerId => $customerMessages)
                                                <div id="message-content-{{ $customerId }}" class="message-content"
                                                    style="display: none;">
                                                    @foreach ($customerMessages as $message)
                                                        @if ($message->sender_id === Auth::user()->id)
                                                            <div class="d-flex flex-row justify-content-end">
                                                                <div>
                                                                    <p
                                                                        class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                                                                        {{ $message->content }}
                                                                    </p>
                                                                    <p class="small me-3 mb-3 rounded-3 text-muted">
                                                                        {{ $message->created_at->format('h:i A | M d') }}
                                                                    </p>
                                                                </div>
                                                                <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                                                    alt="avatar 1" style="width: 45px; height: 100%;">
                                                            </div>
                                                        @else
                                                            <div class="d-flex flex-row justify-content-start">
                                                                <img src="{{ asset('storage/' . $customer->photo) }}"
                                                                    alt="{{ $customer->name }} avatar"
                                                                    style="width: 45px; height: 100%;">
                                                                <div>
                                                                    <p class="small p-2 ms-3 mb-1 rounded-3"
                                                                        style="background-color: #f5f6f7;">
                                                                        {{ $message->content }}
                                                                    </p>
                                                                    <p
                                                                        class="small ms-3 mb-3 rounded-3 text-muted float-end">
                                                                        {{ $message->created_at->format('h:i A | M d') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach


                                        </div>
                                        <!-- Message Input Form -->
                                        <form action="{{ route('message.sendMessageToCustomer') }}" method="post">
                                            @csrf
                                            <div id="input-form" class="input-group mb-3 mt-5" style="display: none;">

                                                <input type="hidden" name="reciever_id" id="reciever-id" value="">
                                                <input type="text" class="form-control"
                                                    placeholder="Leave Message Here" aria-label="Leave Message Here"
                                                    aria-describedby="basic-addon2" class="input-form" name="content"
                                                    id="content">
                                                <button type="submit" class="btn btn-primary btn-sm ms-2" id="btn-send-message">
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
        </section>
    </div>
</div>
