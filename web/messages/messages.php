<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

Presentation::print_page_title('Messages');
?>
<div id="display_all_messages"></div>
<?php
$all = Message::all();
if (empty($all)) {
    echo 'You haven\'t messages.';
}
include $config['file']['ov_footer'];

