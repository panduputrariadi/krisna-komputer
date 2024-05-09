var lastCheckedTime = moment().format();

$(document).ready(function () {
    // Function to check and toggle scrollbar
    function checkScrollbar() {
        var messageContainer = $("#message-container");
        var messageContent = $("#message-content-1");

        // Check if the content height exceeds the container height
        if (messageContent.height() > messageContainer.height()) {
            messageContainer.addClass("overflow-auto");
        } else {
            messageContainer.removeClass("overflow-auto");
        }
    }

    checkScrollbar();

    $(window).resize(function () {
        checkScrollbar();
    });

    function onNewMessage() {
        checkScrollbar();
    }

    $("#btn-send-message").click(function () {
        onNewMessage();
    });
    function hideMessageContent() {
        $(".message-content", ".input-form").hide();
    }

    $(".chat-link").on("click", function (e) {
        e.preventDefault();
        var contentId = $(this).data("content-id");

        $("#" + contentId).toggle();
        $(".message-content")
            .not("#" + contentId)
            .hide();

        $("#input-form").toggle(contentId === "message-content-1");
    });

    // Define the appendNewMessage function
    function appendNewMessage(message, user_id) {
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

        // Append the new message to the message container
        $("#message-container").append(newMessage);

        // Scroll to the bottom to show the latest message
        var container = document.getElementById("message-content-1");
        container.scrollTop = container.scrollHeight;
    }

    //kirim pesan langsung muncul bubble chat
    $(document).on("click", "#btn-send-message", function (e) {
        e.preventDefault();
        var content = $("#content").val();

        // Check if content is not empty
        if (content.trim() !== "") {
            $.ajax({
                type: "POST",
                url: sendMessageRoute, // Use the correct route for sending messages
                data: {
                    content: content,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function (response) {
                    // Append the new message to the UI
                    appendNewMessage(response.message, user_id);

                    // Clear the input field
                    $("#content").val("");
                },
                error: function (error) {
                    console.error(error);
                },
            });
        }
    });

    //balasan dari admin
    setInterval(function () {
        $.ajax({
            type: "GET",
            url: getNewMessagesRoute,
            data: { lastCheckedTime: lastCheckedTime },
            dataType: "json",
            success: function (response) {
                if (response.messages.length > 0) {
                    // Process and append new messages to the UI
                    response.messages.forEach(function (message) {
                        appendNewMessage(message, user_id);
                    });

                    // Update the last checked time
                    lastCheckedTime = moment().format();
                }
            },
            error: function (error) {
                console.error(error);
            },
        });
    }, 2000);

    $(document).on("click", function (e) {
        if (
            !$(e.target).closest(".message-content, .chat-link, .input-form")
                .length
        ) {
            hideMessageContent();
        }
    });
});
