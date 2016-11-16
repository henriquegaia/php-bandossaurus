<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

$form_mode = '';
$form_is_valid = true;
$n_elem = 0;
$n_elem_without_settings = 0;
$file = 'settings_band_members';

if (!empty($_POST)) {

    $form_mode = $_POST['form_mode'];

    switch ($form_mode) {

        case 'update_band_member'://falling though on next case
        case 'create_band_member':


            $req_fields = BandMember::get_settings_required_fields();

            foreach ($_POST as $key => $value) {
                if (empty($value) && in_array($key, $req_fields) === true) {
                    $errors[] = 'All the fields (except username) are required.';
                    break;
                }
            }

            $posted_username = $_POST['username'];

            /*
             * ****************************************************************
             * errors
             * ****************************************************************
             */

            if (empty($errors)) {
                /*
                 * validations:
                 * name         -> same as Band name
                 * birth date   -> same as Musician birth date				
                 * join date    -> same as Band formation date
                 */
                foreach ($req_fields as $key => $value) {
                    $error = Role::get_settings_field_error($value, $_POST[$value], 'band_member');
                    if ($error != false) {
                        $errors [] = $error;
                    }
                }
                /*
                 * username -> check if exists
                 */
                if (!empty($posted_username) && !User::exists($posted_username)) {
                    $errors[] = 'That username doesn\'t exist.';
                }
            }
            break; //the switch case

        case 'delete_band_member':
            // Nothing to do
            break;
        default:
            die('error passing form mode');
    }
}

/*
 * ***************************************************************************
 * Presentation
 * ***************************************************************************
 */

Presentation::print_page_title('Settings - Band Members');

if (isset($_GET['success']) === true && empty($_GET['success'])) {
    $text = Presentation::get_success_update_message();
    Presentation::print_success_message($text);
} else if (isset($_GET['unsuccess']) === true && empty($_GET['unsuccess']) === true) {
    $text = Presentation::get_failure_update_message();
    Presentation::print_failure_message($text);
    $text = 'If that\'s the case, you can\'t create/update a band member to information that already exists in the table.';
    Presentation::print_failure_message($text);
} else {
    if (empty($_POST) === false && empty($errors) === true) {

        $form_mode = $_POST['form_mode'];
        $modes_arr = [
            1 => 'update_band_member',
            2 => 'delete_band_member',
            3 => 'create_band_member'
        ];
        Token::check_csrf_3_forms($form_mode, $modes_arr);

        switch ($form_mode) {

            case 'update_band_member':

                $relation_order_id = BandMember::get_relation_element_order_and_id();
                $selected_row = $_POST[$form_mode . '_selected_row'];
                $member_id = $relation_order_id[$selected_row];
                $data_to_set = Post::get_settings_data_to_array(BandMember::get_settings_fields());
                if (BandMember::update($member_id, $data_to_set) == true) {
                    Redirect::success_status($file, 'update', 'success');
                } else {
                    Redirect::success_status($file, 'update', 'unsuccess');
                }
                break;

            case 'create_band_member':
                $band_id = [
                    'band_id' => $session_user_id
                ];
                $register_data = Post::get_settings_data_to_array(BandMember::get_settings_fields());

                $register_data_merge = array_merge($band_id, $register_data);
                if (BandMember::create($register_data_merge) == true) {
                    if (BandMember::get_number_elements_without_data() == 0) {
                        if (Band::increment_number_elements($session_user_id) == true) {
                            Redirect::success_status($file, 'create', 'success');
                            break;
                        }
                    } else {
                        Redirect::success_status($file, 'create', 'unsuccess');
                        break;
                    }
                }
                Redirect::success_status($file, 'create', 'unsuccess');
                break;

            case 'delete_band_member':
                $relation_order_id = BandMember::get_relation_element_order_and_id();
                $selected_row = $_POST[$form_mode . '_selected_row'];
                $member_id = $relation_order_id[$selected_row];
                //delete
                if (BandMember::delete($member_id) == true) {
                    //decrement
                    if (Band::decrement_number_elements($session_user_id) == true) {
                        Redirect::success_status($file, 'delete', 'success');
                        break;
                    }
                }
                Redirect::success_status($file, 'delete', 'unsuccess');
                break;
            default:
                die('error: form mode');
        }
    } else if (empty($errors) === false) {
        Presentation::print_failure_message_array($errors);
        $form_is_valid = false;
    }

    global $band_members_data;

    $n_elem = Band::get_number_elements();
    $n_elem_without_settings = BandMember::get_number_elements_without_data();

    JavaScript::encode_to_json_band_members($band_members_data);
    JavaScript::encode_to_json_band_members_fields(BandMember::get_settings_fields());

    if ($n_elem_without_settings == $n_elem) {
        Presentation::print_no_data_message('You haven\'t yet edited any of the band members info.');
    }

    if (Role::all_required_fields_have_data()) {
        $table_order_id_relation = BandMember::get_relation_element_order_and_id();
        $band_member_array = BandMember::profile_to_array();
        Presentation::get_array_2d_to_table($band_member_array, false);
        Presentation::get_members_settings_options($table_order_id_relation);
        ?>
        <div id="settings_band_members_form_area">
            <?php
            include $config['file']['update_band_members_form'];
            include $config['file']['delete_band_members_form'];
            include $config['file']['create_band_members_form'];
            ?>
        </div>
        <?php
        if (!$form_is_valid) {
            $form_mode = $_POST['form_mode'];
            JavaScript::show_form_after_failed_post_band_members($form_mode);
        }
    } else {
        $settings_link = $config['file']['settings'];
        $message = 'To edit the band members info, you need to first '
                . '<a href="' . $settings_link . '">'
                . 'edit the band\'s info'
                . '</a>.';
        Presentation::print_no_data_message($message);
    }
    JavaScript::disable_html_elements_band_members($n_elem, $n_elem_without_settings);
}

include $config['file']['ov_footer'];
?>