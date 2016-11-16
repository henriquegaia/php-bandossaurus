<form action="" method="post">
    <ul>
        <?php include $config['file']['input_token_csrf']; ?>
        <?php
        $roles = Role::get_roles();
        $mode='register';
        Presentation::get_label_and_arr_role_select('role', $roles, 'Role', $mode);
        Presentation::get_label_and_submit_input('submit_register_pre');
        ?>
    </ul>
</form>
