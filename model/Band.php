<?php

class Band extends User {

    const MIN_AGE = 0;
    const MAX_AGE = 100;
    const MAX_ELEM = 20;

    private static $table = 'bands';
    private static $fillable_pk = [
        'user_id'
    ];
    private static $fillable_pt_1 = array(
        'name',
        'formation_date',
        'number_elements',
    );

    public static function get_table_columns() {
        return array_merge(self::$fillable_pk, self::$fillable_pt_1);
    }

    public static function get_settings_fields() {
        return self::$fillable_pt_1;
    }

    public static function get_non_required_fields() {
        return [];
    }

    public static function get_required_fields() {
        return array_diff(self::get_settings_fields(), self::get_non_required_fields());
    }

    public static function get_all_ids() {
        $all = SharedRepository::select_multi_array_no_args(['user_id'], self::$table);
        $ret = [];
        foreach ($all as $key => $value) {
            $ret[] = $value['user_id'];
        }
        return $ret;
    }

    public static function create($user_id) {
        return Role::insert($user_id, self::$table);
    }

    public static function update($user_id, $data_to_set) {
        return Role::edit($user_id, self::$table, $data_to_set);
    }

    public static function increment_number_elements($user_id) {
        $num_elem_now = self::get_number_elements();
        $data_to_set = [
            'number_elements' => $num_elem_now + 1
        ];
        return self::update($user_id, $data_to_set);
    }

    public static function decrement_number_elements($user_id) {
        $num_elem_now = self::get_number_elements();
        $data_to_set = [
            'number_elements' => $num_elem_now - 1
        ];
        return self::update($user_id, $data_to_set);
    }

    public static function generate_update_data() {
        $formation_date = Random::date('2010-01-01', '2016-01-01');
        $data_to_set = [
            'name' => 'Stax, Biatch', //change--------
            'formation_date' => $formation_date,
            'number_elements' => rand(2, 4),
        ];
        return $data_to_set;
    }

    public static function get_data($id) {
        return Role::get_data($id, self::get_table_columns(), self::$table);
    }

    public static function profile_to_array() {
        global $role_data;
        $profile = $role_data;
        unset($profile['user_id']);
        return [
            'band name' => $profile['name'],
            'formation date' => $profile['formation_date'],
            'number of elements' => $profile['number_elements'],
        ];
    }

    public static function profile_to_array_by_user_id($user_id) {
        $profile = self::get_data($user_id);
        return [
            'band name' => $profile['name'],
            'formation date' => $profile['formation_date'],
            'band\'s age' => Age::get_years_from_birth_date($profile['formation_date']),
            'number of elements' => $profile['number_elements'],
        ];
    }

    public static function get_number_elements() {
        global $role_data;
        return $role_data['number_elements'];
    }

    public static function get_band_name($user_id) {
        return SharedRepository::select_value(self::$table, ['name'], ['user_id' => $user_id]);
    }

    public static function username_exists($username) {
        $fields = [
            'id'
        ];

        $args = [
            'role' => 'band',
            'username' => $username
        ];
        return SharedRepository::select_exists(User::get_table_name(), $fields, $args);
    }

    public static function get_search_result($params) {
        //tables
        $band_exp_table = BandExperience::get_table_name();
        //sql
        $location_to_sql = DataStructure::location_to_sql_ON_from_INNER_JOIN($params, User::get_table_name(), User::get_location_field_names());
        $genre_to_sql = DataStructure::genre_to_sql_ON_from_INNER_JOIN($params, $band_exp_table, 'main_genre');


        $args = [
            'select' => [
                'users.username',
                'bands.name',
                'users.region',
                'users.country',
                'users.city_state',
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'bands'
                    ],
                    'on' => [
                        'users.id = bands.user_id',
                        $location_to_sql,
                    ],
                ],
                1 => [
                    'inner_join' => [
                        'bands_experience'
                    ],
                    'on' => [
                        'users.id = bands_experience.band_id',
                        $genre_to_sql
                    ],
                ],
            ],
            'order_by' => [
                'users.id'
            ],
            'limit' => self::get_number_rows()
        ];


        return SharedRepository::select_inner_join_on_order_by_for_search_ov($args);
    }

    public static function get_number_rows() {
        $field_return = 'user_id';
        return SharedRepository::select_count(self::$table, $field_return, []);
    }

    public static function get_start_date($band_id) {
        return SharedRepository::select_value(self::$table, ['formation_date'], ['user_id' => $band_id]);
    }

    public static function get_age($band_id) {
        $start = self::get_start_date($band_id);
        return Age::get_years_from_birth_date($start);
    }

    public static function members_average_age($band_id) {
        $members = BandMember::get_all_by_band($band_id);
        if (empty($members)) {
            return false;
        }
        $n = 0;
        $sum = 0;
        foreach ($members as $key => $value) {
            $b_date = $value['birth_date'];
            if (!empty($b_date)) {
                $age = Age::get_years_from_birth_date($b_date);
                $sum = $sum + $age;
                $n = $n + 1;
            }
        }
        return floor($sum / $n);
    }

    public static function table_has_data() {
        if (!User::logged_in()) {
            return false;
        }
        global $session_user_id;
        $name = self::get_band_name($session_user_id);
        if (!$name) {
            return false;
        }
        return true;
    }

}
