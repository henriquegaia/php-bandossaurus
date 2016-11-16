<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];

if (User::logged_in()) {
    Redirect::to_index();
}

$file = 'redirect_to_recover';
if (empty($_POST) === FALSE) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = User::get_username_from_email($email);
    $is_locked = User::locked($username);

    if (!Token::check_if_clean_of_csrf()) {
        die();
    }

    if (empty($email) === TRUE || empty($password) === TRUE) {
        $errors[] = 'You need to enter an email address and a password.';
    } else if (User::email_exists($email) == FALSE) {
        $errors[] = 'We can\'t find that email. Have you registered?';
    } else if (User::active($username) == FALSE) {
        $errors[] = 'You haven\'t activated you account.';
    } else {
        if (!$is_locked) {
            $login = User::login($username, $password);
            if ($login === false) {
                $errors[] = 'That email/password combination is incorrect.';
                //check if lockout is reached 
                if (User::brute_force_attack($username) == true) {
                    Redirect::no_status($file, '');
                }
            } else {
                $_SESSION['id'] = $login;
                Redirect::to_index();
            }
        } else {
            Redirect::no_status($file, '');
        }
    }
}

include $config['file']['ov_header'];

Presentation::print_page_title('Login');
?>


<div class="inner">

<?php
if (empty($errors) === false) {
    Presentation::print_failure_message_array($errors);
}

include $config['file']['login_form'];
?>
</div>

    <?php
    include $config['file']['ov_footer'];
    ?>