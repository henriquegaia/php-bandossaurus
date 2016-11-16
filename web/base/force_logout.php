<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();

$val;
if (isset($_POST['force_logout']) && $_POST['force_logout'] != 1) {
    if (User::logged_in()) {
        User::logout($session_user_id);
        $val = true;
    }
    $val = false;
} else {
    $val = false;
//    Redirect::to_index();
}
return json_encode($val);
