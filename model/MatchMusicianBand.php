<?php

class MatchMusicianBand {

    private static $weights = [
        1 => 18,
        2 => 17,
        3 => 16,
        4 => 15,
        5 => 14,
        6 => 4,
        7 => 2,
        8 => 2,
        9 => 2,
        10 => 2,
        11 => 2,
        12 => 2,
        13 => 2,
        14 => 1,
        15 => 1,
    ];
    private static $weights_desc = [
        1 => 'both pursuing the same instrument',
        2 => 'both pursuing the same musical genre',
        3 => 'musician has experience in bands with the instument that both are pursuing',
        4 => 'musician has experience alone with the instument that both are pursuing',
        5 => 'both on the same city',
        6 => 'musician has time in bands similar to the age of the band',
        7 => 'musician has experience in bands in a genre that the band also has',
        8 => 'musician has hours of practice in bands similar to the band',
        9 => 'musician has number of concerts in bands similar to the band',
        10 => 'musician has number of tours in bands similar to the band',
        11 => 'musician has number of albums in bands similar to the band',
        12 => 'musician has number of songs in bands similar to the band',
        13 => 'musician has experience alone in a genre that the band also has',
        14 => 'musician has hours of practice alone similar to the band',
        15 => 'musician age is similar to the average age in the band'
    ];

    public static function get_weights_description() {
        return Match::get_weights_description(self::$weights, self::$weights_desc);
    }

    public static function get_rates_intervals() {
        $medium = self::get_medium_rate_threshold();
        $high = self::get_high_rate_threshold();
        $v_high = self::get_very_high_rate_threshold();
        return[
            'low' => [
                'min' => 0,
                'max' => $medium - 1
            ],
            'medium' => [
                'min' => $medium,
                'max' => $high - 1
            ],
            'high' => [
                'min' => $high,
                'max' => $v_high - 1
            ],
            'very_high' => [
                'min' => $v_high,
                'max' => 100
            ],
        ];
    }

    public static function get_medium_rate_threshold() {
        $medium = 0;
        for ($i = 1; $i <= 2; $i++) {
            $medium+=self::$weights[$i];
        }
        return $medium;
    }

    public static function get_high_rate_threshold() {
        $high = 0;
        for ($i = 1; $i <= 3; $i++) {
            $high+=self::$weights[$i];
        }
        return $high;
    }

    public static function get_very_high_rate_threshold() {
        $v_high = 0;
        for ($i = 1; $i <= 5; $i++) {
            $v_high+=self::$weights[$i];
        }
        return $v_high;
    }

    public static function get_weights_sum() {
        return Match::get_weights_sum(self::$weights);
    }

    public static function get_weight_by_factor($factor) {
        return self::$weights[$factor];
    }

    public static function get_value_unweighted_from_weighted($value, $factor) {
        $weight = self::get_weight_by_factor($factor);
        return $value / $weight;
    }

    public static function get_percentages_array() {
        return Match::weights_to_percentage(self::$weights);
    }

    public static function get_all_rates() {
        $musicians = Musician::get_all_ids();
        $bands = Band::get_all_ids();
        return Match::get_all_rates($musicians, $bands, 'musician_id', 'band_id');
    }

    /*
     * For Musicians
     */

    public static function get_top_rates_for_musician_ordered($musician_id) {
        $all = self::get_all_rates_for_musician_ordered($musician_id);
        return Match::get_top_rates_ordered($all);
    }

    public static function get_all_rates_for_musician_ordered($musician_id) {
        $all = self::get_all_rates_for_musician($musician_id);
        return Match::get_all_rates_ordered($all);
    }

    public static function get_all_rates_for_musician($musician_id) {
        $bands = Band::get_all_ids();
        return Match::get_all_rates_for_role($musician_id, $bands, 'musician_id', 'band_id');
    }

    /*
     * For Bands
     */

    public static function get_top_rates_for_band_ordered($band_id) {
        $all = self::get_all_rates_for_band_ordered($band_id);
        return Match::get_top_rates_ordered($all);
    }

    public static function get_all_rates_for_band_ordered($band_id) {
        $all = self::get_all_rates_for_band($band_id);
        return Match::get_all_rates_ordered($all);
    }

