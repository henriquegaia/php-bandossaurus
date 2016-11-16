<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

Presentation::print_page_title('Revoke Premium');

$result = User::revoke_premium();
$end_premium = User::get_premium_end();
$append = "<br>You can use the premium functionalities until $end_premium.";
if ($result == true) {
    $msg = "Your request to revoke the premium account was accepted.";
    Presentation::print_success_message($msg . $append);
} else {
    $msg = "Something went wrong while trying to revoke the premium membership.";
    $msg.="<br>But don't worry:";
    $msg.="<br>When your membership expires, you will go back to a normal account.";
    $msg.="<br>To become premium again, simply follow the same process as before for more 30 days of premium.";
    Presentation::print_failure_message($msg . $append);
}

include $config['file']['ov_footer'];

