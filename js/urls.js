
var base_url = '';
var project_state = 1;

switch (project_state) {
    case 0:
        base_url = 'http://localhost/_projetos/Others/make-a-band';
        break;
    case 1:
        base_url = 'http://www.bandossaurus.com';
        break;
}
/*
 * *************************************************************
 * Urls
 * *************************************************************
 */
var urls = {
    base: base_url,
    init: base_url + '/core/init.php',
    general_images_bad: base_url + '/images/general/bad.png',
    general_images_good: base_url + '/images/general/good.png',
    settings_band_members_php: base_url + '/web/base/settings_band_members.php',
    force_logout: base_url + '/web/base/force_logout.php',
    update_band_members_php: base_url + '/web/base/forms/update_band_members_form.php',
    create_band_members_php: base_url + '/web/base/forms/create_band_members_form.php',
    delete_band_members_php: base_url + '/web/base/forms/delete_band_members_form.php',
    search_overall_get_result: base_url + '/web/search/overall/search_overall_get_result.php',
    search_by_pursuit_send_array: base_url + '/web/search/by_pursuit/search_by_pursuit_send_array.php',
    check_user_profile: base_url + '/web/base/check_user_profile.php?username=',
    register: base_url + '/web/base/register.php',
    role: base_url + '/web/base/role.php',
    check_user_can_chat: base_url + '/web/chat/check_user_can_chat.php',
    check_user_can_send_message: base_url + '/web/messages/check_user_can_send_message.php',
    chat: base_url + '/web/chat/chat.php',
    chat_error: base_url + '/web/chat/chat_error.php',
    message_error: base_url + '/web/messages/message_error.php',
    all_messages: base_url + '/web/messages/all_messages.php',
    mongodb: base_url + '/libraries/node_modules/mongodb',
    socketio: base_url + '/libraries/node_modules/socket.io'
}
