<?php
$config=include dirname(dirname(dirname(__FILE__))).'/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];
?>

<h1>Sorry, you need to be logged in to do that!</h1>
<p>Please register or log in.</p>

<?php include $config['file']['ov_footer'];