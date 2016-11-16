<!-- ------ -->
<!-- Create -->
<!-- ------ -->

<div id="create_band_member_form">
    <?php
    Presentation::get_settings_mode_title('Create Member');
    ?>
    <form action="" method="post">
        <ul>
            <?php
            include $config['file']['input_token_csrf_form_3'];
            $mode = 'create_band_member';
            Presentation::get_form_fields_create_update_member($mode);
            include $config['file']['generic_end'];
            ?>
        </ul>
    </form>
</div>