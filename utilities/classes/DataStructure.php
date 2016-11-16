<?php

class DataStructure {
    /*
     * ***************************************************************************
     * HTTP 
     * ***************************************************************************
     */

    public static function get_current_file() {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $parts = explode('/', $path);
        $filename = end($parts);
        $filename_arr = explode('.', $filename);
        return $filename_arr[0];
    }

    public static function get_keywords() {
        return 'musician, musicians, find musician, find musicians, band, bands, find bands, agent, agents, find agents, music, musician, song, songs, search, profile, experience, pursuit, match, ' . Instrument::most_common_to_string() . Genre::to_string();
    }

    /*
     * ***************************************************************************
     * age to sql
     * ***************************************************************************
     */

    public static function age_to_sql_ON_from_INNER_JOIN($params, $table, $field) {
        /*
         * case 1: 32-32
         *      12-7-1983 to 11-7-1984  
         * 
         * case 2: >=32
         * 
         * case 3: <=32
         *      >= 12-7-1983 
         * 
         * case 4: 32-33
         *      12-7-1982 to 11-7-1984
         */
        $age_opt = $params['age_opt'];

        if (strcasecmp($age_opt, 'all') == 0) {
            return '';
        } else {
            $age_min = $params['age_min'];
            $date_max = Age::get_birth_date_from_age($age_min);
            $age_max = $params['age_max'];
            $date_min = Age::get_birth_date_from_age($age_max);

            /////////////
            // case 1
            /////////////
            if ($age_min == $age_max) {
                $date_min = Age::subtract_days_to_date($date_min, 365);
                return "$table.$field BETWEEN '$date_min' AND '$date_max'";
            }
            /////////////
            // case 2
            /////////////
            else if ($date_min == false && !empty($date_max)) {
                return "$table.$field <= '$date_max'";
            }
            /////////////
            // case 3
            /////////////
            else if ($date_max == false && !empty($date_min)) {
                $date_min = Age::subtract_days_to_date($date_min, 365);
                return "$table.$field >= '$date_min'";
            }
            /////////////
            // case 4
            /////////////
            else if (!empty($date_max) && !empty($date_min) && ($age_min < $age_max)) {
                $date_min = Age::subtract_days_to_date($date_min, 364);
                return "$table.$field BETWEEN '$date_min' AND '$date_max'";
            }
            return '';
        }
    }

    /*
     * ***************************************************************************
     * location to sql
     * ***************************************************************************
     */

    public static function location_to_sql_ON_from_INNER_JOIN($params, $table, $location_fields) {
        $loc_opt = $params['loc_opt'];

        switch (strtolower($loc_opt)) {
            case 'proximity':
                return self::location_proximity_to_sql_ON_from_INNER_JOIN($table, $params);
            case 'detail':
                return self::location_detail_to_sql_ON_from_INNER_JOIN($table, $params);
            default:
                return '';
        }
    }

    public static function location_proximity_to_sql_ON_from_INNER_JOIN($table, $params) {
        $country = User::get_country();
        return "$table.country = '$country'";
    }

    public static function location_detail_to_sql_ON_from_INNER_JOIN($table, $params) {
        $loc = $params['loc'];
        $loc = self::duplicate_single_quote($loc);
        $loc_type = $params['loc_type'];
        $loc_type = strtolower(trim($loc_type));

        switch ($loc_type) {
            case 'region':
                return "$table.region = '$loc'";
            case 'country':
                return "$table.country = '$loc'";
            case 'city_state':
                $loc_detail_city = $params['loc_detail_city'];
                $loc_detail_city = self::duplicate_single_quote($loc_detail_city);
                $loc_detail_country = $params['loc_detail_country'];
                $loc_detail_country = self::duplicate_single_quote($loc_detail_country);

                return " $table.country = '$loc_detail_country' AND "
                        . "$table.city_state = '$loc_detail_city' ";
            default:
                /*
                 * js handles this; shows 'no results';
                 */
                break;
        }
    }

    /*
     * ***************************************************************************
     * gender to sql
     * ***************************************************************************
     */

    public static function gender_to_sql_ON_from_INNER_JOIN($params, $table, $field) {
        $gender = $params['gender'];
        if ($gender == 'all') {
            return '';
        }
        return "$table.$field = '$gender'";
    }

