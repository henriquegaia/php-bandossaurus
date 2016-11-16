<?php

/**
 * Description of City
 *
 * @author ah e tal
 */
class City {

    
    private static $cities = array(
        'Lisbon',
        'Madrid'
    );

    public static function get_all() {
        return self::$cities;
    }

}
