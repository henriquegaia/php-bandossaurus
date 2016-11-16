<?php

/*
 * ***********************************************************
 * Session and error reporting
 * ***********************************************************
 */
session_start();
if (Project::producing()) {
    error_reporting(0);
    ini_set('display_errors', false);
} else {
    error_reporting(1);
    ini_set('display_errors', true);
}

ini_set('max_execution_time', 300);

date_default_timezone_set('America/Los_Angeles');

//$script_tz = date_default_timezone_get();
//
//if (strcmp($script_tz, ini_get('date.timezone'))) {
//    echo 'Script timezone differs from ini-set timezone.';
//} else {
//    echo 'Script timezone and ini-set timezone match.';
//}
/*
 * ***********************************************************
 * Requirements
 * ***********************************************************
 */

$config = include dirname(dirname(__FILE__)) . '/core/config.php';
require $config['file']['phpmailer_autoload'];

/*
 * ***********************************************************
 * global variables
 * ***********************************************************
 */

$errors = array();

$current_file = File::get_filename_by_path($_SERVER['SCRIPT_NAME']);
//$previous_file = Redirect::get_previous_page();

/*
 * ***********************************************************
 * Setting the user data and forcing redirection if user
 * has been attributed a new password
 * ***********************************************************
 */

if (User::logged_in() === true) {

    $session_user_id = $_SESSION['id'];


    /*
     * ***********************************************************
     * new version
     * ***********************************************************
     */

    $user_data = User::get_all_data($session_user_id);
    $role = User::get_value('role');
//    JavaScript::encode_to_json_role($role);
    $role_data = Role::get_all_data($role, $session_user_id);
    $band_members_data = [];

    // Band Members
    if ($role == 'band') {
        $band_id = Role::get_id(); //$role_data['user_id'];
        $band_members_data = BandMember::get_all_by_band($band_id);
    }

    // Experience
    if ($role == 'musician') {
        $experience_data_musician_alone = Role::get_experience_data('musician_alone', $session_user_id);
        $experience_data_musician_band = Role::get_experience_data('musician_band', $session_user_id);
    } else {
        $experience_data = Role::get_experience_data($role, $session_user_id);
    }

    //pursuits
    $pursuits = Pursuit::get_all_data();


    /*
     * ***********************************************************
     * in case admin deactivated account directly on database,
     * i want to force the logout in the page
     * ***********************************************************
     */

    if (User::active($user_data['username']) === false) {
        session_destroy();
        Redirect::to_index();
    }

    if ($current_file !== 'change_password.php' && $current_file !== 'logout.php' && $user_data['password_recover'] == 1) {
        Redirect::with_array_params('change_password', '', ['force']);
    }
}
?>