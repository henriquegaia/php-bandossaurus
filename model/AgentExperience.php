<?php

class AgentExperience extends Experience {

    private static $table = 'agents_experience';
    private static $fillable_pk = [
        'id',
    ];
    private static $fillable_fk = [
        'agent_id'
    ];
    private static $fillable_pt_1 = [
        'artist_name',
        'region',
        'country',
        'city_state',
        'artist_type', // artist / solo artist
        'artist_username', //*** blankable ***
        'start_date',
        'end_date', //*** blankable ***
        'main_genre',
        'number_concerts',
        'number_tours',
        'number_albums',
        'demo_link',
    ];

    public static function get_table_name() {
        return self::$table;
    }

    public static function get_table_columns() {
        return array_merge(self::$fillable_pk, self::$fillable_fk, self::$fillable_pt_1);
    }

    public static function get_settings_fields() {
        return self::$fillable_pt_1;
    }

    public static function get_non_required_fields() {
        return ['artist_username', 'end_date', 'demo_link'];
    }

    public static function get_required_fields() {
        return array_diff(self::get_settings_fields(), self::get_non_required_fields());
    }

    public static function create($user_id, $data) {
        if (self::data_exists($data)) {
            return false;
        }
        return Experience::create($user_id, $data, 'agent_id', self::$table);
    }

    public static function update($id, $data_to_set) {
//        if (self::data_exists($data_to_set)) {
//            return false;
//        }
        return Experience::update($id, $data_to_set, self::$table);
    }

    public static function delete($id) {
        return Experience::delete($id, self::$table);
    }

    public static function data_exists($data) {
        $id_arr = [
            'agent_id' => User::get_id(),
        ];
        $data_simple = [
            'artist_name' => $data['artist_name'],
            'region' => $data['region'],
            'country' => $data['country'],
            'city_state' => $data['city_state'],
            'artist_type' => $data['artist_type'],
            'start_date' => $data['start_date'],
            'main_genre' => $data['main_genre'],
        ];
        $all_data = array_merge($id_arr, $data_simple);
        return SharedRepository::select_exists(self::$table, ['id'], $all_data);
    }

    public static function generate_data() {
        return [
            'artist_name' => 'Why Now',//change -------
            'region' => 'North America',
            'country' => 'United States',
            'city_state' => 'Wynot, NE',//change -------
            'artist_type' => Random::array_value(ArtistType::get_all_options()), // artist / solo artist
            'artist_username' => '', //*** blankable ***
            'start_date' => Random::date('2000-01-01', '2005-01-01'),
            'end_date' => Random::date('2005-02-01', '2010-01-01'), //*** blankable ***
            'main_genre' => Random::array_value(Genre::get_all()),
            'number_concerts' => rand(0, 10),
            'number_tours' => rand(0, 1),
            'number_albums' => rand(0, 2),
            'demo_link' => '',
        ];
    }

    public static function get_total() {
        return Experience::get_total(self::$table);
    }

    public static function get_all_data($user_id) {
        return Experience::get_all_data(self::$table, self::get_table_columns(), 'agent_id', $user_id);
    }

    public static function prepare_data_to_table() {
        global $experience_data;
        return self::array_to_table_format($experience_data);
    }

    public static function prepare_data_to_table_by_user_id($user_id) {
        $exps = self::get_all_data($user_id);
        return self::array_to_table_format($exps);
    }

    public static function array_to_table_format($exps) {
        $ret = [];
        $count = 0;
        foreach ($exps as $exp) {
            $end = '';
            if ($exp['end_date'] != 0) {
                $end = $exp['end_date'];
            }
            $ret [] = [
                '' => ++$count,
                'artist name' => $exp['artist_name'],
                'artist region' => $exp['region'],
                'artist country' => $exp['country'],
                'artist city' => $exp['city_state'],
                'artist type' => $exp['artist_type'],
                'artist username' => $exp['artist_username'],
                'start' => $exp['start_date'],
                'end' => $end,
                'genre' => $exp['main_genre'],
                'concerts' => $exp['number_concerts'],
                'tours' => $exp['number_tours'],
                'albums' => $exp['number_albums'],
                'demo link' => $exp['demo_link']
            ];
        }
        return $ret;
    }

    public static function get_relation_element_order_and_id() {
        global $experience_data;
        return Experience::get_relation_element_order_and_id($experience_data);
    }

    public static function get_max_years_artist($agent_id) {
        $ages = self::get_all_years($agent_id);
        return max($ages);
    }

    public static function get_min_years_artist($agent_id) {
        $ages = self::get_all_years($agent_id);
        return min($ages);
    }

    public static function get_sum_years_artist($agent_id) {
        $ages = self::get_all_years($agent_id);
        return array_sum($ages);
    }

    public static function get_average_years_artist($agent_id) {
        $ages = self::get_all_years($agent_id);
        $sum = self::get_sum_years_artist($agent_id);
        $n = sizeof($ages);
        return floor($sum / $n);
    }

    public static function get_all_years($agent_id) {
        $all_inter = self::get_all_intervals($agent_id);
        return Age::years_from_date_intervals_in_multi_array($all_inter);
    }

    public static function get_all_intervals($agent_id) {
        $table = self::$table;
        $fields = [
            'start_date',
            'end_date'
        ];
        $args = [
            'agent_id' => $agent_id
        ];
        return SharedRepository::select_multi_array($fields, $table, $args);
    }
    
    public static function table_has_data() {
        return Experience::table_has_data('agent_id', self::$table);
    }

}