    public static function get_all_rates_for_band($band_id) {
        $musicians = Musician::get_all_ids();
        return Match::get_all_rates_for_role($band_id, $musicians, 'band_id', 'musician_id');
    }

    /*
     * Overall
     */

    public static function get_rate($mus_id, $band_id) {
        return self::get_factors_sum($mus_id, $band_id);
    }

    public static function get_factors_sum($mus_id, $band_id) {
        $fac_1_val = self::factor_1($mus_id, $band_id);
        $fac_2_val = self::factor_2($mus_id, $band_id);
        $fac_3_val = self::factor_3($mus_id, $band_id, $fac_1_val);
        $fac_4_val = self::factor_4($mus_id, $band_id, $fac_1_val);
        $fac_5_val = self::factor_5($mus_id, $band_id);
        $fac_6_val = self::factor_6($mus_id, $band_id);
        $fac_7_val = self::factor_7($mus_id, $band_id);
        $fac_8_val = self::factor_8($mus_id, $band_id);
        $fac_9_val = self::factor_9($mus_id, $band_id);
        $fac_10_val = self::factor_10($mus_id, $band_id);
        $fac_11_val = self::factor_11($mus_id, $band_id);
        $fac_12_val = self::factor_12($mus_id, $band_id);
        $fac_13_val = self::factor_13($mus_id, $band_id);
        $fac_14_val = self::factor_14($mus_id, $band_id);
        $fac_15_val = self::factor_15($mus_id, $band_id);

        return [
            1 => $fac_1_val,
            2 => $fac_2_val,
            3 => $fac_3_val,
            4 => $fac_4_val,
            5 => $fac_5_val,
            6 => $fac_6_val,
            7 => $fac_7_val,
            8 => $fac_8_val,
            9 => $fac_9_val,
            10 => $fac_10_val,
            11 => $fac_11_val,
            12 => $fac_12_val,
            13 => $fac_13_val,
            14 => $fac_14_val,
            15 => $fac_15_val,
        ];
//        return $fac_1_val + $fac_2_val + $fac_3_val + $fac_4_val + $fac_5_val + $fac_6_val + $fac_7_val + $fac_8_val + $fac_9_val + $fac_10_val + $fac_11_val + $fac_12_val + $fac_13_val + $fac_14_val + $fac_15_val;
    }

    public static function factor_1($mus_id, $band_id) {
        $val = Match::factor_instrument_in_pursuit($mus_id, $band_id);
        return self::get_factor_result(1, $val);
    }

    public static function factor_2($mus_id, $band_id) {
        $val = Match::factor_genre_in_pursuit($mus_id, $band_id);
        return self::get_factor_result(2, $val);
    }

    public static function factor_3($mus_id, $band_id, $fac_1_val) {
        if ($fac_1_val == 0) {
            return self::get_factor_result(3, 0);
        }
        $fac_1_val = self::get_value_unweighted_from_weighted($fac_1_val, 1);
        $insts_pursuit = Match::factor_in_pursuit_to_array($mus_id, $band_id, 'instrument');
        $val = Match::factor_in_experience_and_array('musicians_experience_bands', 'instrument', 'musician_id', $mus_id, $insts_pursuit);
        return self::get_factor_result(3, $val);
    }

    public static function factor_4($mus_id, $band_id, $fac_1_val) {
        if ($fac_1_val == 0) {
            return self::get_factor_result(4, 0);
        }
        $fac_1_val = self::get_value_unweighted_from_weighted($fac_1_val, 1);
        $insts_pursuit = Match::factor_in_pursuit_to_array($mus_id, $band_id, 'instrument');
        $val = Match::factor_in_experience_and_array('musicians_experience_alone', 'instrument', 'musician_id', $mus_id, $insts_pursuit);
        return self::get_factor_result(4, $val);
    }

    public static function factor_5($mus_id, $band_id) {
        $val = Match::same_city($mus_id, $band_id);
        return self::get_factor_result(5, $val);
    }

