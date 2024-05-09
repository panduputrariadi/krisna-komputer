const body = document.querySelector("body"),
    modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if (getMode && getMode === "dark") {
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if (getStatus && getStatus === "close") {
    sidebar.classList.toggle("close");
}

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if (sidebar.classList.contains("close")) {
        localStorage.setItem("status", "close");
    } else {
        localStorage.setItem("status", "open");
    }
});

$(document).on("click", ".delete-confirmation", function (e) {
    e.preventDefault();
    const deleteUrl = $(this).attr("href");
    const confirmation = $(this).data("confirm-delete");

    if (confirmation) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#aaa",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "The data has been deleted successfully.",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                }).then(() => {
                    // Redirect to the deleteUrl after showing the success alert
                    window.location.href = deleteUrl;
                });
            }
        });
    }
});

function showFullDescription() {
    var fullDescription = document.getElementById("full-description");
    var showMoreButton = document.getElementById("show-more");

    if (fullDescription.style.display === "none") {
        // Menampilkan deskripsi penuh
        fullDescription.style.display = "inline";
        showMoreButton.textContent = "Lihat lebih sedikit";

        // Animasi scroll ke deskripsi penuh
        var scrollOptions = {
            top: fullDescription.offsetTop,
            behavior: "smooth",
        };
        window.scrollTo(scrollOptions);
    } else {
        // Menyembunyikan deskripsi penuh
        fullDescription.style.display = "none";
        showMoreButton.textContent = "Lihat lebih banyak";

        // Animasi scroll ke bagian atas halaman
        var scrollOptions = {
            top: 0,
            behavior: "smooth",
        };
        window.scrollTo(scrollOptions);
    }
}

var lastCheckedTime = moment().format();

$(document).ready(function () {
    function hideMessageContent() {
        $(".message-content", ".input-form").hide();
    }

    $(".chat-link").on("click", function (e) {
        e.preventDefault();
        var contentId = $(this).data("content-id");
        var customerId = $(this).data("customer-id");

        $("#" + contentId).toggle();
        $(".message-content")
            .not("#" + contentId)
            .hide();

        // Toggle the input form based on the contentId
        $("#input-form").toggle(contentId.startsWith("message-content-"));

        // Set the customer ID dynamically in the form
        $("#reciever-id").val($(this).data("customer-id"));
    });

    // Define the appendNewMessage function
    function appendNewMessage(message, user_id, contentId, customerId) {
        var formattedTimestamp = moment(message.created_at).format(
            "h:mm A | MMM D"
        );

        // Determine sender class and background color based on sender_id
        var senderClass =
            message.sender_id === user_id
                ? "justify-content-end"
                : "justify-content-start";
        var backgroundColor =
            message.sender_id === user_id
                ? "bg-primary text-white"
                : "bg-light";

        // Determine image placement based on sender_id
        var imagePlacement =
            message.sender_id === user_id
                ? ""
                : '<img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;">';

        // Construct the new message HTML
        var newMessage =
            '<div class="d-flex flex-row ' +
            senderClass +
            '">\
                ' +
            imagePlacement +
            '\
                <div>\
                    <p class="small p-2 me-3 mb-1 rounded-3 ' +
            backgroundColor +
            '">' +
            message.content +
            '</p>\
                    <p class="small me-3 mb-3 rounded-3 text-muted">' +
            formattedTimestamp +
            "</p>\
                </div>\
            </div>";

        // Extract customer ID from the contentId
        var customerId = contentId ? contentId.split("-").pop() : undefined;

        // Check if customerId is defined before proceeding
        if (customerId !== undefined) {
            // Append the new message to the message container
            $("#message-content-" + customerId).append(newMessage);

            // Scroll to the bottom to show the latest message using jQuery
            var $container = $("#message-content-" + customerId);
            $container.scrollTop($container[0].scrollHeight);
        } else {
            console.error(
                "CustomerId is undefined or in an unexpected format."
            );
        }
    }

    //kirim pesan langsung muncul bubble chat
    $(document).on("click", "#btn-send-message", function (e) {
        e.preventDefault();
        var content = $("#content").val();
        var receiverId = $("#reciever-id").val(); // Get the recipient ID

        // Check if content is not empty
        if (content.trim() !== "") {
            $.ajax({
                type: "POST",
                url: sendMessageRouteCustomer,
                data: {
                    content: content,
                    reciever_id: receiverId,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function (response) {
                    // Append the new message to the UI
                    appendNewMessage(
                        response.message,
                        user_id,
                        "message-content-" + receiverId
                    );

                    // Clear the input field
                    $("#content").val("");
                },
                error: function (error) {
                    console.error(error);
                },
            });
        }
    });

function fetchNewMessages() {
    $.ajax({
        type: "GET",
        url: getNewMessagesRoute,
        data: { lastCheckedTime: lastCheckedTime },
        dataType: "json",
        success: function (response) {
            console.log('New Messages Response:', response); // Log the response for debugging

            if (response.messages && Object.keys(response.messages).length > 0) {
                // Process and append new messages to the UI
                Object.keys(response.messages).forEach(function (customerId) {
                    var contentId = "message-content-" + customerId;
                    response.messages[customerId].forEach(function (message) {
                        // Check if the message's timestamp is greater than lastCheckedTime
                        if (moment(message.created_at).isAfter(lastCheckedTime)) {
                            appendNewMessage(message, user_id, contentId);
                        }
                    });
                });

                // Update the last checked time to the latest timestamp
                lastCheckedTime = moment().format();
            }
        },
        error: function (error) {
            console.error('Error fetching new messages:', error);
        },
    });
}

    setInterval(fetchNewMessages, 2000);

    $(document).on("click", function (e) {
        if (
            !$(e.target).closest(".message-content, .chat-link, .input-form")
                .length
        ) {
            hideMessageContent();
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Smooth scrolling for the "Produk" link
    document.querySelector('a[href="#produk"]').addEventListener('click', function (e) {
        e.preventDefault();

        // Get the target element
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        // Check if the target element exists on the current page
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        } else {
            // If the target element doesn't exist, navigate to the specified URL
            window.location.href = this.getAttribute('href');
        }
    });
});
