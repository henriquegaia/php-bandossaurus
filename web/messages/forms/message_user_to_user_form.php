<?php
$max_chars = Message::CONTENT_MAX_LENGHT;
?>

<form action="" method="post" id="form_message_to_user">
    <ul>
        <?php include $config['file']['input_token_csrf']; ?>
        <li>
            <textarea placeholder="type your message ... max <?php echo $max_chars; ?> chars" name="txt_area_message_user_to_user" maxlength="<?php echo $max_chars; ?>" id="txt_area_message_user_to_user" class="body_message_user_to_user"><?php Presentation::populate_field('body', ''); ?></textarea>
        </li>
        <li>
            <input 
                type="submit"
                id="submit_message_user_to_user"
                value="send message"
                name="Send">
        </li>
    </ul>
</form>
