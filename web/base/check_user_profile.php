<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];

if (isset($_GET['username']) && !empty($_GET['username']) && User::exists($_GET['username'])) {

    ////////////////////////////////////////////////////////////////////////
    // User stuff
    ////////////////////////////////////////////////////////////////////////
    $username = $_GET['username'];
    $role = User::get_role_from_username($username);
    $role = DataStructure::prepare_string_comparison($role);
    $user_id = User::get_id_from_username($username);
    $is_logged_in = true;
    $is_online = User::online_by_username($username);

    if (isset($_POST['useless_lbl_invitation'])) {
        if (!User::logged_in()) {
            $is_logged_in = false;
        } else if (!User::reached_limit_invitations()) {
            if (!Invitation::exists($session_user_id, $user_id)) {
                Invitation::create($session_user_id, $user_id);
            }
        } else {
            $href = $config['file']['premium'];
            $link = '<a href="' . $href . '">become a premium member</a>';
            $text = 'You have reached the limit of invitations for this month.';
            $text.='<br>To have limitless invitations ' . $link . '.';
            Presentation::print_failure_message($text);
        }
    }
    ////////////////////////////////////////////////////////////////////////
    // Header
    ////////////////////////////////////////////////////////////////////////
    $append_title = '';
    // Link to start chat ...
//    if ($is_online && User::different_than_logged_in($username)) {
//        $link = '<a href="#" class="start_chat">start chat</a>';
//        $append_title = '<br><br><b class="user_is_online"> (online ... ' . $link . ')</b>';
//    } 

    Presentation::print_page_title('profile of ' . $username . ' (' . $role . ')' . $append_title);

    $show_button = true;
    if (User::logged_in()) {
        if ($user_id != $session_user_id) {
            if (Invitation::exists($session_user_id, $user_id)) {
                $show_button = false;
                $inv_id = Invitation::get_id($session_user_id, $user_id);
                $inv_date = Invitation::get_date_created($inv_id);
                $inv_friendly_date = Age::get_friendly_date_from_timestamp($inv_date);
                Presentation::get_div_info_user_is_invited($username, $inv_friendly_date);
            }
        } else {
            $show_button = false;
        }
    }
    if ($show_button == true) {
        if ($is_logged_in) {
            Presentation::get_button_send_invitation($username);
        } else {
            $href = $config['file']['login'];
            $link = '<a href="' . $href . '">here</a>';
            Presentation::print_failure_message("You have to be logged in to make an invitation. Log in $link");
        }
    }



    ////////////////////////////////////////////////////////////////////////
    // Chat (unused)
    ////////////////////////////////////////////////////////////////////////

    if ($is_online == true) {
        Presentation::get_div_chat_area($username);
    }

    ////////////////////////////////////////////////////////////////////////
    // User info
    ////////////////////////////////////////////////////////////////////////
    $user_array = User::profile_to_array_by_id($user_id);
    Presentation::print_separator('user info');
    Presentation::get_array_to_table($user_array);

    ////////////////////////////////////////////////////////////////////////
    // Role info
    ////////////////////////////////////////////////////////////////////////
    $role_array = Role::profile_to_array_by_user_id($role, $user_id);
    Presentation::print_separator($role . ' info');
    Presentation::get_array_to_table($role_array);


    if (strcasecmp($role, 'band') == 0) {
        $band_member_array = BandMember::profile_to_array_by_user_id($user_id);

        if (!empty($band_member_array)) {
            Presentation::print_separator('band members info');
            Presentation::get_array_2d_to_table($band_member_array, false);
        } else {
            echo 'There\'s no info to display about the band members';
        }
    }

    ////////////////////////////////////////////////////////////////////////
    // Experience
    ////////////////////////////////////////////////////////////////////////
    switch ($role) {
        case 'musician':
            Presentation::print_separator('experience alone');
            $exp_alone = MusicianExperienceAlone::prepare_data_to_table_by_user_id($user_id);
            Presentation::get_array_2d_to_table($exp_alone, false);
            Presentation::print_separator('experience with bands');
            $exp_bands = MusicianExperienceBand::prepare_data_to_table_by_user_id($user_id);
            Presentation::get_array_2d_to_table($exp_bands, false);
            break;
        case 'band':
            Presentation::print_separator('experience');
            $exp = BandExperience::prepare_data_to_table_by_user_id($user_id);
            Presentation::get_array_2d_to_table($exp, false);
            break;
        case 'agent':
            Presentation::print_separator('experience');
            $exp = AgentExperience::prepare_data_to_table_by_user_id($user_id);
            Presentation::get_array_2d_to_table($exp, false);
            break;
        default:
            break;
    }

    ////////////////////////////////////////////////////////////////////////
    // Send Message
    ////////////////////////////////////////////////////////////////////////
    if (User::logged_in() == false) {
        $this_id = 'x';
    } else {
        $this_id = $session_user_id;
    }

    if ($user_id != $this_id) {
        Presentation::print_separator('send a message');
        include $config['file']['message_user_to_user_form'];
        $name_msg_txt_area = 'txt_area_message_user_to_user';

        if (isset($_GET['success']) === true && empty($_GET['success'])) {
            echo 'Your message was sent.';
        } else if (isset($_GET['unsuccess']) === true && empty($_GET['unsuccess']) === true) {
            echo 'Something went wrong and your message wasn\'t sent. Please try again later.';
        } else {
            if (isset($_POST[$name_msg_txt_area])) {
                $content = $_POST[$name_msg_txt_area];
                $file = 'check_user_profile';
                $other_get = 'username=' . $username;
                if (Message::create($session_user_id, $user_id, $content) == true) {
                    Redirect::success_status_with_other_get($file, '', $other_get, 'success');
                } else {
                    Redirect::success_status_with_other_get($file, '', $other_get, 'unsuccess');
                }
            }
        }
    }
} else {
    Redirect::to_index();
}


include $config['file']['ov_footer'];
