<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];

$ret = true;

if (!Message::user_can_send()) {
    $ret = false;
}
echo json_encode($ret);
