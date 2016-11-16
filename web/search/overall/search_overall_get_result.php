<?php

$config = include dirname(dirname(dirname(dirname(__FILE__)))) . '/core/config.php';
include $config['file']['init'];

if (isset($_POST['role'])) {
    $role = strtolower($_POST['role']);
    $ret = '';
    $results = [];
    switch ($role) {
        case 'musician':
            $results = Musician::get_search_result($_POST);
            break;
        case 'band':
            $results = Band::get_search_result($_POST);
            break;
        case 'agent':
            $results = Agent::get_search_result($_POST);
            break;
        default:
            break;
    }
    print_r(json_encode($results));
}

