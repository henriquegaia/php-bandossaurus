<?php

class Location {

    private static $countries_with_coordinates = [
        'united states',
//        'brazil'
    ];

    public static function get_countries_with_coordinates() {
        return self::$countries_with_coordinates;
    }

    public static function country_has_coordinates($country) {
        $country=  strtolower($country);
        return in_array($country, self::$countries_with_coordinates);
    }

}
