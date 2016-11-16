$(document).ready(function () {
    $('.start_chat').click(function () {
        $.post(urls.check_user_can_chat, function (data) {
            var user_can_chat = JSON.parse(data);
            if (user_can_chat == true) {
                $('.chat_container').load(urls.chat);
            } else {
                $('.chat_container').load(urls.chat_error);
            }
        });
    });
});

