<?php

class Agent extends User {

    const MIN_AGE = 18;
    const MAX_AGE = 150;

    private static $table = 'agents';
    private static $fillable_pk = [
        'user_id'
    ];
    private static $fillable_pt_1 = [
        'birth_date',
        'gender',
    ];

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

    public static function generate_update_data() {
        $birth_date = Random::date('1970-01-01', '1996-01-01');
        $genders = Gender::get_all();
        $gender = Random::array_value($genders);
        $data_to_set = [
            'birth_date' => $birth_date,
            'gender' => 'Female'
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
            'birth date' => $profile['birth_date'],
            'gender' => $profile['gender'],
        ];
    }

    public static function profile_to_array_by_user_id($user_id) {
        $profile = self::get_data($user_id);
        return [
            'birth date' => $profile['birth_date'],
            'age' => Age::get_years_from_birth_date($profile['birth_date']),
            'gender' => $profile['gender'],
        ];
    }

    public static function get_search_result($params) {
        //tables
        $agent_exp_table = AgentExperience::get_table_name();
        //sql
        $age_to_sql = DataStructure::age_to_sql_ON_from_INNER_JOIN($params, self::$table, 'birth_date');
        $location_to_sql = DataStructure::location_to_sql_ON_from_INNER_JOIN($params, User::get_table_name(), User::get_location_field_names());
        $gender_to_sql = DataStructure::gender_to_sql_ON_from_INNER_JOIN($params, self::$table, 'gender');
        $genre_to_sql = DataStructure::genre_to_sql_ON_from_INNER_JOIN($params, $agent_exp_table, 'main_genre');

        $args = [
            'select' => [
                'users.username',
                'users.first_name',
                'users.last_name',
                'agents.birth_date',
                'agents.gender',
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
                        'agents'
                    ],
                    'on' => [
                        'users.id = agents.user_id',
                        $age_to_sql,
                        $location_to_sql,
                        $gender_to_sql
                    ],
                ],
                1 => [
                    'inner_join' => [
                        $agent_exp_table
                    ],
                    'on' => [
                        'users.id = agents_experience.agent_id',
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

    public static function get_gender() {
        if (!User::logged_in()) {
            return false;
        }
        global $session_user_id;
        $fields = [
            'gender'
        ];
        $args = [
            'user_id' => $session_user_id
        ];
        return SharedRepository::select_value(self::$table, $fields, $args);
    }

    public static function table_has_data() {
        $gender = self::get_gender();
        if (!$gender) {
            return false;
        }
        if (in_array($gender, Gender::get_all()) == false) {
            return false;
        }
        return true;
    }

}
