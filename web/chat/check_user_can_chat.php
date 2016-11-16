<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];

$ret = true;

if (!User::logged_in() || !User::is_premium()) {
    $ret = false;
}
echo json_encode($ret);
