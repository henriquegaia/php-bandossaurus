<form action="" method="post">
    <ul>
        <?php
        include $config['file']['input_token_csrf'];
        $mode='change_password';
        $regex = new Regex;

        Presentation::get_label_and_input_password('change_current_password', 'Current Password', '', $regex->get_regex_password(), $mode, false, false, '');
        Presentation::get_label_and_input_password('change_new_password', 'New Password', '', $regex->get_regex_password(), $mode, true, false, '');
        Presentation::get_label_and_input_password('change_new_password_again', 'Repeat New Password', '', '', $mode, true, true, 'change_new_password');
        Presentation::get_label_and_submit_input('submit_change_password');
        ?>

    </ul>
</form>
