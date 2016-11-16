<!-- ------ -->
<!-- Update -->
<!-- ------ -->

<div id="create_pursuit_form">
    <?php
    Presentation::get_settings_mode_title('Create Pursuit');
    ?>
    <form action="" method="post">
        <ul>
            <?php
            include $config['file']['input_token_csrf_form_3'];
            $mode = 'create_pursuit';
            Presentation::get_form_fields_create_update_pursuit($mode);
            include $config['file']['generic_end'];
            ?>
        </ul>
    </form>
</div>
