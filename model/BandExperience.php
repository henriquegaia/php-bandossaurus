<?php

class BandExperience extends Experience {

    private static $table = 'bands_experience';
    private static $fillable_pk = [
        'id',
    ];
    private static $fillable_fk = [
        'band_id'
    ];
    private static $fillable_pt_1 = [
        'songs_type',
        'main_genre',
        'hours_practice',
        'number_concerts',
        'number_tours',
        'number_albums',
        'number_songs',
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
        return ['demo_link'];
    }

    public static function get_required_fields() {
        return array_diff(self::get_settings_fields(), self::get_non_required_fields());
    }

    public static function create($user_id, $data) {
        if (self::data_exists($data)) {
            return false;
        }
        return Experience::create($user_id, $data, 'band_id', self::$table);
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
            'band_id' => User::get_id(),
        ];
        $data_simple = [
            'songs_type' => $data['songs_type'],
            'main_genre' => $data['main_genre']
        ];
        $all_data = array_merge($id_arr, $data_simple);
        return SharedRepository::select_exists(self::$table, ['id'], $all_data);
    }

    public static function generate_data() {
        return [
            'songs_type' => Random::array_value(Song::get_all_sources()),
            'main_genre' => Random::array_value(Genre::get_all()),
            'hours_practice' => Random::array_value(Practice::get_all_hours()),
            'number_concerts' => rand(0, 20),
            'number_tours' => rand(0, 2),
            'number_albums' => rand(0, 2),
            'number_songs' => rand(0, 20),
            'demo_link' => '',
        ];
    }

    public static function get_total() {
        return Experience::get_total(self::$table);
    }

    public static function get_all_data($user_id) {
        return Experience::get_all_data(self::$table, self::get_table_columns(), 'band_id', $user_id);
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
            $link = $exp['demo_link'];
            $ret [] = [
                '' => ++$count,
                'type of songs' => $exp['songs_type'],
                'genre' => $exp['main_genre'],
                'hours of practice' => $exp['hours_practice'],
                'concerts' => $exp['number_concerts'],
                'tours' => $exp['number_tours'],
                'albums' => $exp['number_albums'],
                'songs' => $exp['number_songs'],
                'demo link' => $link
            ];
        }
        return $ret;
    }

    public static function get_relation_element_order_and_id() {
        global $experience_data;
        return Experience::get_relation_element_order_and_id($experience_data);
    }

    public static function table_has_data() {
        return Experience::table_has_data('band_id', self::$table);
    }

}
