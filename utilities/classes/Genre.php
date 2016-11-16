<?php

class Genre {

    public static function get_all() {
        return self::$genres;
    }

    private static $genres = [
        'Black Metal',
        'Blues',
        'Classical',
        'Country',
        'Death Metal',
        'Doom Metal',
        'Electronic',
        'Electronic Rock',
        'Folk',
        'Funk Metal',
        'Gothic Metal',
        'Grindcore Metal',
        'Groove Metal',
        'Grunge',
        'Hardcore Metal',
        'Heavy Metal',
        'Hip Hop',
        'House Music',
        'Jazz',
        'Latin',
        'Metal',
        'Nu-Metal',
        'Pop',
        'Pop Rock',
        'Power Metal',
        'Progressive Metal',
        'Progressive Rock',
        'Punk Rock',
        'Rap',
        'Reggae',
        'Rhythm and Blues (R&B)',
        'Rock',
        'Rock n Roll',
        'Soul',
        'Southern Rock',
        'Speed Metal',
        'Techno',
        'Thrash Metal'
    ];
    
    public static function to_string() {
        $str = '';
        foreach (self::$genres as $value) {
            $str.=$value . ', ';
        }
        return $str;
    }

}
