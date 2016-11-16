<?php

class Practice {

    const MIN = 100;
    const MIN_MAX_THRESHOLD = 1000;
    const MAX = 10000;
    const LOW_JUMP = 100;
    const HIGH_JUMP = 1000;

    public static function get_all_hours() {
        return array_merge(self::get_hours_low_practice(),self::get_hours_high_practice());
    }

    public static function get_hours_low_practice() {
        $array = [];
        for ($i = self::MIN; $i <= self::MIN_MAX_THRESHOLD; $i+=self::LOW_JUMP) {
            $array[] = $i;
        }
        return $array;
    }

    public static function get_hours_high_practice() {
        $array = [];
        $start = self::MIN_MAX_THRESHOLD + self::HIGH_JUMP;
        for ($i = $start; $i <= self::MAX; $i+=self::HIGH_JUMP) {
            $array[] = $i;
        }
        return $array;
    }

}
