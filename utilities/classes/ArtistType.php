<?php

class ArtistType {
    private static $options = array(
        'Band',
        'Solo Artist'
    );

    public static function get_all_options() {
        return self::$options;
    }
}
