<!-- ------ -->
<!-- Create -->
<!-- ------ -->

<div id="create_experience_musician_bands_form">
    <?php
    Presentation::get_settings_mode_title('Create Experience');
    ?>
    <form action="" method="post">
        <ul>
            <?php
            include $config['file']['input_token_csrf_form_3'];
            $mode = 'create_experience_musician_bands';
            Presentation::get_form_fields_create_update_musician_bands_experience($mode);
            include $config['file']['generic_end'];
            ?>
        </ul>
    </form>
</div>