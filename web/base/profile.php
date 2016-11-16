<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];


if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
    $get_url_username = $_GET['username'];

    if (User::exists($get_url_username) === true) {

        $role = $user_data['role'];
        $role = DataStructure::prepare_string_comparison($role);

        Presentation::print_page_title('Profile');


        $user_array = User::profile_to_array();
        $role_array = Role::profile_to_array($user_data['role']);

        $profile_array = array_merge($user_array, $role_array);

        Presentation::get_array_to_table($profile_array);

        /*
         * band members
         */

        $band_member_array = [];
        if ($role == 'band') {
            $band_member_array = BandMember::profile_to_array();
        }
        if (!empty($band_member_array)) {
            Presentation::print_page_title('Profile - Band Members');
            Presentation::get_array_2d_to_table($band_member_array, false);
        }
        ?>
        <br>
        <br>
        <?php
        if (Role::is_band()) {
            ?>
            <a href="<?php echo $config['file']['settings'] ?>">Update Band</a>
            <br>
            <a href="<?php echo $config['file']['settings_band_members'] ?>">Update Band Members</a>
            <?php
        } else {
            ?>
            <a href="<?php echo $config['file']['settings'] ?>">Update</a>
            <?php
        }
        ?>

        <?php
    } else {
        echo 'Sorry, that user doesn\'t exist.';
    }
} else {
    Redirect::to_index();
}

Presentation::output_errors($errors);
include $config['file']['ov_footer'];
?>