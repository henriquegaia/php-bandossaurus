<?php

class MatchBandAgent {

    private static $weights = [
        1 => 20,
        2 => 20,
        3 => 12,
        4 => 11,
        5 => 11,
        6 => 11,
        7 => 11,
        8 => 4
    ];
    private static $weights_desc = [
        1 => 'both pursuing the same musical genre',
        2 => 'both on the same city',
        3 => 'agent has time of experience similar to the age of the band',
        4 => 'agent has experience in a genre that the band also has',
        5 => 'agent has contributed to a number of concerts similar to the band',
        6 => 'agent has contributed to a number of tours similar to the band',
        7 => 'agent has contributed to a number of albums similar to the band',
        8 => 'agent age is similar to the average age in the band'
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
        $bands = Band::get_all_ids();
        $agents = Agent::get_all_ids();
        return Match::get_all_rates($bands, $agents, 'band_id', 'agent_id');
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
        $agents = Agent::get_all_ids();
        return Match::get_all_rates_for_role($band_id, $agents, 'band_id', 'agent_id');
    }

    /*
     * For Agents
     */

    public static function get_top_rates_for_agent_ordered($agent_id) {
        $all = self::get_all_rates_for_agent_ordered($agent_id);
        return Match::get_top_rates_ordered($all);
    }

    public static function get_all_rates_for_agent_ordered($agent_id) {
        $all = self::get_all_rates_for_agent($agent_id);
        return Match::get_all_rates_ordered($all);
    }

    public static function get_all_rates_for_agent($agent_id) {
        $bands = Band::get_all_ids();
        return Match::get_all_rates_for_role($agent_id, $bands, 'agent_id', 'band_id');
    }

    /*
     * Overall
     */

    public static function get_rate($mus_id, $agent_id) {
        return self::get_factors_sum($mus_id, $agent_id);
    }

    public static function get_factors_sum($band_id, $agent_id) {
        $fac_1_val = self::factor_1($band_id, $agent_id);
        $fac_2_val = self::factor_2($band_id, $agent_id);
        $fac_3_val = self::factor_3($band_id, $agent_id);
        $fac_4_val = self::factor_4($band_id, $agent_id);
        $fac_5_val = self::factor_5($band_id, $agent_id);
        $fac_6_val = self::factor_6($band_id, $agent_id);
        $fac_7_val = self::factor_7($band_id, $agent_id);
        $fac_8_val = self::factor_8($band_id, $agent_id);
        
          return [
            1 => $fac_1_val,
            2 => $fac_2_val,
            3 => $fac_3_val,
            4 => $fac_4_val,
            5 => $fac_5_val,
            6 => $fac_6_val,
            7 => $fac_7_val,
            8 => $fac_8_val,
        ];

//        return $fac_1_val + $fac_2_val + $fac_3_val + $fac_4_val + $fac_5_val + $fac_6_val + $fac_7_val + $fac_8_val;
    }

    public static function factor_1($band_id, $agent_id) {
        $val = Match::factor_genre_in_pursuit($band_id, $agent_id);
        return self::get_factor_result(1, $val);
    }

    public static function factor_2($band_id, $agent_id) {
        $val = Match::same_city($band_id, $agent_id);
        return self::get_factor_result(2, $val);
    }

    public static function factor_3($band_id, $agent_id) {
        $band_age = Band::get_age($band_id);
        $agent_years_exp = AgentExperience::get_sum_years_artist($agent_id);
        $val = Match::years_experience($agent_years_exp, $band_age);
        return self::get_factor_result(3, $val);
    }

    public static function factor_4($band_id, $agent_id) {
        $val = Match::factor_in_band_exp_and_agent_exp($band_id, $agent_id, 'main_genre');
        return self::get_factor_result(4, $val);
    }

    public static function factor_5($band_id, $agent_id) {
        $b = Experience::get_all_to_array(['number_concerts'], 'bands_experience', ['band_id' => $band_id]);
        $a = Experience::get_all_to_array(['number_concerts'], 'agents_experience', ['agent_id' => $agent_id]);
        $val = Match::number_concerts($b, $a);
        return self::get_factor_result(5, $val);
    }

    public static function factor_6($band_id, $agent_id) {
        $b = Experience::get_all_to_array(['number_tours'], 'bands_experience', ['band_id' => $band_id]);
        $a = Experience::get_all_to_array(['number_tours'], 'agents_experience', ['agent_id' => $agent_id]);
        $val = Match::number_tours($b, $a);
        return self::get_factor_result(6, $val);
    }

    public static function factor_7($band_id, $agent_id) {
        $b = Experience::get_all_to_array(['number_albums'], 'bands_experience', ['band_id' => $band_id]);
        $a = Experience::get_all_to_array(['number_albums'], 'agents_experience', ['agent_id' => $agent_id]);
        $val = Match::number_albums($b, $a);
        return self::get_factor_result(7, $val);
    }

    public static function factor_8($band_id, $agent_id) {
        $b_average = Band::members_average_age($band_id);
        $a_bdate = SharedRepository::select_value('agents', ['birth_date'], ['user_id' => $agent_id]);
        $a_age = Age::get_years_from_birth_date($a_bdate);
        $val = Match::compare_to_max($b_average, $a_age, Match::MAX_DIFF_AGE);
        return self::get_factor_result(8, $val);
    }

    public static function get_factor_result($n, $val) {
        $weight = self::get_weight_by_factor($n);
        $result = $val * $weight;
//        echo Match::print_factor($n, $val, $weight, $result);
        return $result;
    }

}
