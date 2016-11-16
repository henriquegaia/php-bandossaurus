<?php

class MusicianExperienceAlone extends Experience {

    private static $table = 'musicians_experience_alone';
    private static $fillable_pk = [
        'id',
    ];
    private static $fillable_fk = [
        'musician_id'
    ];
    private static $fillable_pt_1 = [
        'instrument',
        'genre',
        'hours_practice',
        'writes_composes',
        'sings',
        'demo_link'
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
            'instrument' => $data['instrument'],
            'genre' => $data['genre']
        ];
        $all_data = array_merge($id_arr, $data_simple);
        return SharedRepository::select_exists(self::$table, ['id'], $all_data);
    }

    public static function generate_data() {
        return [
            'instrument' => Random::array_value(Instrument::$most_common),
            'genre' => Random::array_value(Genre::get_all()),
            'hours_practice' => Random::array_value(Practice::get_all_hours()),
            'writes_composes' => Random::array_value(MusicComposition::get_all_options()),
            'sings' => Random::array_value(Singer::get_all_options()),
            'demo_link' => ''
        ];
    }

    public static function get_total() {
        return Experience::get_total(self::$table);
    }

    public static function get_all_data($user_id) {
        return Experience::get_all_data(self::$table, self::get_table_columns(), 'musician_id', $user_id);
    }

    public static function prepare_data_to_table() {
        global $experience_data_musician_alone;
        return self::array_to_table_format($experience_data_musician_alone);
    }

    public static function prepare_data_to_table_by_user_id($user_id) {
        $exps = self::get_all_data($user_id);
        return self::array_to_table_format($exps);
    }

    public static function array_to_table_format($exps) {
        $ret = [];
        $count = 0;
        foreach ($exps as $exp) {
            $ret [] = [
                '' => ++$count,
                'instrument' => $exp['instrument'],
                'genre' => $exp['genre'],
                'hours_practice' => $exp['hours_practice'],
                'writes_composes' => $exp['writes_composes'],
                'sings' => $exp['sings'],
                'demo link' => $exp['demo_link']
            ];
        }
        return $ret;
    }

    public static function get_relation_element_order_and_id() {
        global $experience_data_musician_alone;
        return Experience::get_relation_element_order_and_id($experience_data_musician_alone);
    }

    public static function table_has_data() {
        return Experience::table_has_data('musician_id',self::$table);
    }

}
