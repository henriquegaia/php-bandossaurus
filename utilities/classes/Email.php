<?php

class Email {

    const LIMIT_MONTH_NOT_PREMIUM = 1;

    private static $phpmailer_host;
    private static $phpmailer_user;
    private static $phpmailer_pass;
    private static $phpmailer_smtp_secure;
    private static $phpmailer_port;

    private static function set_vars() {
        if (Project::testing()) {
            self::$phpmailer_host = 'smtpgmail.com';
            self::$phpmailer_user = '********';
            self::$phpmailer_pass = '********';
            self::$phpmailer_smtp_secure = 'auto';
            self::$phpmailer_port = 587;
        } else {
            self::$phpmailer_host = '';
            self::$phpmailer_user = '';
            self::$phpmailer_pass = '';
            self::$phpmailer_smtp_secure = '';
            self::$phpmailer_port = 587;
        }
    }

    /*
     * **************************************************
     * Send email
     * **************************************************
     */

    public static function send($emailRecipient, $subject, $message) {
        self::set_vars();
        $val = self::send_email_phpmailer($emailRecipient, $subject, $message);
        return $val;
    }

    /*
     * **************************************************
     * PHP mailer Obj
     * **************************************************
     */

    private static function get_phpmailer_object() {
        $m = new PHPMailer;

        $m->isSMTP();
        $m->Host = self::$phpmailer_host;
        $m->SMTPAuth = true;
        $m->Username = self::$phpmailer_user;
        $m->Password = self::$phpmailer_pass;
        $m->SMTPSecure = self::$phpmailer_smtp_secure;
        $m->Port = self::$phpmailer_port;
//        $m->SMTPDebug = 2;

        return $m;
    }

    /*
     * **************************************************
     * PHP mailer Send
     * **************************************************
     */

    private static function send_email_phpmailer($emailRecipient, $subject, $message) {
        global $config;

        $m = self::get_phpmailer_object();
        $m->isHTML(false);
        $m->From = self::$phpmailer_user;
        $m->FromName = $config['company']['name'];
        $m->Subject = $subject;
        $m->Body = $message;
        $m->addAddress($emailRecipient);
        if ($m->send() === false) {
            File::write_error_to_file('email_error_log', $m->ErrorInfo);
            return false;
        }
        return true;
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function get_email_subject_for_recovery($data_to_recover_txt) {
        global $config;
        return $config['company']['name'] . ': Your ' . $data_to_recover_txt . ' recovery';
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function get_message_for_recovery($first_name, $data_to_recover, $data_to_recover_txt) {
        global $config;
        $message = ""
                . "Hello $first_name,"
                . "\n\n"
                . "Your " . $data_to_recover_txt . " is:"
                . "\n\n"
                . "$data_to_recover"
                . "\n\n"
                . $config['company']['name']
                . "";
        return $message;
    }

    public static function get_message_for_invitation($username_from, $username_to) {
        global $config;
        $href = $config['file']['check_user_profile'] . '?username=' . $username_from;
        $link = $href;
        $message = ""
                . "Hello $username_to,"
                . "\n\n"
                . "The user $username_from has invited you to work with him/her."
                . "\n\n"
                . "Check out the profile: " . $link
                . "\n\n"
                . $config['company']['name']
                . "";
        return $message;
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function send_activation_account_email($register_data) {
        global $config;
        $company_name = $config['company']['name'];

        $first_name = $register_data['first_name'];
        $email = $register_data['email'];
        $email_code = $register_data['email_code'];
        $activate_file = $config['file']['activate'];
        $link = $activate_file . "?email=" . $email . "&email_code=" . $email_code;
        $subject = 'Activate your account';
        $message = ""
                . "Hello $first_name,"
                . "\n\n"
                . "Thanks for signing up for " . $company_name . "."
                . "\n\n"
                . "Please activate your account using the link below:"
                . "\n\n"
                . $link
                . "\n\n"
                . $company_name
                . "";

        return self::send($email, $subject, $message);
    }

}
