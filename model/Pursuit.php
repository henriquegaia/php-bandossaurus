<?php

class Pursuit {

    const MIN_URGENCY = 0;
    const MAX_URGENCY = 1;
    const MAX_SHOW_ON_INDEX = 5;
    const MIN_TYPE = 1;
    const MAX_TYPE = 6;

    private static $table = 'pursuits';
    private static $fillable_pk = [
        'id'
    ];
    private static $fillable_fk = [
        'user_id'
    ];
    private static $fillable_pt_1 = [
        'role_pursuited',
        'instrument',
        'genre',
        'urgency',
    ];
    private static $fillable_pt_2 = [
        'created_at',
        'updated_at',
    ];
    private static $types_pursuits = array(
        1 => 'mus_ban',
        2 => 'mus_age',
        3 => 'ban_mus',
        4 => 'ban_age',
        5 => 'age_mus',
        6 => 'age_ban'
    );

    public static function get_pk() {
        return self::$fillable_pk[0];
    }

    public static function get_table_columns() {
        return array_merge(self::$fillable_pk, self::$fillable_fk, self::$fillable_pt_1, self::$fillable_pt_2);
    }

    public static function get_settings_fields() {
        return self::$fillable_pt_1;
    }

    public static function get_settings_required_fields() {
        return array_diff(self::get_settings_fields(), self::get_settings_non_required_fields());
    }

    public static function get_settings_non_required_fields() {
        return [];
    }

    public static function get_non_required_fields_band_musician_rel() {
        return [];
    }

    public static function get_non_required_fields_agent_rel() {
        return [
            'instrument',
            'genre'
        ];
    }

    public static function get_required_fields_band_musician_rel() {
        return array_diff(self::get_settings_fields(), self::get_non_required_fields());
    }

    public static function get_required_fields_agent_rel() {
        return array_diff(self::get_settings_fields(), self::get_non_required_fields());
    }

    public static function get_fields_updatedable() {
        return [
            'urgency'
        ];
    }

    public static function get_fields_non_updatedable() {
        return array_diff(self::get_settings_fields(), self::get_fields_updatedable());
    }

    public static function get_all_data() {
        $data = [];
        $user_id = User::get_id();
        $args = [
            'user_id' => $user_id
        ];
        $data = SharedRepository::select_multi_array(self::get_table_columns(), self::$table, $args);
        return $data;
    }

    public static function get_all_types() {
        return self::$types_pursuits;
    }

    public static function get_number_rows() {
        $field_return = 'id';
        return SharedRepository::select_count(self::$table, $field_return, []);
    }

    public static function create($data, $user_id) {
        if (self::data_exists($data)) {

            return false;
        }
        if (!self::role_pursuited_diff_than_mine($data)) {
            return false;
        }
        $id_arr = [
            'user_id' => $user_id,
        ];
        $all_data = array_merge($id_arr, $data);
        $val = SharedRepository::insert(self::$table, $all_data);

        if ($val == true) {
            return BaseRepository::update_set_time_now_arr_args('created_at', self::$table, $all_data);
        }
        return false;
    }

    public static function update($id, $data_to_set, $is_dummy) {
        if (!self::id_exists($id)) {
            return false;
        }
        if ($is_dummy) {
            if (!self::role_pursuited_diff_than_mine($data_to_set)) {
                return false;
            }
            if (self::data_exists($data_to_set)) {
                return false;
            }
        }

        $args = [
            'id' => $id
        ];
        return SharedRepository::update_set(self::$table, $data_to_set, $args);
    }

    public static function delete($id) {
        if (!self::id_exists($id)) {
            return false;
        }
        $args = [
            'id' => $id
        ];
        return SharedRepository::delete_simple(self::$table, $args);
    }

    public static function data_exists($data) {
        $id_arr = [
            'user_id' => User::get_id(),
        ];
        $all_data = array_merge($id_arr, $data);
        $all_data = self::unset_changeable_fields($all_data, self::get_fields_updatedable());
        return SharedRepository::select_exists(self::$table, ['id'], $all_data);
    }

    public static function unset_changeable_fields($data, $to_unset) {
        foreach ($to_unset as $value) {
            unset($data[$value]);
        }
        return $data;
    }

    public static function id_exists($id) {
        if (SharedRepository::select_exists(self::$table, ['id'], ['id' => $id])) {
            return true;
        }
        return false;
    }

    public static function get_relation_element_order_and_id() {
        $ret = [];
        global $pursuits;
        $count = 0;
        foreach ($pursuits as $key) {
            if (!empty($key['id'])) {
                $ret[++$count] = $key['id'];
            }
        }
        return $ret;
    }

    public static function role_pursuited_diff_than_mine($data) {
        if (!array_key_exists('role_pursuited', $data)) {
            return false;
        }
        if (!Role::exists($data['role_pursuited'])) {
            return false;
        }
        $role = User::get_role();
        $role = DataStructure::prepare_string_comparison($role);
        $role_pursuited = DataStructure::prepare_string_comparison($data['role_pursuited']);
        if ($role != $role_pursuited) {
            return true;
        }
        return false;
    }

