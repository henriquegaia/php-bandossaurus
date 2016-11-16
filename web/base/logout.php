<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];

session_start();
User::logout($session_user_id);
session_destroy();

Redirect::to_index();
?>