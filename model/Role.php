<?php

class Role {

    private static $roles = array(
        //0 => 'regular',
        //1 => 'admin',
        //2 => 'moderator',
        3 => 'Musician',
        4 => 'Band',
        5 => 'Agent',
    );
    private static $roles_range = array(
        'min' => 3,
        'max' => 5
    );
    private static $roles_forms_names = array(
        3 => 'register_musician_form',
        4 => 'register_band_form',
        5 => 'register_agent_form'
    );

    public static function get_role_by_number($n) {
        return self::$roles[$n];
    }

    public static function exists($role) {
        $role = DataStructure::prepare_string_comparison($role);
        foreach (self::$roles as $key => $value) {
            $value = DataStructure::prepare_string_comparison($value);
            if ($value == $role) {
                return true;
            }
        }
        return false;
    }

    public static function all_required_fields_have_data() {
        if (User::logged_in()) {
            global $role;
            $fields = self::get_required_fields_no_user_fields($role);
            foreach ($fields as $key => $value) {
                if (!self::field_has_data($value)) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public static function field_has_data($field) {
        if (User::logged_in()) {
            global $role_data;
            return(!empty($role_data[$field]));
        }
        return false;
    }

    public static function get_birth_date() {
        global $role_data;
        return $role_data['birth_date'];
    }

    public static function is_band() {
        if (User::logged_in()) {
            global $role;
            if ($role == 'band') {
                return true;
            }
        }
        return false;
    }

    public static function is_musician() {
        if (User::logged_in()) {
            global $role;
            if ($role == 'musician') {
                return true;
            }
        }
        return false;
    }

    public static function is_agent() {
        if (User::logged_in()) {
            global $role;
            if ($role == 'agent') {
                return true;
            }
        }
        return false;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_settings_file_path($role) {
        global $config;
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return $config['file']['settings_musician'];
            case 'band':
                return $config['file']['settings_band'];
            case 'agent':
                return $config['file']['settings_agent'];
            default:
                die('role-get_settings_file_path');
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_all_data($role, $id) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return Musician::get_data($id);
            case 'band':
                return Band::get_data($id);
            case 'agent':
                return Agent::get_data($id);
            default:
                die('role-get_all_data');
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_min_age($role) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return Musician::MIN_AGE;
            case 'band':
                return Band::MIN_AGE;
            case 'agent':
                return Agent::MIN_AGE;
            default:
                die('role-get_min_age');
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_max_age($role) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return Musician::MAX_AGE;
            case 'band':
                return Band::MAX_AGE;
            case 'agent':
                return Agent::MAX_AGE;
            default:
                die('role-get_max_age');
        }
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_settings_field_error($field, $value, $role) {
        $regex = new Regex;
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            /*
             * musician
             */
            case 'musician':
                switch ($field) {
                    case 'birth_date':
                        if (!Validation::date($value, $role, 'birth')) {
                            return self::get_age_error_msg($role);
                        }
                        return false;
                    default:
                        return false;
                }
            /*
             * band
             */
            case 'band':
                switch ($field) {
                    case 'name':
                        if (preg_match($regex->get_regex_band_name(), $value) == false) {
                            return $regex->get_regex_band_name_error_msg();
                        }
                        return false;
                    case 'formation_date':
                        if (!Validation::date($value, $role, 'birth')) {
                            return self::get_age_error_msg($role);
                        }
                        return false;
                    default:
                        return false;
                }
            /*
             * band member
             */
            case 'band_member':
                switch ($field) {
                    case 'name':
                        if (preg_match($regex->get_regex_band_member_name(), $value) == false) {
                            return $regex->get_regex_band_member_name_error_msg();
                        }
                        return false;
                    case 'birth_date':
                        return self::get_settings_field_error('birth_date', $value, 'musician');
                    case 'join_date':
                        $birth_date = $_POST['birth_date'];
                        if (!Validation::date_d1_before_date_d2($birth_date, $value)) {
                            return self::get_age_error_msg('band_member');
                        }
                        return false;
                    default:
                        return false;
                }
            /*
             * agent
             */
            case 'agent':
                switch ($field) {
                    case 'birth_date':
                        if (!Validation::date($value, $role, 'birth')) {
                            return self::get_age_error_msg($role);
                        }
                        return false;
                    default:
                        return false;
                }
            default:
                die('role-get_settings_field_error');
        }
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_settings_fields($role) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return Musician::get_settings_fields();
            case 'band':
                return Band::get_settings_fields();
            case 'agent':
                return Agent::get_settings_fields();
            default:
                die('role-get_settings_fields');
        }
    }

    public static function get_settings_fields_with_user_fields($role) {
        $user_fields = User::get_settings_fields();
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return array_merge($user_fields, Musician::get_settings_fields());
            case 'band':
                return array_merge($user_fields, Band::get_settings_fields());
            case 'agent':
                return array_merge($user_fields, Agent::get_settings_fields());
            default:
                die('role-get_settings_fields');
        }
    }

    public static function get_settings_values_with_user_values() {
        //user
        global $role;
        $fields = User::get_settings_fields();
        global $user_data;
        $ret_user = self::get_fields_values($fields, $user_data);

        //role
        $role = DataStructure::prepare_string_comparison($role);
        $ret_role = [];
        global $role_data;
        switch ($role) {
            case 'musician':
                $fields = Musician::get_settings_fields();
                break;
            case 'band':
                $fields = Band::get_settings_fields();
                break;
            case 'agent':
                $fields = Agent::get_settings_fields();
                break;
            default:
                break;
        }
        $ret_role = self::get_fields_values($fields, $role_data);
        return array_merge($ret_user, $ret_role);
    }

    public static function get_fields_values($fields, $data) {
        $ret = [];
        foreach ($fields as $value) {
            $ret[$value] = $data[$value];
        }
        return $ret;
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function update($role, $user_id, $data_to_set) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return Musician::update($user_id, $data_to_set);
            case 'band':
                return Band::update($user_id, $data_to_set);
            case 'agent':
                return Agent::update($user_id, $data_to_set);
            default:
                die('role-update');
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_age_error_msg($role) {
        $role = DataStructure::prepare_string_comparison($role);
        $generic_date_error = Validation::date_format_error_message();
        switch ($role) {
            case 'musician':
                return 'The date of birth is invalid.'
                        . ' The age has to be between ' .
                        Musician::MIN_AGE . ' and ' .
                        Musician::MAX_AGE . ' years. ' .
                        $generic_date_error;
            case 'band':
                return 'The band\'s date of formation (or member joining date) is invalid.'
                        . ' The band\'s age (or time in the band) has to be between ' .
                        BAND::MIN_AGE . ' and ' .
                        Band::MAX_AGE . ' years. ' .
                        $generic_date_error;
            case 'band_member':
                return 'The band  member joining date is invalid. '
                        . ' The join date has to be after the date of birth. ' .
                        $generic_date_error;
            case 'agent':
                return 'The date of birth is invalid.'
                        . ' The age has to be between ' .
                        Agent::MIN_AGE . ' and ' .
                        Agent::MAX_AGE . ' years. ' .
                        $generic_date_error;
            default:
                die('role-get_age_error_msg');
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_required_fields_by_role($role) {
        global $config;
        $role_name = self::role_to_string($role);

        $required_fields_role;
        switch ($role_name) {
            case 'musician':
                $required_fields_role = Musician::get_register_required_fields();
                break;
            case 'band':
                $required_fields_role = Band::get_register_required_fields();
                break;
            case 'agent':
                $required_fields_role = Agent::get_register_required_fields();
                break;
            default:
                die('role-get_required_fields_by_role');
        }
        return array_merge(User::get_register_required_fields(), $required_fields_role);
    }

    public static function get_required_fields_no_user_fields() {
        if (User::logged_in()) {
            global $role;
            $role = DataStructure::prepare_string_comparison($role);
            switch ($role) {
                case 'musician':
                    return Musician::get_required_fields();
                case 'band':
                    return Band::get_required_fields();
                case 'agent':
                    return Agent::get_required_fields();
                default:
                    die('role-get_required_fields_no_user_data');
            }
        }
        return false;
    }

    public static function settings_data($role) {
        $role = DataStructure::prepare_string_comparison($role);
        $fields = [];
        switch ($role) {
            case 'musician':
                $fields = Musician::get_settings_fields();
                break;
            case 'band':
                $fields = Band::get_settings_fields();
                break;
            case 'agent':
                $fields = Agent::get_settings_fields();
                break;
            default:
                die('role-settings_data');
        }
        return Post::get_settings_data_to_array($fields);
    }

    public static function profile_to_array($role) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return Musician::profile_to_array();
            case 'band':
                return Band::profile_to_array();
            case 'agent':
                return Agent::profile_to_array();
            default:
                die('role-profile_to_array');
        }
    }

    public static function profile_to_array_by_user_id($role, $user_id) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                return Musician::profile_to_array_by_user_id($user_id);
            case 'band':
                return Band::profile_to_array_by_user_id($user_id);
            case 'agent':
                return Agent::profile_to_array_by_user_id($user_id);
            default:
                die('role-profile_to_array');
        }
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_experience_data($role, $user_id) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician_alone':
                return MusicianExperienceAlone::get_all_data($user_id);
            case 'musician_band':
                return MusicianExperienceBand::get_all_data($user_id);
            case 'band':
                return BandExperience::get_all_data($user_id);
            case 'agent':
                return AgentExperience::get_all_data($user_id);
            default:
                die('role-get_experience_data');
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function role_to_string($role) {
        return strtolower(self::$roles[$role]);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_form_by_role($role) {
        global $config;
        $form_name = self::$roles_forms_names[$role];
        include $config['file'][$form_name];
    }

    /*
     * **************************************************
     * Get
     * **************************************************
     */

    public static function get_roles() {
        return self::$roles;
    }

    public static function get_roles_except_this() {
        if (User::logged_in()) {
            $all = self::$roles;
            global $role;
            $role = ucfirst($role);
            $this_role = [$role];
            return array_diff($all, $this_role);
        }
        return false;
    }

    public static function get_random() {
        return Random::array_value(self::get_roles());
    }

    public static function get_random_diff_mine() {
        if (User::logged_in()) {
            $role = User::get_role();
            $random_role = Random::array_value(self::get_roles());
            while (strcasecmp($role, $random_role) == 0) {
                $random_role = Random::array_value(self::get_roles());
            }
            return $random_role;
        }
        return false;
    }

    public static function get_random_diff($role) {
        $random_role = Random::array_value(self::get_roles());
        while (strcasecmp($role, $random_role) == 0) {
            $random_role = Random::array_value(self::get_roles());
        }
        return $random_role;
    }

    public static function get_roles_range() {
        return self::$roles_range;
    }

    public static function get_roles_forms_names() {
        return self::$roles_forms_names;
    }

    /*
     * **************************************************
     * Stuff common to all the roles
     * **************************************************
     */

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function create($role, $username, $is_dummy) {
        $user_id = User::get_id_from_username($username);
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician':
                $val = Musician::create($user_id);
                if ($is_dummy == true) {
                    $update_data = Musician::generate_update_data();
                    $val = Musician::update($user_id, $update_data);
                    // --- Experience alone ---
                    if ($val == true) {
                        $data_exp_alone = MusicianExperienceAlone::generate_data();
                        $val = MusicianExperienceAlone::create($user_id, $data_exp_alone);
                        // --- Experience Band ---
                        $data_exp_band = MusicianExperienceBand::generate_data();
                        $val = MusicianExperienceBand::create($user_id, $data_exp_band);
                    }
                }
                return $val;
            case 'band':
                $val = Band::create($user_id);
                if ($is_dummy == true) {
                    $update_data = Band::generate_update_data();
                    $val = Band::update($user_id, $update_data);
                    if ($val == true) {
                        $band_data = Band::get_data($user_id);
                        // --- Members ---
                        $n_members = $band_data['number_elements'];
                        foreach (range(1, $n_members) as $i) {
                            $insert_data = BandMember::generate_data($user_id, $i);
                            $val = BandMember::create($insert_data);
                        }
                        // --- Experience ---
                        if ($val == true) {
                            $band_exp_data = BandExperience::generate_data();
                            $val = BandExperience::create($user_id, $band_exp_data);
                        }
                    }
                }
                return $val;
            case 'agent':
                $val = Agent::create($user_id);
                if ($is_dummy == true) {
                    $update_data = Agent::generate_update_data();
                    $val = Agent::update($user_id, $update_data);
                    // --- Experience ---
                    if ($val == true) {
                        $agent_exp_data = AgentExperience::generate_data();
                        $val = AgentExperience::create($user_id, $agent_exp_data);
                    }
                }
                return $val;
            default:
                die('role-create');
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function insert($user_id, $table) {
        $register_data = [
            'user_id' => $user_id
        ];
        return SharedRepository::insert($table, $register_data);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function edit($user_id, $table, $data_to_set) {
        $args = [
            'user_id' => $user_id
        ];
        $val = SharedRepository::update_set($table, $data_to_set, $args);
        if ($val == true) {
            SharedRepository::update_set_time_now($table, 'updated_at', 'id', $user_id);
        }
        return $val;
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_data($user_id, $fields, $table) {
        $data = [];
        $user_id = (int) $user_id;
        if (sizeof($fields) > 0) {
            $args = [
                'user_id' => $user_id
            ];
            $data = SharedRepository::select_array_fetch_assoc($table, $fields, $args);
        }
        return $data;
    }

    public static function get_id() {
        if (User::logged_in()) {
            global $role_data;
            return $role_data['user_id'];
        }
        return false;
    }

}