    public static function generate_data($role) {
        $role_pursuited = Role::get_random_diff($role);
        $instrument = self::generate_instrument($role, $role_pursuited);
        return [
            'role_pursuited' => $role_pursuited,
            'instrument' => $instrument,
            'genre' => Random::array_value(Genre::get_all()),
            'urgency' => Random::array_value(Urgency::get_all_options()),
        ];
    }

    public static function generate_instrument($role, $role_pursuited) {
        if ((strcasecmp($role, 'band') == 0 && strcasecmp($role_pursuited, 'agent') == 0) ||
                (strcasecmp($role, 'agent') == 0 && strcasecmp($role_pursuited, 'band') == 0)) {
            return '';
        }
        return Random::array_value(Instrument::$most_common);
    }

    public static function prepare_data_to_table() {
        global $pursuits;
        $ret = [];
        $count = 0;

        foreach ($pursuits as $pursuit) {
            $urgency = self::urgency_to_string($pursuit['urgency']);
            $instrument = self::instrument($pursuit['role_pursuited'], $pursuit['instrument']);

            $ret [] = [
                '' => ++$count,
                'role' => $pursuit['role_pursuited'],
                'instrument' => $instrument,
                'genre' => $pursuit['genre'],
                'urgent' => $urgency,
            ];
        }
        return $ret;
    }

    public static function urgency_to_string($urgency) {
        switch ($urgency) {
            case 0:
                return 'No';
            case 1:
                return 'Yes';
            default:
                die('$urgency: urgency_to_string()');
        }
    }

    public static function instrument($role_pursuited, $instrument) {
        $role = User::get_role();
        if (($role == 'band' && $role_pursuited == 'agent') ||
                ($role == 'agent' && $role_pursuited == 'band')) {
            return '';
        }
        return $instrument;
    }

    public static function get_limit_inner_join($has_limit) {
        if ($has_limit == true) {
            return self::MAX_SHOW_ON_INDEX;
        }
        return self::get_number_rows();
    }