    public static function factor_6($mus_id, $band_id) {
        // compare num years of musician in bands vs num years band
        $band_age = Band::get_age($band_id);
        if (!is_int($band_age)) {
            return self::get_factor_result(6, 0);
        }
        // sum of years of musician exp bands
        $musician_years_exp = MusicianExperienceBand::get_sum_years_band($mus_id);
        $val = Match::years_experience($band_age, $musician_years_exp);
        return self::get_factor_result(6, $val);
    }

    public static function factor_7($mus_id, $band_id) {
        $val = Match::factor_in_mus_exp_band_and_band_exp($mus_id, $band_id, 'main_genre');
        return self::get_factor_result(7, $val);
    }

    public static function factor_8($mus_id, $band_id) {
        $m_h_prac = Experience::get_all_to_array(['hours_practice'], 'musicians_experience_bands', ['musician_id' => $mus_id]);
        $b_h_prac = Experience::get_all_to_array(['hours_practice'], 'bands_experience', ['band_id' => $band_id]);
        $val = Match::hours_practice($m_h_prac, $b_h_prac);
        return self::get_factor_result(8, $val);
    }

    public static function factor_9($mus_id, $band_id) {
        $m_conc = Experience::get_all_to_array(['number_concerts'], 'musicians_experience_bands', ['musician_id' => $mus_id]);
        $b_conc = Experience::get_all_to_array(['number_concerts'], 'bands_experience', ['band_id' => $band_id]);
        $val = Match::number_concerts($m_conc, $b_conc);
        return self::get_factor_result(9, $val);
    }

    public static function factor_10($mus_id, $band_id) {
        $m_t = Experience::get_all_to_array(['number_tours'], 'musicians_experience_bands', ['musician_id' => $mus_id]);
        $b_t = Experience::get_all_to_array(['number_tours'], 'bands_experience', ['band_id' => $band_id]);
        $val = Match::number_tours($m_t, $b_t);
        return self::get_factor_result(10, $val);
    }

    public static function factor_11($mus_id, $band_id) {
        $m_a = Experience::get_all_to_array(['number_albums'], 'musicians_experience_bands', ['musician_id' => $mus_id]);
        $b_a = Experience::get_all_to_array(['number_albums'], 'bands_experience', ['band_id' => $band_id]);
        $val = Match::number_albums($m_a, $b_a);
        return self::get_factor_result(11, $val);
    }

    public static function factor_12($mus_id, $band_id) {
        $m_s = Experience::get_all_to_array(['number_songs'], 'musicians_experience_bands', ['musician_id' => $mus_id]);
        $b_s = Experience::get_all_to_array(['number_songs'], 'bands_experience', ['band_id' => $band_id]);
        $val = Match::number_songs($m_s, $b_s);
        return self::get_factor_result(12, $val);
    }

    public static function factor_13($mus_id, $band_id) {
        $m = Experience::get_all_to_array(['genre'], 'musicians_experience_alone', ['musician_id' => $mus_id]);
        $b = Experience::get_all_to_array(['main_genre'], 'bands_experience', ['band_id' => $band_id]);
        $intersect = array_intersect($m, $b);
        $val = 1;
        if (empty($intersect)) {
            $val = 0;
        }
        return self::get_factor_result(13, $val);
    }

    public static function factor_14($mus_id, $band_id) {
        $m_h_prac = Experience::get_all_to_array(['hours_practice'], 'musicians_experience_alone', ['musician_id' => $mus_id]);
        $b_h_prac = Experience::get_all_to_array(['hours_practice'], 'bands_experience', ['band_id' => $band_id]);
        $val = Match::hours_practice($m_h_prac, $b_h_prac);
        return self::get_factor_result(14, $val);
    }

    public static function factor_15($mus_id, $band_id) {
        $b_average = Band::members_average_age($band_id);
        $m_bdate = SharedRepository::select_value('musicians', ['birth_date'], ['user_id' => $mus_id]);
        $m_age = Age::get_years_from_birth_date($m_bdate);
        $val = Match::compare_to_max($b_average, $m_age, Match::MAX_DIFF_AGE);
        return self::get_factor_result(15, $val);
    }

    public static function get_factor_result($n, $val) {
        $weight = self::get_weight_by_factor($n);
        $result = $val * $weight;
//        echo Match::print_factor($n, $val, $weight, $result);
        return $result;
    }

}
