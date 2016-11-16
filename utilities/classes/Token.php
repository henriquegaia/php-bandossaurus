<?php

class Token {

    public static $test = 't';

    /*
     * **********************************************************
     * CSRF
     * **********************************************************
     */

    public static function generate_anti_csrf() {
        //do not use variable to attribute session name
        return $_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));
    }

    public static function check_if_clean_of_csrf() {
        $tkn = 'csrf';
        return self::check_body($tkn);
    }

    /*
     * **********************************************************
     * Multiple forms on a page
     * Form 1
     * **********************************************************
     */

    public static function generate_anti_csrf_form_1() {
        //do not use variable to attribute session name
        return $_SESSION['csrf_form_1'] = base64_encode(openssl_random_pseudo_bytes(32));
    }

    public static function check_if_clean_of_csrf_form_1() {
        $tkn = 'csrf_form_1';
        return self::check_body($tkn);
    }

    /*
     * **********************************************************
     * Multiple forms on a page
     * Form 2
     * **********************************************************
     */

    public static function generate_anti_csrf_form_2() {
        //do not use variable to attribute session name
        return $_SESSION['csrf_form_2'] = base64_encode(openssl_random_pseudo_bytes(32));
    }

    public static function check_if_clean_of_csrf_form_2() {
        $tkn = 'csrf_form_2';
        return self::check_body($tkn);
    }

    /*
     * **********************************************************
     * Multiple forms on a page
     * Form 3
     * **********************************************************
     */

    public static function generate_anti_csrf_form_3() {
        //do not use variable to attribute session name
        return $_SESSION['csrf_form_3'] = base64_encode(openssl_random_pseudo_bytes(32));
    }

    public static function check_if_clean_of_csrf_form_3() {
        $tkn = 'csrf_form_3';
        return self::check_body($tkn);
    }

    /*
     * **********************************************************
     * Multiple forms on a page
     * Form 4
     * **********************************************************
     */

    public static function generate_anti_csrf_form_4() {
        //do not use variable to attribute session name
        return $_SESSION['csrf_form_4'] = base64_encode(openssl_random_pseudo_bytes(32));
    }

    public static function check_if_clean_of_csrf_form_4() {
        $tkn = 'csrf_form_4';
        return self::check_body($tkn);
    }

    /*
     * **********************************************************
     * Multiple forms on a page
     * Form 5
     * **********************************************************
     */

    public static function generate_anti_csrf_form_5() {
        //do not use variable to attribute session name
        return $_SESSION['csrf_form_5'] = base64_encode(openssl_random_pseudo_bytes(32));
    }

    public static function check_if_clean_of_csrf_form_5() {
        $tkn = 'csrf_form_5';
        return self::check_body($tkn);
    }

    /*
     * **********************************************************
     * Multiple forms on a page
     * Form 6
     * **********************************************************
     */

    public static function generate_anti_csrf_form_6() {
        //do not use variable to attribute session name
        return $_SESSION['csrf_form_6'] = base64_encode(openssl_random_pseudo_bytes(32));
    }

    public static function check_if_clean_of_csrf_form_6() {
        $tkn = 'csrf_form_6';
        return self::check_body($tkn);
    }

    /*
     * **********************************************************
     * Check Body
     * **********************************************************
     */

    private static function check_body($tkn) {
        $error = basename($_SERVER['HTTP_REFERER']) . ' -> ';
        if (isset($_POST[$tkn])) {
            if (isset($_SESSION[$tkn])) {
                if ($_POST[$tkn] === $_SESSION[$tkn]) {
                    unset($_SESSION[$tkn]);
                    return true;
                } else {
                    $error = $error . 'failed to compare post (' . $_POST[$tkn] . ') and session (' . $_SESSION[$tkn] . ')';
                }
            } else {
                $error = $error . 'session not set';
            }
        } else {
            $error = $error . 'post not set';
        }
        File::write_error_to_file('csrf_attacks', $error);
        return false;
    }

    /*
     * 
     */

    public static function check_csrf_3_forms($form_mode, $modes_arr) {
        switch ($form_mode) {
            case $modes_arr['1']:
                if (!self::check_if_clean_of_csrf_form_1()) {
                    die();
                }
                break;
            case $modes_arr['2']:
                if (!self::check_if_clean_of_csrf_form_2()) {
                    die();
                }
                break;
            case $modes_arr['3']:
                if (!self::check_if_clean_of_csrf_form_3()) {
                    die();
                }
                break;
            default:
                die('error: form mode -> ' . $form_mode);
        }
    }

}