    public static function get_all_musician_pursuit_band($has_limit) {
        $args = [
            'select' => [
                'users.username',
                'users.first_name',
                'users.last_name',
                'musicians.birth_date',
                'musicians.gender',
                'users.region',
                'users.country',
                'users.city_state',
                'pursuits.instrument',
                'pursuits.genre',
                'pursuits.urgency',
                'pursuits.created_at',
                'users.is_online'
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'pursuits'
                    ],
                    'on' => [
                        'users.id=pursuits.user_id',
                        'users.role=\'musician\'',
                        'pursuits.role_pursuited=\'band\''
                    ],
                ],
                1 => [
                    'inner_join' => [
                        'musicians'
                    ],
                    'on' => [
                        'users.id=musicians.user_id',
                    ],
                ]
            ],
            'order_by' => [
                'users.first_name'
            ],
            'limit' => self::get_limit_inner_join($has_limit)
        ];


        return SharedRepository::select_inner_join_on_order_by($args);
    }

    public static function get_all_musician_pursuit_agent($has_limit) {
        $args = [
            'select' => [
                'users.username',
                'users.first_name',
                'users.last_name',
                'musicians.birth_date',
                'musicians.gender',
                'users.region',
                'users.country',
                'users.city_state',
                'pursuits.instrument',
                'pursuits.genre',
                'pursuits.urgency',
                'pursuits.created_at',
                'users.is_online'
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'pursuits'
                    ],
                    'on' => [
                        'users.id=pursuits.user_id',
                        'users.role=\'musician\'',
                        'pursuits.role_pursuited=\'agent\''
                    ],
                ],
                1 => [
                    'inner_join' => [
                        'musicians'
                    ],
                    'on' => [
                        'users.id=musicians.user_id',
                    ],
                ]
            ],
            'order_by' => [
                'users.first_name'
            ],
            'limit' => self::get_limit_inner_join($has_limit)
        ];


        return SharedRepository::select_inner_join_on_order_by($args);
    }

    public static function get_all_band_pursuit_musician($has_limit) {
        $args = [
            'select' => [
                'users.username',
                'bands.name',
                'bands.formation_date',
                'bands.number_elements',
                'users.region',
                'users.country',
                'users.city_state',
                'pursuits.instrument',
                'pursuits.genre',
                'pursuits.urgency',
                'pursuits.created_at',
                'users.is_online'
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'pursuits'
                    ],
                    'on' => [
                        'users.id=pursuits.user_id',
                        'users.role=\'band\'',
                        'pursuits.role_pursuited=\'musician\''
                    ],
                ],
                1 => [
                    'inner_join' => [
                        'bands'
                    ],
                    'on' => [
                        'users.id=bands.user_id',
                    ],
                ]
            ],
            'order_by' => [
                'bands.name'
            ],
            'limit' => self::get_limit_inner_join($has_limit)
        ];
        return SharedRepository::select_inner_join_on_order_by($args);
    }

    public static function get_all_band_pursuit_agent($has_limit) {
        $args = [
            'select' => [
                'users.username',
                'bands.name',
                'bands.formation_date',
                'bands.number_elements',
                'users.region',
                'users.country',
                'users.city_state',
                'pursuits.genre',
                'pursuits.urgency',
                'pursuits.created_at',
                'users.is_online'
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'pursuits'
                    ],
                    'on' => [
                        'users.id=pursuits.user_id',
                        'users.role=\'band\'',
                        'pursuits.role_pursuited=\'agent\''
                    ],
                ],
                1 => [
                    'inner_join' => [
                        'bands'
                    ],
                    'on' => [
                        'users.id=bands.user_id',
                    ],
                ]
            ],
            'order_by' => [
                'bands.name'
            ],
            'limit' => self::get_limit_inner_join($has_limit)
        ];
        return SharedRepository::select_inner_join_on_order_by($args);
    }

    public static function get_all_agent_pursuit_musician($has_limit) {
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
                'pursuits.instrument',
                'pursuits.genre',
                'pursuits.urgency',
                'pursuits.created_at',
                'users.is_online'
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'pursuits'
                    ],
                    'on' => [
                        'users.id=pursuits.user_id',
                        'users.role=\'agent\'',
                        'pursuits.role_pursuited=\'musician\''
                    ],
                ],
                1 => [
                    'inner_join' => [
                        'agents'
                    ],
                    'on' => [
                        'users.id=agents.user_id',
                    ],
                ]
            ],
            'order_by' => [
                'users.first_name'
            ],
            'limit' => self::get_limit_inner_join($has_limit)
        ];
        return SharedRepository::select_inner_join_on_order_by($args);
    }

    public static function get_all_agent_pursuit_band($has_limit) {
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
                'pursuits.genre',
                'pursuits.urgency',
                'pursuits.created_at',
                'users.is_online'
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'pursuits'
                    ],
                    'on' => [
                        'users.id=pursuits.user_id',
                        'users.role=\'agent\'',
                        'pursuits.role_pursuited=\'band\''
                    ],
                ],
                1 => [
                    'inner_join' => [
                        'agents'
                    ],
                    'on' => [
                        'users.id=agents.user_id',
                    ],
                ]
            ],
            'order_by' => [
                'users.first_name'
            ],
            'limit' => self::get_limit_inner_join($has_limit)
        ];
        return SharedRepository::select_inner_join_on_order_by($args);
    }

    public static function get_all_by_type($type) {
        $has_limit = false;
        switch ($type) {
            case 1:
                return Pursuit::get_all_musician_pursuit_band($has_limit);
            case 2:
                return Pursuit::get_all_musician_pursuit_agent($has_limit);
            case 3:
                return Pursuit::get_all_band_pursuit_musician($has_limit);
            case 4:
                return Pursuit::get_all_band_pursuit_agent($has_limit);
            case 5:
                return Pursuit::get_all_agent_pursuit_musician($has_limit);
            case 6:
                return Pursuit::get_all_agent_pursuit_band($has_limit);
            default:
                break;
        }
    }

    public static function get_name_by_type($type) {
        switch ($type) {
            case 1:
                return 'Musicians Looking For Bands';
            case 2:
                return 'Musicians Looking For Agents';
            case 3:
                return 'Bands Looking For Musicians';
            case 4:
                return 'Bands Looking For Agents';
            case 5:
                return 'Agents Looking For Musicians';
            case 6:
                return 'Agents Looking For Bands';
            default:
                return 'type: get_name_by_type()';
        }
    }

    public static function get_id_update_or_delete($form_mode) {
        $relation_order_id = Pursuit::get_relation_element_order_and_id();
        $selected_row = $_POST[$form_mode . '_selected_row'];
        return $relation_order_id[$selected_row];
    }

    public static function get_data_for_update($data) {
        $data_changeable = [];
        $fields_changeable = self::get_fields_updatedable();
        foreach ($fields_changeable as $key => $value) {
            $data_changeable[$value] = $data[$value];
        }
        return $data_changeable;
    }

    public static function get_by_id($id) {
        $all = self::get_all_data();
        foreach ($all as $key => $value) {
            if ($value['id'] == $id) {
                return $value;
            }
        }
        return false;
    }

    public static function table_has_data() {
        if (!User::logged_in()) {
            return false;
        }
        global $session_user_id;
        $fields = [
            'id'
        ];
        $args = [
            'user_id' => $session_user_id
        ];
        $id = SharedRepository::select_exists(self::$table, $fields, $args);

        if (empty($id)) {
            return false;
        }
        return true;
    }

}
