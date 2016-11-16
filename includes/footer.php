<?php
$config = include dirname(dirname(__FILE__)) . '/core/config.php';
?>

<footer>
    <div class="footer_block">
        <a href="<?php echo $config['file']['terms']; ?>"></a> 
        
        <a href="<?php echo $config['file']['privacy']; ?>"></a>
         
        <a href="<?php echo $config['file']['contact']; ?>">Contact/Support</a>
        | 
        <a href="<?php echo $config['file']['about']; ?>">About</a>
    </div>

    <div class="footer_block">
        Follow us on: <a href="https://www.facebook.com/Bandossaurus-1939698446256832/">Facebook</a>
    </div>

    <div class="footer_block">
        <?php
        $now = new DateTime();
        $year = $now->format("Y");
        ?>
        © <?php echo $year . ', ' . $config['company']['name']; ?>
    </div>


</footer>
