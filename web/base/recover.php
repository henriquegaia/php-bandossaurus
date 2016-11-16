<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Redirect::logged_in();
include $config['file']['ov_header'];

$file = 'recover';
Presentation::print_page_title('Recover');

if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
    $text = '<p>Please check your email to continue the recovery process.</p>';
    Presentation::print_success_message($text);
} else if (isset($_GET['unsuccess']) === true && empty($_GET['unsuccess']) === true) {
    $text = '<p>Something went wrong while sending the email to continue the recovery process.</p>';
    $text.= '<p>Could you please try again later?</p>';
    $text.= '<p>Sorry for the inconvenient.</p>';
    Presentation::print_failure_message($text);
} else {
    $mode_allowed = array('password');
    if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
        $mode = $_GET['mode'];
        if (isset($_POST['email']) && empty($_POST) === false) {
            if (!Token::check_if_clean_of_csrf()) {
                die();
            }
            $email = $_POST['email'];
            if (User::email_exists($email)) {
                if (User::recover($mode, $email) === true) {
                    Redirect::success_status($file, '', 'success');
                } else {
                    Redirect::success_status($file, '', 'unsuccess');
                }
            } else {
                echo 'Oops, we couldn\'t find that email address!';
            }
        }
        include $config['file']['recover_form'];
    } else {
        Redirect::to_index();
    }
    ?>

    <?php

}//else
include $config['file']['ov_footer'];
?>