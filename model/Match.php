<?php

class Match {

    const TOP_TO_SHOW = 5;
    const FACTORS_SUM = 100;
    const MAX_DIFF_YEARS_EXP = 2;
    const MAX_DIFF_H_PRACTICE = 300;
    const MAX_DIFF_N_CONCERTS = 50;
    const MAX_DIFF_N_TOURS = 3;
    const MAX_DIFF_N_ALBUMS = 3;
    const MAX_DIFF_N_SONGS = 40;
    const MAX_DIFF_AGE = 10;

    private static $table = 'matches';
    private static $fillable_pk = [
        'id',
    ];
    private static $fillable_fk = [
        'user_id_1',
        'user_id_2',
    ];
    private static $fillable_pt_1 = [
        'rate',
        'type',
        'created_at'
    ];
    
     

    public static function get_all_rates($arr1, $arr2, $key1, $key2) {
        $ret = [];
        $count = 0;
        foreach ($arr1 as $id1) {
            foreach ($arr2 as $id2) {
                $rate = (int) self::get_rate($id1, $id2);
                $ret[$count][$key1] = $id1;
                $ret[$count][$key2] = $id2;
                $ret[$count]['rate'] = $rate;
                $count+=1;
            }
        }
        return $ret;
    }

    public static function get_all_rates_for_role($id1, $arr2, $key1, $key2) {
        $ret = [];
        $count = 0;
        foreach ($arr2 as $id2) {
            $scores = self::get_rate($id1, $id2);
            $rate = array_sum($scores);
            $ret[$count][$key1] = $id1;
            $ret[$count][$key2] = $id2;
            $ret[$count]['rate'] = $rate;
            $ret[$count]['scores'] = $scores;
            $count+=1;
        }
        return $ret;
    }

    public static function get_rate($user_id_1, $user_id_2) {
        // @TODO
        $type = self::get_type($user_id_1, $user_id_2);
        switch ($type) {
            case 1:
                $mus_id = User::get_musician_id($user_id_1, $user_id_2);
                $band_id = User::get_band_id($user_id_1, $user_id_2);
                return self::get_rate_musician_and_band($mus_id, $band_id);
            case 2:
                $mus_id = User::get_musician_id($user_id_1, $user_id_2);
                $agent_id = User::get_agent_id($user_id_1, $user_id_2);
                return self::get_rate_musician_and_agent($mus_id, $agent_id);
            case 3:
                $band_id = User::get_band_id($user_id_1, $user_id_2);
                $agent_id = User::get_agent_id($user_id_1, $user_id_2);
                return self::get_rate_band_and_agent($band_id, $agent_id);
            default:
                return false;
        }
    }

    public static function get_type($user_id_1, $user_id_2) {
        /*
         * 1    musician    &   band
         * 2    musician    &   agent
         * 3    band        &   agent
         */
        $role_1 = User::get_role_from_id($user_id_1);
        $role_2 = User::get_role_from_id($user_id_2);
        if (User::musician_and_band($role_1, $role_2)) {
            return 1;
        } else if (User::musician_and_agent($role_1, $role_2)) {
            return 2;
        } else if (User::band_and_agent($role_1, $role_2)) {
            return 3;
        }
        return false;
    }

    public static function get_rate_musician_and_band($mus_id, $band_id) {
        return MatchMusicianBand::get_rate($mus_id, $band_id);
    }

    public static function get_rate_musician_and_agent($mus_id, $agent_id) {
        return MatchMusicianAgent::get_rate($mus_id, $agent_id);
    }

    public static function get_rate_band_and_agent($band_id, $agent_id) {
        return MatchBandAgent::get_rate($band_id, $agent_id);
    }

    public static function get_weights_sum($array) {
        $sum = 0;
        foreach ($array as $key => $value) {
            $sum+=$value;
        }
        return $sum;
    }

    public static function check_weights_sum($sum) {
        if ($sum == self::FACTORS_SUM) {
            return true;
        }
        return false;
    }

    public static function weights_to_percentage($array) {
        $sum = self::get_weights_sum($array);
        if (!self::check_weights_sum($sum)) {
            return false;
        }
        $ret = [];
        foreach ($array as $key => $value) {
            $ret[$key] = round(($value / $sum), 2);
        }
        return $ret;
    }

    public static function factor_instrument_in_pursuit($user_id_1, $user_id_2) {
        return self::factor_in_pursuit($user_id_1, $user_id_2, 'instrument');
    }

    public static function factor_genre_in_pursuit($user_id_1, $user_id_2) {
        return self::factor_in_pursuit($user_id_1, $user_id_2, 'genre');
    }

    public static function factor_in_pursuit($user_id_1, $user_id_2, $field) {
        $intersect = self::factor_in_pursuit_to_array($user_id_1, $user_id_2, $field);
        if (!empty($intersect)) {
            return 1;
        }
        return 0;
    }

