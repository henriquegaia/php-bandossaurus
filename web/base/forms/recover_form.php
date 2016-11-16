<form action="" method="post">
    <ul>
        <?php include $config['file']['input_token_csrf']; ?>
        <li>
            Please enter your email address: <br>
            <input type="text" name="email">
        </li>
        <li>
            <input type="submit" value="Recover">
        </li>
        
    </ul>
</form>