<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Redirect::logged_in();
include $config['file']['ov_header'];

if (empty($_POST) === false) {
    //validate role
    $role_posted = $_POST['role'];
    if ((empty($role_posted) || $role_posted == NULL)) {
        $errors[] = 'You have to select a role to continue the registration.';
    }
    $role_posted = $_POST['role'];
}

Presentation::print_page_title('Free Registration');

if (empty($_POST) === false && empty($errors) === true) {
    if (!Token::check_if_clean_of_csrf()) {
        die();
    }
    Redirect::no_status_with_param('register', '', "?role=$role_posted");

    // local test
//    $loc = $config['file']['register'] . "?role=$role_posted";
//    echo "<script type='text/javascript'>window.top.location='$loc';</script>";
//    exit;
    
    
} else if (empty($errors) === false) {
    echo Presentation::output_errors($errors);
}

include $config['file']['register_pre_form'];
include $config['file']['ov_footer'];
