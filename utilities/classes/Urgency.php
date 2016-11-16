<?php
class Urgency {
    private static $options = [
        'Yes',
        'No',
    ];

    public static function get_all_options() {
        return self::$options;
    }
}
