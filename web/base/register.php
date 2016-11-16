<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
$role;
$file = 'register';
Redirect::logged_in();
include $config['file']['ov_header'];

if (isset($_GET['role'])) {
    $role = $_GET['role'];
}
//else if (!isset($_GET['success']) && !isset($_GET['unsuccess'])) {
//    Redirect::register_pre('role');
//}

if (empty($_POST) === false) {
    $regex = new Regex;
    $required_fields = ['username', 'password', 'password_again', 'first_name', 'email', 'region', 'country', 'city_state'];

    foreach ($_POST as $key => $value) {
        if ((empty($value) || $value == NULL) &&
                in_array($key, $required_fields) === true) {
            $errors[] = 'All the fields are required.';
            break 1;
        }
    }

    $username_posted = $_POST['username'];
    $password_posted = $_POST['password'];
    $password_again_posted = $_POST['password_again'];
    $first_name_posted = $_POST['first_name'];
    $email_posted = $_POST['email'];
    $region_posted = Post::check_post('region');
    $country_posted = Post::check_post('country');
    $city_posted = Post::check_post('city_state');

    if (empty($errors) === true) {
        if (User::exists($username_posted) === true) {
            $errors[] = 'Sorry, the username \'' . $username_posted . '\' is already taken.';
        }
        if (preg_match($regex->get_regex_username(), $username_posted) == false) {
            $errors[] = $regex->get_regex_username_error_msg();
        }
        if (preg_match($regex->get_regex_password(), $password_posted) == false) {
            $errors[] = $regex->get_regex_password_error_msg();
        }
        if ($password_posted !== $password_again_posted) {
            $errors[] = 'Your passwords do not match.';
        }
        if (preg_match($regex->get_regex_first_name(), $first_name_posted) == false) {
            $errors[] = $regex->get_regex_first_name_error_msg();
        }
        if (preg_match($regex->get_regex_email(), $email_posted) == false) {
            $errors[] = 'A valid email is required.';
        }
        if (User::email_exists($email_posted) === true) {
            $errors[] = 'Sorry, the email \'' . $email_posted . '\' is already taken.';
        }
    }
}
$role_txt = '';
if (isset($_GET['role'])) {
    $role_txt = '- ' . Role::role_to_string($role);
}

Presentation::print_page_title('Free Registration ' . $role_txt);

if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
    $text = 'You\'ve been registered successfully! Please check your email to activate your account.';
    Presentation::print_success_message($text);
} else if (isset($_GET['unsuccess']) === true && empty($_GET['unsuccess']) === true) {
    $text = '<p>Something went wrong while sending the email to continue the register process.</p>';
    $text.= '<p>Could you please try again later?</p>';
    $text.= '<p>Sorry for the inconvenient.</p>';
    Presentation::print_failure_message($text);
} else {
    if (empty($_POST) === false && empty($errors) === true) {
        if (!Token::check_if_clean_of_csrf()) {
            die();
        }
        $email_code = Security::encrypte_password($username_posted + microtime());
        $register_data = array(
            'username' => $username_posted,
            'password' => $password_posted,
            'first_name' => $first_name_posted,
            'email' => $email_posted,
            'email_code' => $email_code,
            'region' => $region_posted,
            'country' => $country_posted,
            'city_state' => $city_posted,
            'role' => Role::role_to_string($role)
        );
        $reg = User::register($register_data, false);
        if ($reg == true) {
            Redirect::success_status($file, '', 'success');
        } else {
            Redirect::success_status($file, '', 'unsuccess');
        }
    } else if (empty($errors) === false) {
        Presentation::print_separator(Presentation::output_errors($errors));
    }
    include $config['file']['register_begin'];
    include $config['file']['register_end'];
}//else
include $config['file']['ov_footer'];
?>