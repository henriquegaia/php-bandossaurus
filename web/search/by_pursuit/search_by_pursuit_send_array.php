<?php

$config = include dirname(dirname(dirname(dirname(__FILE__)))) . '/core/config.php';
include $config['file']['init'];

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $pursuit_arr = Pursuit::get_all_by_type($type);
    print_r(json_encode($pursuit_arr));
} else {
    print_r(json_encode([]));
}




