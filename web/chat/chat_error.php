<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];

$href_login = $config['file']['login'];
$href_premium = $config['file']['premium'];

$link_login = '<a href="' . $href_login . '">logged in</a>';
$link_premium = '<a href="' . $href_premium . '">premium</a>';

$ret;
if (!User::logged_in()) {
    $ret = "To be able to chat you need to be $link_login and have a $link_premium.";
} else {
    $ret = "To be able to chat you need to change your account to $link_premium.";
}
echo $ret;

