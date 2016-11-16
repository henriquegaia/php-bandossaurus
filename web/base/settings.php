<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

$role = $user_data['role'];
$regex = new Regex;
$role_errors = [];

if (empty($_POST) === false) {

    $required_fields_user = User::get_settings_required_fields();
    $required_fields_role = Role::get_settings_fields($role);
    $required_fields = array_merge($required_fields_user, $required_fields_role);

    foreach ($_POST as $key => $value) {
        if ((empty($value) ) && in_array($key, $required_fields) === true) {
            $errors[] = 'All the fields (except last name) are required.';
            break;
        }
    }
    /*
     * generic
     */
    $first_name_posted = $_POST['first_name'];
    $last_name_posted = $_POST['last_name'];
    $email_posted = $_POST['email'];
    $region_posted = Post::check_post('region');
    $country_posted = Post::check_post('country');
    $city_posted = Post::check_post('city_state');
    /*
     * specific to roles
     */
    $role_data_posted = Role::settings_data($user_data['role']);

    /*
     * ***************************************************************************
     * errors
     * ***************************************************************************
     */
    /*
     * if there is posted data for every required field ...
     */
    if (empty($errors) === true) {
        /*
         * first name
         */
        if (preg_match($regex->get_regex_first_name(), $first_name_posted) == false) {
            $errors[] = $regex->get_regex_first_name_error_msg();
        }
        /*
         * last name
         */
        if (!empty($last_name_posted)) {
            if (preg_match($regex->get_regex_last_name(), $last_name_posted) == false) {
                $errors[] = $regex->get_regex_last_name_error_msg();
            }
        }
        /*
         * email
         */
        if (preg_match($regex->get_regex_email(), $email_posted) == false) {
            $errors[] = 'A valid email is required.';
        } else if (User::email_exists($email_posted) === true && $user_data['email'] !== $email_posted) {
            $errors[] = 'Sorry, the email \'' . $email_posted . '\' is already taken.';
        }
        /*
         * role specific fields
         */
        $role_settings_fields = Role::get_settings_fields($role);

        /*
         * for each role settings fields, check is error and get the error message
         */
        foreach ($role_settings_fields as $key => $value) {
            $error = Role::get_settings_field_error($value, $_POST[$value], $role);
            if ($error != false) {
                $role_errors [] = $error;
            }
        }
        /*
         * join the errors
         */

        $errors = array_merge($errors, $role_errors);
    }
}

/*
 * ***************************************************************************
 * Presentation
 * ***************************************************************************
 */

Presentation::print_page_title('Settings');

if (isset($_GET['success']) === true && empty($_GET['success'])) {
    $text = 'Your data has been updated.';
    Presentation::print_success_message($text);
} else if (isset($_GET['unsuccess']) === true && empty($_GET['unsuccess']) === true) {
    $text = '<p>Something went wrong while settings the data.</p>';
    $text.='<p>Could you please try again later?</p>';
    $text.='<p>Sorry for the inconvenient.</p>';
    Presentation::print_failure_message($text);
} else {
    if (empty($_POST) === false && empty($errors) === true) {

        if (!Token::check_if_clean_of_csrf()) {
            die();
        }

        $allow_email = ($_POST['allow_email'] == 'on') ? 1 : 0;
        $generic_user_data = array(
            'first_name' => $first_name_posted,
            'last_name' => $last_name_posted,
            'email' => $email_posted,
            'region' => $region_posted,
            'country' => $country_posted,
            'city_state' => $city_posted,
            'allow_email' => $allow_email
        );
        $file = 'settings';
        if (User::update($session_user_id, $generic_user_data) == true) {
            if (Role::update($role, $session_user_id, $role_data_posted) == true) {
                Redirect::success_status($file, '', 'success');
            }
        }
        Redirect::success_status($file, '', 'unsuccess');
    } else if (empty($errors) === false) {
        Presentation::print_failure_message_array($errors);
    }

    include $config['file']['settings_form'];
    JavaScript::encode_to_json_settings(Role::get_settings_values_with_user_values());
    JavaScript::encode_to_json_settings_fields(Role::get_settings_fields_with_user_fields($role));
}//else
include $config['file']['ov_footer'];
?>