    public static function factor_in_pursuit_to_array($user_id_1, $user_id_2, $field) {
        $arg = 'user_id';
        $table = 'pursuits';
        return self::factor_in_pursuits_table_to_array($arg, $user_id_1, $table, $arg, $user_id_2, $table, $field);
    }

    public static function factor_in_pursuits_table_to_array($arg1, $arg1_val, $table1, $arg2, $arg2_val, $table2, $field) {
        $role1 = User::get_role_from_id($arg1_val);
        $role2 = User::get_role_from_id($arg2_val);

        $fields = [
            $field
        ];
        $args = [
            $arg1 => $arg1_val,
            'role_pursuited' => $role2
        ];
        $insts_user_id_1 = SharedRepository::select_multi_array($fields, $table1, $args);
//        Presentation::print_array($insts_user_id_1);
        $args = [
            $arg2 => $arg2_val,
            'role_pursuited' => $role1
        ];
        $insts_user_id_2 = SharedRepository::select_multi_array($fields, $table2, $args);
//        Presentation::print_array($insts_user_id_2);

        return DataStructure::get_intersect_multi_array($insts_user_id_1, $insts_user_id_2);
    }

    public static function factor_in_mus_exp_band_and_band_exp($user_id_1, $user_id_2, $field) {
        $intersect = self::factor_in_mus_exp_band_and_band_exp_to_array($user_id_1, $user_id_2, $field);
        if (!empty($intersect)) {
            return 1;
        }
        return 0;
    }

    public static function factor_in_mus_exp_band_and_band_exp_to_array($user_id_1, $user_id_2, $field) {
        $arg1 = 'musician_id';
        $arg1_val = $user_id_1;
        $table1 = 'musicians_experience_bands';
        $arg2 = 'band_id';
        $arg2_val = $user_id_2;
        $table2 = 'bands_experience';
        return self::factor_in_tables_to_array($arg1, $arg1_val, $table1, $arg2, $arg2_val, $table2, $field);
    }

    public static function factor_in_band_exp_and_agent_exp($user_id_1, $user_id_2, $field) {
        $intersect = self::factor_in_band_exp_and_agent_exp_to_array($user_id_1, $user_id_2, $field);
        if (!empty($intersect)) {
            return 1;
        }
        return 0;
    }

    public static function factor_in_band_exp_and_agent_exp_to_array($user_id_1, $user_id_2, $field) {
        $arg1 = 'band_id';
        $arg1_val = $user_id_1;
        $table1 = 'bands_experience';
        $arg2 = 'agent_id';
        $arg2_val = $user_id_2;
        $table2 = 'agents_experience';
        return self::factor_in_tables_to_array($arg1, $arg1_val, $table1, $arg2, $arg2_val, $table2, $field);
    }

    public static function factor_in_mus_exp_band_and_agent_exp($user_id_1, $user_id_2, $field) {
        $intersect = self::factor_in_mus_exp_band_and_agent_exp_to_array($user_id_1, $user_id_2, $field);
        if (!empty($intersect)) {
            return 1;
        }
        return 0;
    }

    public static function factor_in_mus_exp_band_and_agent_exp_to_array($user_id_1, $user_id_2, $field) {
        $arg1 = 'musician_id';
        $arg1_val = $user_id_1;
        $table1 = 'musicians_experience_bands';
        $arg2 = 'agent_id';
        $arg2_val = $user_id_2;
        $table2 = 'agents_experience';
        return self::factor_in_tables_to_array($arg1, $arg1_val, $table1, $arg2, $arg2_val, $table2, $field);
    }

    public static function factor_in_tables_to_array($arg1, $arg1_val, $table1, $arg2, $arg2_val, $table2, $field) {
        $fields = [
            $field
        ];
        $args = [
            $arg1 => $arg1_val
        ];
        $insts_user_id_1 = SharedRepository::select_multi_array($fields, $table1, $args);
//        Presentation::print_array($insts_user_id_1);
        $args = [
            $arg2 => $arg2_val
        ];
        $insts_user_id_2 = SharedRepository::select_multi_array($fields, $table2, $args);
//        Presentation::print_array($insts_user_id_2);

        return DataStructure::get_intersect_multi_array($insts_user_id_1, $insts_user_id_2);
    }

    public static function factor_in_experience_and_array($table, $arg1, $arg2, $user_id, $array) {
        foreach ($array as $key => $value) {
            $args = [
                $arg1 => $value,
                $arg2 => $user_id
            ];
            if (SharedRepository::select_exists($table, ['id'], $args)) {
                return 1;
            }
        }
        return 0;
    }

    public static function same_region($user_1, $user_2) {
        return self::same_location($user_1, $user_2, 'region');
    }

    public static function same_country($user_1, $user_2) {
        return self::same_location($user_1, $user_2, 'country');
    }

    public static function same_city($user_1, $user_2) {
        if (self::same_location($user_1, $user_2, 'country') == true) {
            return self::same_location($user_1, $user_2, 'city_state');
        }
        return false;
    }

