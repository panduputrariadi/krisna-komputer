

<div class="col-md-6 col-lg-7 col-xl-8">
    <div class="pt-3 pe-3" data-mdb-perfect-scrollbar="true"
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
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}"
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
    <form action="{{ route('message.sendMessage') }}" method="post">
        @csrf
        <div id="input-form" class="input-group mb-3 mt-5" style="display: none;">
            <input type="text" class="form-control" placeholder="Leave Message Here"
                aria-label="Leave Message Here" aria-describedby="basic-addon2"
                class="input-form" name="content" id="content">
            <button type="button" class="btn btn-primary btn-sm ms-2">
                <i class="fas fa-paper-plane"></i> Send
            </button>
        </div>
    </form>
</div>
