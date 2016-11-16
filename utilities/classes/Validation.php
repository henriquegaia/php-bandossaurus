<?php

class Validation {
    /*
     * **************************************************
     * Constants
     * **************************************************
     */

    const DATE_FORMAT = 'Y-m-d';
    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /*
     * **************************************************
     * Integer
     * **************************************************
     */

    public static function is_value_in_range($value, $min, $max) {
        if ($value >= $min && $value <= $max) {
            return true;
        }
        return false;
    }

    /*
     * **************************************************
     * Date
     * **************************************************
     */

    public static function add_days_to_now_date($n) {
        $date = date_create();
        date_add($date, date_interval_create_from_date_string("$n days"));
        return date_format($date, self::DATE_TIME_FORMAT);
    }

    public static function date_format($date) {
        $d = DateTime::createFromFormat(self::DATE_FORMAT, $date);
        return $d && $d->format(self::DATE_FORMAT) === $date;
    }

    public static function date_format_error_message() {
        return 'The date migth have wrong format. It should be like ' . self::DATE_FORMAT . ', where: '
                . '<br>d = day (2 digits), '
                . '<br>m = month (2 digits) and '
                . '<br>Y = year (4 digits). '
                . '<br>Don\'t forget the 2 hyphens \'-\'.';
    }

    public static function date($date_test, $role, $mode) {
        if (!self::date_format($date_test)) {
            return false;
        }
        if (!self::date_earlier_than_tomorrow($date_test)) {
            return false;
        }

        if ($mode == 'birth') {
            $min = Role::get_min_age($role);
            $max = Role::get_max_age($role);
            $date = new DateTime($date_test);
            $year_test = $date->format('Y');
            $year_now = date('Y');
            $year_span = $year_now - $year_test;
            return self::is_value_in_range($year_span, $min, $max);
        } else {
            return true;
        }
    }

    public static function date_d1_before_date_d2($d1, $d2) {
        if (!self::date_format($d1) || !self::date_format($d2)) {
            return false;
        }
        if (!self::date_earlier_than_tomorrow($d1) || !self::date_earlier_than_tomorrow($d2)) {
            return false;
        }
        $d1 = new DateTime($d1);
        $d2 = new DateTime($d2);
        return $d1 < $d2;
    }

    public static function date_earlier_than_tomorrow($date_test) {
        if ($date_test == '' || $date_test == NULL || empty($date_test) == true) {
            return false;
        }

        $date_now = Date(self::DATE_FORMAT);
        $date_test = Date($date_test);

        if ($date_test > $date_now) {
            return false;
        }
        return true;
    }

    public static function get_year_span($diff) {
        return floor($diff / (365 * 60 * 60 * 24));
    }

    public static function get_month_span($diff, $year_span) {
        return floor(($diff - $year_span * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    }

    public static function get_day_span($diff, $year_span, $months_span) {
        return floor(($diff - $year_span * 365 * 60 * 60 * 24 - $months_span * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    }

    /*
     * **************************************************
     * URL
     * **************************************************
     */

    public static function valid_url_with_query($url) {
        if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED) === false) {
            return true;
        }
        return false;
    }

    public static function url_exists($url) {
        $headers = @get_headers($url);
        if (strpos($headers[0], '200') === false) {
            return false;
        }
        return true;
    }

}
