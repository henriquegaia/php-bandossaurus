<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Random
 *
 * @author ah e tal
 */
class Random {

    public static function date($date_start, $date_end) {

//        $date_start = strtotime('2009-12-10'); //you can change it to your timestamp;
//        $date_end = strtotime('2009-12-31'); //you can change it to your timestamp;

        $date_start = strtotime($date_start); //you can change it to your timestamp;
        $date_end = strtotime($date_end); //you can change it to your timestamp;
        $day_step = 86400;
        $date_between = abs(($date_end - $date_start) / $day_step);
        $random_day = rand(0, $date_between);
        return date("Y-m-d", $date_start + ($random_day * $day_step));
    }

    public static function array_value($arr) {
        return $arr[array_rand($arr)];
    }

    public static function integer() {
        $min = 1;
        $max = 999999;
        $session_name = 'last_random_int';
        $last = '';
        if (isset($_SESSION[$session_name])) {
            $last = $_SESSION[$session_name];
        }
        $ret = rand($min, $max);
        while ($ret == $last) {
            $ret = rand($min, $max);
        }
        $_SESSION[$session_name] = $ret;
        return $ret;
    }

}
