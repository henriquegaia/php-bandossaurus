<?php
$config = include dirname(dirname(__FILE__)) . '/core/config.php';
?>
<div>
    <nav class="user_widget">
        <ul>
            <?php
            /*
             * Test:
             * to be able to return to previous page after login
             * 
             * echo 'current file: ' . $current_file . ' | previous file: ' . $previous_file . ' | ';
             */

            include $config['file']['wi_user'];
            ?>
        </ul>
    </nav>
</div>
<div class="menu_item_index" >
    <a href="<?php echo $config['file']['index']; ?>"><?php echo $config['company']['name']; ?></a>
</div>

<div class="menu_item">
    <a href="<?php echo $config['file']['search_overall']; ?>">Search Overall</a>
</div>

<div class="menu_item">
    <a href="<?php echo $config['file']['search_by_pursuit']."?type=1"; ?>">Search By Pursuit</a>
</div>


<div class="menu_item">
    <a href="<?php //echo $config['file']['premium']; ?>"></a>
</div>





