<?php

class Security {

    const HASH_COST = 10;
    //bad login
    const BAD_LOGIN_LIMIT_TRIES = 2;
    const BAD_LOGIN_LIMIT_TIME = 20; //seconds

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function array_sanitize($conn, $array) {
        $array_sanitized = [];
        foreach ($array as $key => $value) {
            $array_sanitized[$key] = self::sanitize($conn, $value);
        }
        return $array_sanitized;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function sanitize($conn, $data) {
        return htmlentities(strip_tags(mysqli_real_escape_string($conn, $data)));
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_appropriate_hash_cost($timeTarget, $password) {
//$timeTarget = 0.05; // 0.05 == 50 milliseconds 
        $cost = 8;
        do {
            $cost++;
            $start = microtime(true);
            password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);

        echo "Appropriate Cost Found for password '$password' for $timeTarget seconds: " . $cost . "<br><br>";
        return $cost;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_salted_hash($hash) {
        global $config;
        $cost = self::get_hash_cost();
        return substr($hash, 0, 60);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function encrypte_password($password) {
        $options = [
            'cost' => self::get_hash_cost(),
        ];
        $salted_hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return self::get_salted_hash($salted_hash);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_hash_cost() {
        return self::HASH_COST;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function protected_page() {
        if (User::logged_in() === false) {
            Redirect::no_status('protected', '');
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    function admin_protect() {
        global $user_data;
        if (User::has_access($user_data['id'], 1) === false) {
            Redirect::to_index();
        }
    }

}
