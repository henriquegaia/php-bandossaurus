<?php

class Cookie {

    public static function set_user() {
//        global $session_user_id;
//        $year = new DateTime('+1 year');
//        setcookie('user_id', $session_user_id, $year->getTimestamp(), '/', null, null, true);
    }

    public static function user_exists() {
//        global $session_user_id;
//        if (isset($_COOKIE['user_id'][$session_user_id]) && !empty($_COOKIE['user_id'][$session_user_id])) {
//            return true;
//        } 
        return false;
    }

}
