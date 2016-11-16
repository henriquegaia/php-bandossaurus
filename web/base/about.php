<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];

?>
<div class="footer_block">
    Created By Henrique Moreira
</div>
<div class="img_container">
   <img class="img_person" src="<?php echo $config['file']['me']; ?>" width="100" alt="henrique moreira">
</div>

<?php
include $config['file']['ov_footer'];
