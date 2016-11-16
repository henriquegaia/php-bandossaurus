<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];
Presentation::print_page_title('Contact');
?>
Have a question? Email us at <a href="<?php echo Project::$email_support; ?>"><?php echo Project::$email_support; ?></a>
<?php
include $config['file']['ov_footer'];
