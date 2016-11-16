<?php
$regex = new Regex;
?>

<form action="" method="post">
    <ul>
        <?php
        include $config['file']['input_token_csrf'];
        $mode = 'register';
        Presentation::get_label_and_input_txt('username', 'Choose your username', 'qwerty1', $regex->get_regex_username(), $mode);
        Presentation::get_label_and_input_password('password', 'Type a Password', '12345a', $regex->get_regex_password(), $mode, true, false, '');
        Presentation::get_label_and_input_password('password_again', 'Repeat Password', '12345a', '', $mode, true, true, 'password');
        Presentation::get_label_and_input_txt('first_name', 'First Name', 'fname', $regex->get_regex_first_name(), $mode);
        Presentation::get_label_and_input_txt('email', 'Email', 'henrique.perosinho@gmail.com', $regex->get_regex_email(), $mode);
        Presentation::get_label_and_region_select($mode);
        Presentation::get_label_and_country_select($mode);
        Presentation::get_label_and_city_select($mode);
//        Presentation::get_input_city_country($mode);

        