<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

Presentation::print_page_title('Invitations');

Presentation::print_separator('Sent');
$sent = Invitation::all_sent();
if (empty($sent)) {
    echo 'You haven\'t sent any invitations';
} else {
    Presentation::print_2d_table_if_has_data($sent);
}

Presentation::print_separator('Received');
$received = Invitation::all_received();
if (empty($received)) {
    echo 'You haven\'t received any invitations';
} else {
    Presentation::print_2d_table_if_has_data($received);
}

include $config['file']['ov_footer'];
