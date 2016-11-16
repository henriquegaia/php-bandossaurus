<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Redirect::logged_in();
include $config['file']['ov_header'];

if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
    $text = '<p>Thanks we\'ve activated your account.</p>';
    $text .= '<p>You can now log in.</p>';
    Presentation::print_success_message($text);
} else if (isset($_GET['email']) && $_GET['email_code']) {
    $email = trim($_GET['email']);
    $email_code = trim($_GET['email_code']);
    if (User::email_exists($email) === false) {
        $errors[] = 'Something went wrong and we couldn\'t find that email address.';
    }
    if (User::activate($email, $email_code) === false) {
        $errors[] = 'Something went wrong and we couldn\'t activate your account.';
    }

    if (empty($errors) === false) {
         Presentation::print_failure_message_array($errors);
    } else {
        Redirect::success_status('activate', '', 'success');
    }
} else {
    $text = 'Something went wrong with the account activation link!';
    Presentation::print_failure_message($text);
    Redirect::to_index();
}

include $config['file']['ov_footer'];
?>