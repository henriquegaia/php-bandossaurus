<!-- ------ -->
<!-- Update -->
<!-- ------ -->

<div id="update_experience_musician_alone_form">
    <?php
    Presentation::get_settings_mode_title('Update Experience');
    ?>
    <form action="" method="post">
        <ul>
            <?php
            include $config['file']['input_token_csrf_form_1'];
            $mode = 'update_experience_musician_alone';
            Presentation::get_form_fields_create_update_musician_alone_experience($mode);
            include $config['file']['generic_end'];
            ?>
        </ul>
    </form>
</div>
