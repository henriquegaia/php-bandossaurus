<?php

class Singer {

    private static $singing_options = array(
        'No',
        'Yes'
    );

    public static function get_all_options() {
        return self::$singing_options;
    }

}
