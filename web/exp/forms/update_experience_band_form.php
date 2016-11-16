<!-- ------ -->
<!-- Update -->
<!-- ------ -->

<div id="update_experience_band_form">
    <?php
    Presentation::get_settings_mode_title('Update Experience');
    ?>
    <form action="" method="post">
        <ul>
            <?php
            include $config['file']['input_token_csrf_form_1'];
            $mode = 'update_experience_band';
            Presentation::get_form_fields_create_update_band_experience($mode);
            include $config['file']['generic_end'];
            ?>
        </ul>
    </form>
</div>
