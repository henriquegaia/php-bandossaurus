<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];

$href_login = $config['file']['login'];
$href_premium = $config['file']['premium'];

$link_login = '<a href="' . $href_login . '">logged in</a>';
$link_premium = '<a href="' . $href_premium . '">premium</a>';

$ret;
if (!User::logged_in()) {
    $ret = "To be able to send a message you need to be logged in.";
} else if(User::reached_limit_messages()){
    $ret = "You have reached the limit of messages for this month. To have unlimited messages become premium.";
}

echo json_encode($ret);

