<?php

class MusicComposition {

    private static $composing_options = array(
        'Writing',
        'Composing',
        'Both',
        'None',
    );

    public static function get_all_options() {
        return self::$composing_options;
    }

}
