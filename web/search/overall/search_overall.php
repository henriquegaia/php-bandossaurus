<?php

$config = include dirname(dirname(dirname(dirname(__FILE__)))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];
Presentation::print_page_title('Search');
include $config['file']['search_overall_filter'];
include $config['file']['ov_footer'];
