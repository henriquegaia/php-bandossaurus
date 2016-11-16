<?php
$config=include dirname(dirname(dirname(__FILE__))).'/core/config.php';
include $config['file']['init'];
Security::protected_page();
Security::admin_protect();
include $config['file']['ov_header'];

?>
<h1>Admin</h1>
<p>Admin page</p>



<?php include $config['file']['ov_footer'];