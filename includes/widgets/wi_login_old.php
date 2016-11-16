<div class="widget">
    <h2>Log in/Register</h2>
    <div class="inner">
        <?php
        $config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
        ?>
        <form action ="<?php echo $config['file']['login'] ?>" method="post">
            <ul id="login">
                <?php include $config['file']['input_token_csrf']; ?>
                <li>
                    Username: <br>
                    <input type="text" name="username">
                </li>
                <li>
                    Password: <br>
                    <input type="password" name="password">
                </li>
                <li>
                    <input type="submit" name="Log in">

                </li>
                <li>
                    <a href="<?php echo $config['file']['register'] ?>">Register</a>
                </li>
                <li>
                    Forgotten your <a href="<?php echo $config['file']['recover'] ?>?mode=username">username</a> or <a href="<?php echo $config['file']['recover'] ?>?mode=password"> password</a>?
                </li>
            </ul>
        </form>
    </div>
</div>