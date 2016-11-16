<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
Security::admin_protect();
include $config['file']['ov_header'];

$file = 'mass_mail';
Presentation::print_page_title('Mail All Users');

if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
    $text = '<p>Emails were sent.</p>';
    Presentation::print_success_message($text);
} else if (isset($_GET['unsuccess']) === true && empty($_GET['unsuccess']) === true) {
    $text = '<p>Something went wrong while sending the emails.</p>';
    $text.='<p>Could you please try again later?</p>';
    $text.='<p>Sorry for the inconvenient.</p>';
    Presentation::print_failure_message($text);
} else if (isset($_GET['sending']) === true && empty($_GET['sending']) === true) {
    Presentation::show_progress_bar();
} else {
    if (empty($_POST) === false) {

        $subject = $_POST['subject'];
        $body = $_POST['body'];
        if (empty($subject) === true) {
            $errors[] = 'Subject is required.';
        }
        if (empty($body) === true) {
            $errors[] = 'Body is required.';
        }
        if (empty($errors) === false) {
            Presentation::print_failure_message_array($errors);
        } else {
            if (!Token::check_if_clean_of_csrf()) {
                die();
            }
            if (User::mail_all($subject, $body) == true) {
                Redirect::success_status($file, '', 'success');
            } else {
                Redirect::success_status($file, '', 'unsuccess');
            }
        }
    }
    include $config['file']['mass_mail_form'];
}//else
include $config['file']['ov_footer'];
?>