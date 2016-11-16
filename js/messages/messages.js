
/*
 * **********************************************************************
 * Build Messages
 * **********************************************************************
 */

$(document).ready(function () {
    var id_submit = '#submit_message_user_to_user';
    var id_form = '#form_message_to_user';
    var id_txt_area = '#txt_area_message_user_to_user';

    $(id_submit).attr("disabled", "disabled");

    $(id_form).hover(function () {
        $.post(urls.check_user_can_send_message, function (data) {
            var user_can_send = JSON.parse(data);
            if (user_can_send == false) {
                $.post(urls.message_error, function (data) {
                    var error = JSON.parse(data);
                    $(id_txt_area).html(error);
                    $(id_submit).remove();
                    $(id_txt_area).attr("disabled", "disabled");
                });
            } else if (user_can_send == true) {

                $(id_txt_area).keyup(function () {
                    var content = $(id_txt_area).val();
                    if (!empty(content)) {
                        $(id_submit).removeAttr('disabled');
                        $(id_submit).click(function () {
                            /*
                             * @todo
                             */
                        });
                    } else {
                        $(id_submit).attr('disabled', 'disabled');
                    }
                });

            }
        });
    });
});

/*
 * **********************************************************************
 * Display Messages
 * **********************************************************************
 */

$(document).ready(function () {
    $.post(urls.all_messages, function (data) {
        var all_msgs = JSON.parse(data);
        var all_l = all_msgs.length;
        var text_area;
        for (var i = 0; i <= all_l; i++) {
            for (var user_id in all_msgs[i]) {
                var user_msgs = all_msgs[i][user_id];
                var user_msgs_l = user_msgs.length;
                var username = user_msgs[0]['username'];
                var role = user_msgs[0]['role'];

                // user link
                var user = document.createElement('div');
                user.setAttribute('class', 'messages_user_identification');
                var href = urls.check_user_profile + username;
                var link = document.createElement('a');
                link.setAttribute('href', href);
                link.textContent = username + ' (' + role + ')';
                user.appendChild(link);
                $('#display_all_messages').append(user);

                // body of messages
                text_area = document.createElement('div');
                text_area.setAttribute('class', 'user_messages');

                var message, message_line, date;

                for (var j = 0; j < user_msgs_l; j++) {
                    // date
                    var created_at = user_msgs[j]['created_at'];
                    date = document.createElement('div');
                    date.setAttribute('class', 'message_date');
                    date.textContent = created_at;

                    // content
                    var content = user_msgs[j]['content'];
                    message = document.createElement('label');
                    message.setAttribute('class', 'message');
                    message.textContent = content;

                    // date + content
                    message_line = document.createElement('div');
                    message_line.setAttribute('class', 'message_line_from');

                    // direction
                    var direction = 'from';
                    if (!user_msgs[j]['user_id_from']) {
                        direction = 'to';
                        message_line.setAttribute('class', 'message_line_to');
                    }

                    // message line
                    message_line.appendChild(date);
                    message_line.appendChild(message);
                    text_area.appendChild(message_line);
                    $('#display_all_messages').append(text_area);
                }
                var par = document.createElement('p');
                $('#display_all_messages').append(par);
            }
        }
    });
});
