<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();

$regex = new Regex;

if (empty($_POST) === false) {
    $required_fields = array(
        'change_current_password',
        'change_new_password',
        'change_new_password_again'
    );

    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'All fields are required.';
            break 1;
        }
    }

    $current_password_posted = $_POST['change_current_password'];
    $password_posted = trim($_POST['change_new_password']);
    $password_again_posted = trim($_POST['change_new_password_again']);

    //$current_password_posted_encrypted = encrypte_password($current_password_posted);

    if (empty($errors) === true) {
        if (password_verify($current_password_posted, $user_data['password']) === false) {
            $errors[] = 'Your current password is incorrect!';
        }
        if ($password_posted !== $password_again_posted) {
            $errors[] = 'Your passwords do not match!';
        }
        if (preg_match($regex->get_regex_password(), $password_posted) == false) {
            $errors[] = $regex->get_regex_password_error_msg();
        }
    }
}

include $config['file']['ov_header'];

Presentation::print_page_title('Change Password');

if (isset($_GET['success']) && empty($_GET['success'])) {
    $text = 'Your password has been changed.';
    Presentation::print_success_message($text);
} else if (isset($_GET['unsuccess']) === true && empty($_GET['unsuccess']) === true) {
    $text = '<p>Something went wrong while changing the password.</p>';
    $text.='<p>Could you please try again later?</p>';
    $text.='<p>Sorry for the inconvenient.</p>';
    Presentation::print_failure_message($text);
} else {
    if (isset($_GET['force']) === true && empty($_GET['force']) === true) {
        $text = '<p>Please complete the password recovery process by changing the password that we provided by email.</p>';
        Presentation::print_separator($text);
    }
    if (empty($_POST) === false && empty($errors) === true) {
        if (!Token::check_if_clean_of_csrf()) {
            die();
        }
        $file = 'change_password';
        if (User::change_password($session_user_id, $password_posted) == true) {
            Redirect::success_status($file, '', 'success');
        } else {
            Redirect::success_status($file, '', 'unsuccess');
        }
    } else if (empty($errors) === false) {
        Presentation::print_failure_message_array($errors);
    }
    include $config['file']['change_password_form'];
}//else
include $config['file']['ov_footer'];
