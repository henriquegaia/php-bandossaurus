<?php

class Country {

    private static $countries = array(
       'Portugal',
        'Spain'
    );

    public static function get_all() {
        return self::$countries;
    }

}
