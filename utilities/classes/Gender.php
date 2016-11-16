<?php

class Gender {

    private static $genders = array(
        'Male',
         'Female'
    );

    public static function get_all() {
        return self::$genders;
    }

}