    public static function same_location($user_1, $user_2, $field) {
        $table = User::get_table_name();
        $args = ['id' => $user_1];
        $loc_1 = SharedRepository::select_value($table, [$field], $args);
        $args = ['id' => $user_2];
        $loc_2 = SharedRepository::select_value($table, [$field], $args);
        if (strcasecmp($loc_1, $loc_2) == 0) {
            return true;
        }
        return false;
    }

    public static function years_experience($user_1_y, $user_2_y) {
        return self::compare_to_max($user_1_y, $user_2_y, self::MAX_DIFF_YEARS_EXP);
    }

    public static function hours_practice($arr1, $arr2) {
        $sum1 = array_sum($arr1);
        $sum2 = array_sum($arr2);
        return self::compare_to_max($sum1, $sum2, self::MAX_DIFF_H_PRACTICE);
    }

    public static function number_concerts($arr1, $arr2) {
        $sum1 = array_sum($arr1);
        $sum2 = array_sum($arr2);
        return self::compare_to_max($sum1, $sum2, self::MAX_DIFF_N_CONCERTS);
    }

    public static function number_tours($arr1, $arr2) {
        $sum1 = array_sum($arr1);
        $sum2 = array_sum($arr2);
        return self::compare_to_max($sum1, $sum2, self::MAX_DIFF_N_TOURS);
    }

    public static function number_albums($arr1, $arr2) {
        $sum1 = array_sum($arr1);
        $sum2 = array_sum($arr2);
        return self::compare_to_max($sum1, $sum2, self::MAX_DIFF_N_ALBUMS);
    }

    public static function number_songs($arr1, $arr2) {
        $sum1 = array_sum($arr1);
        $sum2 = array_sum($arr2);
        return self::compare_to_max($sum1, $sum2, self::MAX_DIFF_N_SONGS);
    }

    public static function compare_to_max($v1, $v2, $max) {
        if (($v1 - $v2 > $max) ||
                ($v2 - $v1 > $max)) {
            return 0;
        }
        return 1;
    }

    public static function get_all_rates_ordered($all) {
        usort($all, function($a, $b) {
            return $b['rate'] - $a['rate'];
        });
        return $all;
    }

    public static function get_top_rates_ordered($arr) {
        $ret = [];
        $size = sizeof($arr);
        $lenght = self::TOP_TO_SHOW;
        if ($size < $lenght) {
            $lenght = $size;
        }
        foreach (range(0, $lenght - 1) as $i) {
            $ret[$i] = $arr[$i];
        }
        return $ret;
    }

    public static function get_rates_by_intervals($arr, $intervals) {
        $low = [];
        $medium = [];
        $high = [];
        $very_high = [];
        $ret = ['low' => [], 'medium' => [], 'high' => [], 'very_high' => []];
        foreach ($arr as $key => $value) {
            $interval = self::get_interval($value['rate'], $intervals);
            switch ($interval) {
                case 'low':
                    array_push($low, $value);
                    break;
                case 'medium':
                    array_push($medium, $value);
                    break;
                case 'high':
                    array_push($high, $value);
                    break;
                case 'very_high':
                    array_push($very_high, $value);
                    break;
                default:
                    break;
            }
        }
        array_push($ret['low'], $low);
        array_push($ret['medium'], $medium);
        array_push($ret['high'], $high);
        array_push($ret['very_high'], $very_high);
        return $ret;
    }

    public static function get_interval($rate, $intervals) {
        if ($rate < $intervals['medium']['min']) {
            return 'low';
        } else if ($rate < $intervals['high']['min']) {
            return 'medium';
        } else if ($rate < $intervals['very_high']['min']) {
            return 'high';
        } else {
            return 'very_high';
        }
    }

    public static function matches_by_intervals_to_string($array, $append) {
        $low = sizeof($array['low'][0]);
        $medium = sizeof($array['medium'][0]);
        $high = sizeof($array['high'][0]);
        $very_high = sizeof($array['very_high'][0]);
        return "Your current count for matches with <b>$append</b>:" .
                "<br>" .
                "<br>$low - Low" .
                "<br>$medium - Medium" .
                "<br>$high - High" .
                "<br>$very_high - Very High";
    }

    public static function get_weights_description($weights, $des) {
        $ret = [];
        foreach ($weights as $key => $value) {
            $ret[$key] = [
                'weight' => $value,
                'description' => $des[$key],
            ];
        }
        return $ret;
    }
    
    public static function get_weights_description_by_type($type){
        $desc = [];
        switch ($type) {
            case 1:
                $desc = MatchMusicianBand::get_weights_description();
                break;
            case 2:
                $desc = MatchMusicianAgent::get_weights_description();
                break;
            case 3:
                $desc = MatchBandAgent::get_weights_description();
                break;
            default:
                break;
        }
        return $desc;
    }

    public static function print_factor($n, $val, $w, $res) {
        $str = "<br> ------------------------------";
        $str.= "<br>fac $n : $val * $w = $res";
        $str.= "<br> ------------------------------";
        return $str;
    }

}
