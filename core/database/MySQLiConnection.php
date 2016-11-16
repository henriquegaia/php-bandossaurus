<?php

class MySQLiConnection extends Connection {

    private static $conn;
    private static $DB_HOST;
    private static $DB_USER;
    private static $DB_PASS;
    private static $DB_NAME;

    public static function connect() {
        self::set_credentials();
        $conn = mysqli_connect(self::$DB_HOST, self::$DB_USER, self::$DB_PASS, self::$DB_NAME);
        if (!$conn) {
            die("We are experiencing technical problems. "
                    . "Will try to wake up as soon as possible.");
        }
        self::$conn = $conn;
        return self::$conn;
    }

    private static function set_credentials() {
        global $config;
//        $ini = parse_ini_file($config['file']['ini']);
//        $pass=$ini['password'];
        if (Project::testing()) {
            /*
             * *******************************************************
             * if in development stage
             * *******************************************************
             */
            self::$DB_HOST = parent::$localhost_DB_HOST;
            self::$DB_USER = parent::$localhost_DB_USER;
            self::$DB_PASS = parent::$localhost_DB_PASS;
            self::$DB_NAME = parent::$localhost_DB_NAME;
        } else {
            /*
             * *******************************************************
             * if in production stage
             * *******************************************************
             */
            self::$DB_HOST = parent::$web_DB_HOST;
            self::$DB_USER = parent::$web_DB_USER;
            self::$DB_PASS = parent::$web_DB_PASS;
            self::$DB_NAME = parent::$web_DB_NAME;
        }
    }

}
