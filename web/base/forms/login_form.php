<form action ="" method="post">
    <ul id="login">
        <?php include $config['file']['input_token_csrf']; ?>
        <li>
            <label></label>
            <input 
                type="text" 
                placeholder="email"
                name="email">
        </li>
        <li>
            <label></label>
            <input 
                type="password" 
                placeholder="password"
                name="password">
        </li>
        <li>
            <label></label>
            <input type="submit" name="Log in">
        </li>
        <li>
            <label></label>
            Don't have an account? Please <a href="<?php echo $config['file']['register'] ?>">Register</a>
        </li>
        <li>
            <label></label>
            Forgotten your <a href="<?php echo $config['file']['recover'] ?>?mode=password">password</a>?
        </li>

    </ul>
</form>



