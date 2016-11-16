<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];

Presentation::print_page_title('Premium');
include $config['file']['premium_comparison'];

/*
if (User::premium_is_1()) {
    include $config['file']['revoke_premium_form'];
} 
else if(User::premium_end_is_after_than_now()){
    include $config['file']['premium_about_to_end_form'];
}
else {
    include $config['file']['become_premium_form'];
}
 
 */
include $config['file']['premium_faq'];

include $config['file']['ov_footer'];
