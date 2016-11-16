<?php

class MusicianExperienceBand extends Experience {

    private static $table = 'musicians_experience_bands';
    private static $fillable_pk = [
        'id',
    ];
    private static $fillable_fk = [
        'musician_id'
    ];
    private static $fillable_pt_1 = [
        'band_name',
        'region',
        'country',
        'city_state',
        'band_username', //*** blankable ***
        'start_date',
        'end_date', //*** blankable ***
        'instrument', //*** can be many ***
        'songs_type',
        'main_genre',
        'hours_practice',
        'number_concerts',
        'number_tours',
        'number_albums',
        'number_songs',
        'sings',
        'demo_link', //*** blankable ***
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
        return ['band_username', 'end_date', 'demo_link'];
    }

    public static function get_required_fields() {
        return array_diff(self::get_settings_fields(), self::get_non_required_fields());
    }

    public static function create($user_id, $data) {
        if (self::data_exists($data)) {
            return false;
        }
        return Experience::create($user_id, $data, 'musician_id', self::$table);
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
            'musician_id' => User::get_id(),
        ];
        $data_simple = [
            'band_name' => $data['band_name'],
            'region' => $data['region'],
            'country' => $data['country'],
            'city_state' => $data['city_state'],
            'start_date' => $data['start_date'],
            'instrument' => $data['instrument']
        ];
        $all_data = array_merge($id_arr, $data_simple);
        return SharedRepository::select_exists(self::$table, ['id'], $all_data);
    }

    public static function generate_data() {
        return [
            'band_name' => 'Old Orleans',//change
            'region' => 'North America',
            'country' => 'United States',
            'city_state' => 'Buras, LA',//change
            'band_username' => '', //*** blankable ***
            'start_date' => Random::date('2000-01-01', '2005-01-01'),
            'end_date' => Random::date('2005-02-01', '2010-01-01'),
            'instrument' => Random::array_value(Instrument::$most_common), //*** can be many ***
            'songs_type' => Random::array_value(Song::get_all_sources()),
            'main_genre' => Random::array_value(Genre::get_all()),
            'hours_practice' => Random::array_value(Practice::get_all_hours()),
            'number_concerts' => rand(0, 30),
            'number_tours' => rand(0, 2),
            'number_albums' => rand(0, 2),
            'number_songs' => rand(0, 20),
            'sings' => Random::array_value(Singer::get_all_options()),
            'demo_link' => '',
        ];
    }

    public static function get_total() {
        return Experience::get_total(self::$table);
    }

    public static function get_all_data($user_id) {
        return Experience::get_all_data(self::$table, self::get_table_columns(), 'musician_id', $user_id);
    }

    public static function prepare_data_to_table() {
        global $experience_data_musician_band;
        return self::array_to_table_format($experience_data_musician_band);
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
                'band name' => $exp['band_name'],
                'band region' => $exp['region'],
                'band country' => $exp['country'],
                'band city' => $exp['city_state'],
                'band username' => $exp['band_username'],
                'start' => $exp['start_date'],
                'end' => $end,
                'instrument' => $exp['instrument'],
                'songs type' => $exp['songs_type'],
                'main genre' => $exp['main_genre'],
                'hours of practice' => $exp['hours_practice'],
                'concerts' => $exp['number_concerts'],
                'tours' => $exp['number_tours'],
                'albums' => $exp['number_albums'],
                'songs' => $exp['number_songs'],
                'sings' => $exp['sings'],
                'demo_link' => $exp['demo_link'],
            ];
        }
        return $ret;
    }

    public static function get_relation_element_order_and_id() {
        global $experience_data_musician_band;
        return Experience::get_relation_element_order_and_id($experience_data_musician_band);
    }

    public static function get_max_years_band($musician_id) {
        $ages = self::get_all_years($musician_id);
        return max($ages);
    }

    public static function get_min_years_band($musician_id) {
        $ages = self::get_all_years($musician_id);
        return min($ages);
    }

    public static function get_sum_years_band($musician_id) {
        $ages = self::get_all_years($musician_id);
        return array_sum($ages);
    }

    public static function get_average_years_band($musician_id) {
        $ages = self::get_all_years($musician_id);
        $sum = self::get_sum_years_band($musician_id);
        $n = sizeof($ages);
        return floor($sum / $n);
    }

    public static function get_all_years($musician_id) {
        $all_inter = self::get_all_intervals($musician_id);
        return Age::years_from_date_intervals_in_multi_array($all_inter);
    }

    public static function get_all_intervals($musician_id) {
        $table = self::$table;
        $fields = [
            'start_date',
            'end_date'
        ];
        $args = [
            'musician_id' => $musician_id
        ];
        return SharedRepository::select_multi_array($fields, $table, $args);
    }
    
    public static function table_has_data() {
        return Experience::table_has_data('musician_id',self::$table);
    }

}
