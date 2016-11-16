<?php $config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';?>
<!doctype html>
<html ng-app="make_a_band">
    <?php
    include $config['file']['head'];
    ?>
    <body>
        <?php
        include $config['file']['google_analytics_tracking'];
        include $config['file']['header'];
        ?>
        <div id="container">