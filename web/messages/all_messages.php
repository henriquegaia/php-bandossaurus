<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];

$ret = Message::all();

echo json_encode($ret);