    /*
     * ***************************************************************************
     * instrument to sql
     * ***************************************************************************
     */

    public static function instrument_to_sql_ON_from_INNER_JOIN($params, $table, $field) {
        $opt = $params['inst_opt'];
        if ($opt == 'all') {
            return '';
        }
        $inst = $params['inst'];
        return "$table.$field = '$inst'";
    }

    /*
     * ***************************************************************************
     * genre to sql
     * ***************************************************************************
     */

    public static function genre_to_sql_ON_from_INNER_JOIN($params, $table, $field) {
        $opt = $params['genre_opt'];
        if ($opt == 'all') {
            return '';
        }
        $genre = $params['genre'];
        return " $table.$field = '$genre' ";
    }

    /*
     * ***************************************************************************
     * Helpers
     * ***************************************************************************
     */

    public static function get_keys_from_array_to_sql($data) {
        return '`' . implode('`, `', array_keys($data)) . '`';
    }

    public static function get_values_from_array_to_sql($data) {
        return '\'' . implode('\', \'', $data) . '\'';
    }

    public static function get_array_to_sql_comma_divide($data) {
        return self::get_array_to_sql($data, ', ', true);
    }

    public static function get_array_to_sql_comma_divide_no_keys($data) {
        return self::get_array_to_sql($data, ', ', false);
    }
    
    public static function get_array_to_sql_comma_divide_no_keys_search_ov($data) {
        return self::get_array_to_sql_search_ov($data, ', ', false);
    }

    public static function get_array_values_to_sql_comma_divide($data) {
        $result = '';
        $size = sizeof($data);
        $cont = 0;

        foreach ($data as $key => $value) {
            $result.='`' . $value . '`';
            $cont++;
            if ($cont != $size) {
                $result.=', ';
            }
        }
        return $result;
    }

    public static function get_array_to_sql_AND_divide($data) {
        return self::get_array_to_sql($data, ' AND ', true);
    }

    public static function get_array_to_sql_AND_divide_no_keys($data) {
        return self::get_array_to_sql($data, ' AND ', false);
    }

    public static function get_array_to_sql_AND_divide_no_keys_search_ov($data) {
        return self::get_array_to_sql_search_ov($data, ' AND ', false);
    }

    public static function get_array_to_sql_OR_divide($data) {
        return self::get_array_to_sql($data, ' OR ', true);
    }

    // original version
//    private static function get_array_to_sql($data, $separator, $use_keys) {
//        $result = '';
//        $size = sizeof($data);
//        $cont = 0;
//
//        foreach ($data as $key => $value) {
//            if ($use_keys == true) {
//                $result.='`' . $key . '`=\'' . $value . '\'';
//            } else {
//                $result.=$value;
//            }
//
//            $cont++;
//            if ($cont != $size) {
//                $result.=$separator;
//            }
//        }
//        return $result;
//    }
    // versio 2
//    private static function get_array_to_sql($data, $separator, $use_keys) {
//        $result = '';
//        $size = sizeof($data);
//        $cont = 0;
//        $helper = DataStructure::get_array_helper($data);
//
//        JavaScript::console('------------ NEW ----------------');
//
//        foreach ($data as $key => $value) {
//            if ($use_keys == true) {
//                $result.='`' . $key . '`=\'' . $value . '\'';
//            } else {
//                $result.=$value;
//            }
//
//            $next_is_empty = DataStructure::array_next_value_empty($helper, $cont);
//            $cont++;
//            JavaScript::console('value: ' . $value);
//            JavaScript::console('next is empty: ' . $next_is_empty);
//            if ($cont != $size && $next_is_empty == false && empty(trim($value)) == false) {
//                $result.=$separator;
//            }else{
//                 $result.=' ';
//            }
//            JavaScript::console('result: ' . $result);
//            JavaScript::console('---------------------------------');
//        }
//        return $result;
//    }
    private static function get_array_to_sql_search_ov($data, $separator, $use_keys) {
        $result = '';
        $cont = 0;

        foreach ($data as $key => $value) {

            // Separator
            if ($use_keys == true && self::value_not_zero($value) && empty(trim($value)) == true) {
                $result.=$separator;
            } else if ($cont != 0 && self::value_not_zero($value) && empty(trim($value)) == false) {
                $result.=$separator;
            } else {
                $result.=' ';
            }

            // Key & Value
            if ($use_keys == true) {
                $result.='`' . $key . '`=\'' . $value . '\'';
            } else {
                $result.=$value;
            }
            $cont++;
        }
        return $result;
    }

