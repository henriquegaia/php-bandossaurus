<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];

echo 'You have reached the limit of failed login attempts. '
 . '<br>'
 . 'Please ';
?>
<a href="<?php echo $config['file']['recover'] ?>?mode=password">get a new password</a>.
<?php
echo'<br>'
 . '<br>'
 . '<br>'
 . '<br>'
 . '<b>Why is there a limit for failed login attempts?</b>'
 . '<br>'
 . 'To prevent hackers from trying all possible password combinations until finding the correct one.';

include $config['file']['ov_footer'];