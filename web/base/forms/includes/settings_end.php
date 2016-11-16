<li>
    <label></label>
    <input 
        type="checkbox" 
        name="allow_email" 
        <?php
        if ($user_data['allow_email'] == 1) {
            echo 'checked="checked"';
        }
        ?>>Would you like to receive email from us?
</li>
 <?php
 
 include $config['file']['generic_end'];
