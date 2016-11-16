<form action="" method="post">
    <ul>
        <?php include $config['file']['input_token_csrf']; ?>
        <li>
            * Subject:<br> 
            <input 
                type="text" 
                name="subject" 
                value="<?php Presentation::populate_field('subject',''); ?>"/>
        </li>
        <li>
            * Body:<br>
            <textarea name="body" class="body_mass_email"><?php Presentation::populate_field('body',''); ?></textarea>
        </li>
        <li>
            <input 
                type="submit"
                name="Send">
        </li>
         
    </ul>
</form>