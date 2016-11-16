<!-- ------ -->
<!-- Delete -->
<!-- ------ -->

<div id="delete_band_member_form">
    <?php
    Presentation::get_settings_mode_title('Delete Member');
    ?>
    <form action="" method="post">
        <ul>
            <?php
            include $config['file']['input_token_csrf_form_2'];
            $mode = 'delete_band_member';
            ?>
            <p></p>
            <li>
                <label></label>
                <span class="dialog_confirm deletion">Do you confirm the withdraw of the member </span>
                <span class="dialog_confirm deletion" id="member_name_to_delete"></span>
                <span class="dialog_confirm deletion">?</span>
            </li>
            <p></p>
            <?php
            Presentation::get_hidden_input($mode . '_selected_row');
            Presentation::set_hidden_input_with_form_mode($mode);
            include $config['file']['generic_end_no_reset'];
            ?>
        </ul>
    </form>
</div>
