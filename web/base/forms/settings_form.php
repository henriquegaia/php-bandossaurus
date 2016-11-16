<form 
    id="settings_form"
    action="" 
    method="post">
    <ul>
        <?php
        include $config['file']['input_token_csrf'];
        $regex = new Regex;
        $mode = 'settings';

        Presentation::get_label_and_input_txt('first_name', 'First Name', '', $regex->get_regex_first_name(), $mode);
        Presentation::get_label_and_input_txt('last_name', 'Last Name', '', $regex->get_regex_last_name(), $mode);
        Presentation::get_label_and_input_txt('email', 'Email', '', $regex->get_regex_email(), $mode);
        Presentation::get_label_and_region_select($mode);
        Presentation::get_label_and_country_select($mode);
        Presentation::get_label_and_city_select($mode);

        $role_settings = Role::get_settings_file_path($user_data['role']);

        include $role_settings;

        include $config['file']['settings_end'];
        ?>
    </ul>
</form>

