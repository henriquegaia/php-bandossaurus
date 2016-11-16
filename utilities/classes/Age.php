<?php

class Age {
    /*
     * You are *required* to use the date.timezone setting or 
     * the date_default_timezone_set() function.
     */

    public static function years_from_date_intervals_in_multi_array($array) {
        $ret = [];
        foreach ($array as $key => $value) {
            $start = $value['start_date'];
            $end = $value['end_date'];
            if ($end == 0) {
                $ret[] = self::get_years_from_birth_date($start);
            } else {
                $ret[] = self::get_years_between_dates($start, $end);
            }
        }
        return $ret;
    }

    public static function same_year_and_month($timestamp) {
        $year_timestamp = Age::get_year_txt_from_timestamp($timestamp);
        $month_timestamp = Age::get_month_txt_from_timestamp($timestamp);
        $month_now = Age::get_month_txt_from_timestamp(date('M'));
        $year_now = Age::get_year_txt_from_timestamp(date('Y'));
        if ($year_now == $year_timestamp && strcasecmp($month_now, $month_timestamp) == 0) {
            return true;
        }
        return false;
    }

    public static function get_friendly_date_from_timestamp($timestamp) {
        $year = self::get_year_txt_from_timestamp($timestamp);
        $day = self::get_day_txt_from_timestamp($timestamp);
        $month = self::get_month_txt_from_timestamp($timestamp);
        return $day . ' ' . $month . ' ' . $year;
    }

    public static function get_month_txt_from_timestamp($timestamp) {
        $date = strtotime($timestamp);
        $monthNum = date("m", $date);
        $dateObj = DateTime::createFromFormat('!m', $monthNum);
        return $dateObj->format('F'); // March
    }

    public static function get_day_txt_from_timestamp($timestamp) {
        $date = strtotime($timestamp);
        return date("d", $date);
    }

    public static function get_year_txt_from_timestamp($timestamp) {
        $date = strtotime($timestamp);
        return date("Y", $date);
    }

    public static function get_years_from_birth_date($birth_date) {
        $interval = self::get_interval_from_birth_date($birth_date);
        return $interval->y;
    }
    
    public static function get_interval_from_birth_date($birth_date) {
        $date = new DateTime($birth_date);
        $now = new DateTime();
        return $now->diff($date);
    }

    public static function get_years_between_dates($b1, $b2) {
        $interval = self::get_interval_between_dates($b1, $b2);
        return $interval->y;
    }

    public static function get_interval_between_dates($b1, $b2) {
        $d1 = new DateTime($b1);
        $d2 = new DateTime($b2);
        return $d2->diff($d1);
    }

    public static function get_birth_date_from_age($age) {
        $age = (int) $age;
        if (!is_int($age)) {
            return false;
        } else if ($age <= 0) {
            return false;
        }
        $now = new DateTime();
        $modify = '-' . $age . ' years';
        return $now->modify($modify)->format(Validation::DATE_FORMAT);
    }

    public static function add_days_to_date($date, $days) {
        $date = new DateTime($date);
        $date->add(new DateInterval('P' . $days . 'D'));
        return $date->format(Validation::DATE_FORMAT);
    }

    public static function subtract_days_to_date($date, $days) {
        $date = new DateTime($date);
        $date->sub(new DateInterval('P' . $days . 'D'));
        return $date->format(Validation::DATE_FORMAT);
    }

}
