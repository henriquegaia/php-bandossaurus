<aside>

    <?php
    $config = include dirname(dirname(__FILE__)) . '/core/config.php';
    if (isset($_SESSION['id']) === true) {
        include $config['file']['wi_logged_in_old'];
    } else {
        include $config['file']['wi_login_old'];
    }
    include $config['file']['wi_user_count_old'];
    ?>

</aside>