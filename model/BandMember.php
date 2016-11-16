<?php

class BandMember {

    const MIN_AGE = Musician::MIN_AGE;
    const MAX_AGE = Musician::MAX_AGE;

    private static $table = 'bands_members';
    private static $fillable_pk = [
        'id',
    ];
    private static $fillable_fk = [
        'band_id'
    ];
    private static $fillable_pt_1 = array(
        'name',
        'birth_date',
        'gender',
        'instrument',
        'join_date',
        'username'
    );

    public static function get_table_columns() {
        return array_merge(self::$fillable_pk, self::$fillable_fk, self::$fillable_pt_1);
    }

    public static function get_settings_fields() {
        return self::$fillable_pt_1;
    }

    public static function get_non_required_fields() {
        return ['username'];
    }

    public static function get_settings_required_fields() {
        return array_diff(self::get_settings_fields(), self::get_non_required_fields());
    }

    public static function generate_data($band_id, $name) {

        $birth_date = Random::date('1980-01-01', '1996-01-01');
        //
        $genders = Gender::get_all();
        $gender = Random::array_value($genders);
        //
        $instruments = Instrument::$most_common;
        $instrument = Random::array_value($instruments);
        //
        $band_data = Band::get_data($band_id);
        $band_formation_date = $band_data['formation_date'];
        $join_date = $band_formation_date;
        //
        $username = '';

        return [
            'band_id' => $band_id,
            'name' => 'bm_' . $name . '_band_' . $band_id,
            'birth_date' => $birth_date,
            'gender' => $gender,
            'instrument' => $instrument,
            'join_date' => $join_date,
            'username' => $username
        ];
    }

    public static function create($register_data) {
        if (self::data_exists($register_data)) {
            return false;
        }
        return SharedRepository::insert(self::$table, $register_data);
    }

    public static function update($id, $data_to_set) {
        if (self::data_exists($data_to_set)) {
            return false;
        }
        $args = [
            'id' => $id
        ];
        return SharedRepository::update_set(self::$table, $data_to_set, $args);
    }

    public static function delete($id) {
        $args = [
            'id' => $id
        ];
        return SharedRepository::delete_simple(self::$table, $args);
    }

    public static function data_exists($data) {
        $id_arr = [
            'band_id' => User::get_id(),
        ];
        $data_simple = [
            'name' => $data['name']
        ];
        $all_data = array_merge($id_arr, $data_simple);
        return SharedRepository::select_exists(self::$table, ['id'], $all_data);
    }

    public static function get_all_by_band($band_id) {
        $data = [];
        $args = [
            'band_id' => $band_id
        ];
        $data = SharedRepository::select_multi_array(self::get_table_columns(), self::$table, $args);
        return $data;
    }

    public static function profile_to_array() {
        global $band_members_data;
        $ret = [];
        $count = 0;
        $band_num_elem = Band::get_number_elements();
        foreach ($band_members_data as $member) {
            $ret [] = [
                '' => ++$count,
                'name' => $member['name'],
                'birth date' => $member['birth_date'],
                'gender' => $member['gender'],
                'instrument' => $member['instrument'],
                'join date' => $member['join_date'],
                'username' => $member['username']
            ];
        }
        while ($count < $band_num_elem) {
            $ret [] = [
                '' => ++$count,
                'name' => '',
                'birth date' => '',
                'gender' => '',
                'instrument' => '',
                'join date' => '',
                'username' => ''
            ];
        }
        return $ret;
    }

    public static function profile_to_array_by_user_id($user_id) {
        $band_members_data = self::get_all_by_band($user_id);
        $ret = [];
        $count = 0;
        $band_num_elem = sizeof($band_members_data);
        foreach ($band_members_data as $member) {
            $ret [] = [
                '' => ++$count,
                'name' => $member['name'],
                'birth date' => $member['birth_date'],
                'age' => Age::get_years_from_birth_date($member['birth_date']),
                'gender' => $member['gender'],
                'instrument' => $member['instrument'],
                'join date' => $member['join_date'],
                'username' => $member['username']
            ];
        }
        while ($count < $band_num_elem) {
            $ret [] = [
                '' => ++$count,
                'name' => '',
                'birth date' => '',
                'age' => '',
                'gender' => '',
                'instrument' => '',
                'join date' => '',
                'username' => ''
            ];
        }
        return $ret;
    }

    public static function get_number_elements_with_data() {
        global $band_members_data;
        $count = 0;
        foreach ($band_members_data as $key) {
            if (!empty($key['name'])) {
                $count++;
            }
        }
        return $count;
    }

    public static function get_number_elements_without_data() {
        $n_elem = (int) Band::get_number_elements();
        $elem_with_data = (int) self::get_number_elements_with_data();
        $to_do = (int) $n_elem - $elem_with_data;
        return $to_do;
    }

    public static function get_relation_element_order_and_id() {
        $ret = [];
        global $band_members_data;
        $count = 0;
        foreach ($band_members_data as $key) {
            if (!empty($key['name'])) {
                $ret[++$count] = $key['id'];
            }
        }
        return $ret;
    }

}
