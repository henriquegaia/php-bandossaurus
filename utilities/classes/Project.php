<?php

class Project {

    private static $status = 1;
    public static $company_name = 'Bandossaurus';
    public static $title = 'Bandossaurus';
    public static $email_support = 'bandossaurus.contact@gmail.com';

    public static function get_url() {
        if (self::testing()) {
            return 'http://localhost/_projetos/Others/make-a-band';
        } else {
            return 'http://www.bandossaurus.com';
        }
    }

    public static function get_status() {
        return self::$status;
    }

    public static function testing() {
        return (self::$status == 0 ? true : false);
    }

    public static function producing() {
        return (self::$status == 1 ? true : false);
    }

}