    private static function get_array_to_sql($data, $separator, $use_keys) {
        $result = '';
        $cont = 0;
        $n = sizeof($data);

        foreach ($data as $key => $value) {

            // Add query
            if ($use_keys == true) {
                $result .= '`' . $key . '`=\'' . $value . '\'';
            } else {
                $result .= $value;
            }

            // Add separator
            if ($n > 1 && ($cont + 1 != $n)) {
                $result .= $separator;
            }
            $cont++;
        }
        return $result;
    }
    
    /*
     * ***************************************************************************
     * Arrays
     * ***************************************************************************
     */

    public static function multi_array_to_simple_array($array) {
        $ret = [];
        foreach ($array as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $ret[] = $value2;
            }
        }
        return $ret;
    }

    public static function get_intersect_multi_array($array_1, $array_2) {
        $array_1 = DataStructure::multi_array_to_simple_array($array_1);
        $array_2 = DataStructure::multi_array_to_simple_array($array_2);
        return array_intersect($array_1, $array_2);
    }

    public static function get_array_helper($array) {
        $cont = 0;
        $ret = [];
        foreach ($array as $key => $value) {
            $ret[$cont] = $value;
            $cont++;
        }
        return $ret;
    }

    public static function array_next_value_empty($array, $i) {
        $size = sizeof($array);
        if (($i + 1) == $size) {
            return true;
        }
        return empty(trim($array[$i + 1]));
    }

    public static function simple_array_to_key_value_array(array $arr_keys, $values) {
        $ret = [];
        for ($i = 0; $i < sizeof($arr_keys); $i++) {
            $ret[$arr_keys[$i]] = $values[$i];
        }
        return $ret;
    }

    public static function rename_array_keys($arr_keys, $arr_values) {
        $keys = array_keys($arr_keys);
        $values = array_values($arr_values);
        $ret = array_combine($keys, $values);
        return $ret;
    }

    public static function item_array_to_text($arr) {
        $text = '';
        $size = sizeof($arr);
        $last = $arr[$size - 1];
        foreach (range(0, $size - 1) as $i) {
            if ($i == 0) {
                $text = $arr[$i];
            } else if ($i == $size - 1) {
                $text.=' and ' . $arr[$i];
            } else {
                $text.=', ' . $arr[$i];
            }
        }
        return $text;
    }

    public static function get_fields_required_message($non_req_fields) {
        if (empty($non_req_fields)) {
            return 'All the fields are required.';
        } else {
            $non_req_txt = self::item_array_to_text($non_req_fields);
            return 'All the fields (except ' . $non_req_txt . ') are required.';
        }
    }

    public static function get_relation_element_order_and_id($arr, $key_name) {
        $ret = [];
        $count = 0;
        foreach ($arr as $key) {
            $ret[++$count] = $key[$key_name];
        }
        return $ret;
    }

    /*
     * ***************************************************************************
     * Strings
     * ***************************************************************************
     */

    public static function value_not_zero($value) {
        if ($value === (int) 0) {
            return false;
        }
        return true;
    }

    public static function prepare_string_comparison($str) {
        $str = strtolower($str);
        $str = str_replace(' ', '', $str);
        return $str;
    }

    public static function database_column_to_th($value) {
        if (strcasecmp('city_state', $value) == 0) {
            return str_replace('_', '/', $value);
        }
        return str_replace('_', ' ', $value);
    }

    public static function duplicate_single_quote($string) {
        return self::duplicate_char_in_string('\'', $string);
    }

    public static function duplicate_char_in_string($char, $string) {
        // ex: echo substr_replace('vava\'u', '\'\'', 4, -1);
        $string_chars = str_split($string);
        $size = sizeof($string_chars);
        $ret = $string;
        $count = 0;
        foreach ($string_chars as $key => $value) {
            if ($value == $char) {
                $start = $key + $count;
                $end = ($key - $size);
                $ret = substr_replace($ret, $char, $start, $end);
                $count++;
                $size++;
            }
        }
        return $ret;
    }

    /*
     * ***************************************************************************
     * HTML 
     * ***************************************************************************
     */

    public static function get_page_title() {
        global $config;
        $filename = self::get_current_file();
        if ($filename == 'index') {
            return $config['site']['title'];
        }
        $fname_no_under = str_replace('_', ' ', $filename);
        return ucwords($fname_no_under);
    }

    public static function get_page_description() {
        global $config;
        $s = $config['site']['title'];
        $filename = self::get_current_file();
        $generic_desc = 'Tell us your musical experience and we will show you the musicians, bands and agents that best match you.';
        switch ($filename) {
            case 'index':
                return $generic_desc;
            /*
             * *********
             * web/base
             * *********
             */
            case 'activate':
                return 'Get the result status of the account activation process.';
            case 'admin':
                return "The admin page for $s.";
            case 'change_password':
                return "Change account password for $s and make your account safer.";
            case 'check_user_profile':
                return "Allow a user of $s, logged in or not, to check another user profile.";
            case 'force_logout':
                return 'Forces the logout if respective POST is set.';
            case 'login':
                return "Log in $s to see if your musical career is about to change.";
            case 'logout':
                return "Log out from $s and we expect to see you soon.";
            case 'mass_mail':
                return "$s page that admin uses to send mass email.";
            case 'profile':
                return "Profile of user currently logged in $s.";
            case 'protected':
                return 'Page to be shown when user is not authorized.';
            case 'recover':
                return "Recover you username or password from $s.";
            case 'redirect_to_recover':
                return "Informs user that a recovery of username/password is needed since the limit tries of login in $s have been achieved.";
            case 'register':
                return "Register in $s and find the musicians, bands and agents that best match your musical experience and interests.";
            case 'register_pre':
                return "Before register in $s choose what is your role: musician, band or agent.";
            case 'role':
                return "";
            case 'settings':
                return "Change your name, email and/or location for $s.";
            case 'settings_band_members':
                return "If you are registered as a band in $s, here you can change each band member name, gender, birth date, join date and instrument associated.";
            /*
             * *********
             * web/exp
             * *********
             */
            case 'experience_agent':
                $role = 'agent';
            case 'experience_band':
                $role = 'band';
            case 'experience_musician_alone':
            case 'experience_musician_bands':
                $role = 'musician';
                return "If you are registered as a $role in $s, here you can change your experience information, which will be important to find the best matches.";
            /*
             * *********
             * web/footer
             * *********
             */
            case 'contact':
                return "Have a question? Send an email to $s.";
            case 'privacy':
                return "Privacy information on $s.";
            case 'terms':
                return "Terms information on $s.";
            /*
             * *********
             * web/invitations
             * *********
             */
            case 'invitations':
                return "Check out your sent and received invitations on $s.";
            /*
             * *********
             * web/matches
             * *********
             */
            case 'matches':
                return "Check out your best matches for musicians, bands and/or agents on $s.";
            /*
             * *********
             * web/messages
             * *********
             */
            case 'messages':
                return "Check out your sent and received messages on $s.";
            /*
             * *********
             * web/premium
             * *********
             */
            case 'paypal_checkout':
                return "Before becoming premium in $s, check the payment details.";
            case 'paypal_pay':
                return "After paying on Paypal check out the status of the payment and of the process of becoming premium in $s.";
            case 'premium':
                return "Differences between regular and premium accounts on $s.";
            case 'revoke_premium':
                return "Status of revoking premium account request.";
            /*
             * *********
             * web/pursuit
             * *********
             */
            case 'pursuit':
                return "Tell $s whether you are looking for a musician, a band or an agent.";
            /*
             * *********
             * web/search/by_pursuit
             * *********
             */
            case 'search_by_pursuit':
                return "Search filter on what every user of $s is looking for.";
            /*
             * *********
             * web/search/overall
             * *********
             */
            case 'search_overall':
                return "Search filter on every user of $s.";
            default:
                return $generic_desc;
        }
    }

}
