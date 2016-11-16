<?php

class Song {

    private static $song_sources = [
        'Originals',
        'Covers',
        'Both'
    ];

    public static function get_all_sources() {
        return self::$song_sources;
    }

}
