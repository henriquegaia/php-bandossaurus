<?php

class Experience {

    const MAX_YEARS_EXPERIENCE = 80;
    const MAX_SONGS = 200;
    const MAX_ALBUMS = 50;
    const MAX_TOURS = 50;
    const MAX_CONCERTS = 500;
    const MAX_RECORDS = 50;
    const EXP_MUS_ALO_FILE = 'experience_musician_alone';
    const EXP_MUS_BAN_FILE = 'experience_musician_bands';
    const EXP_BAN_FILE = 'experience_band';
    const EXP_AGE_FILE = 'experience_agent';

    public static function create($user_id, $data, $role_id_field, $table) {
        $id_arr = [
            $role_id_field => $user_id,
        ];
        $register_data = array_merge($id_arr, $data);
        return SharedRepository::insert($table, $register_data);
    }

    public static function update($id, $data_to_set, $table) {
        global $session_user_id;
        $args = [
            'id' => $id
        ];
        $val = SharedRepository::update_set($table, $data_to_set, $args);
        if ($val == true) {
            return User::update_field_updated_at($session_user_id);
        }
        return false;
    }

    public static function delete($id, $table) {
        $args = [
            'id' => $id
        ];
        return SharedRepository::delete_simple($table, $args);
    }

    public static function get_total($table) {
        $field_return = 'id';
        $args = [];
        return SharedRepository::select_count($table, $field_return, $args);
    }

    public static function get_all_data($table, $columns, $arg_key, $arg_value) {
        $data = [];
        $args = [
            $arg_key => $arg_value
        ];
        $data = SharedRepository::select_multi_array($columns, $table, $args);
        return $data;
    }

    public static function get_relation_element_order_and_id($arr) {
        $ret = [];
        $count = 0;
        foreach ($arr as $key) {
            $ret[++$count] = $key['id'];
        }
        return $ret;
    }

    public static function get_experience_prepared_data($role) {
        $role = DataStructure::prepare_string_comparison($role);
        switch ($role) {
            case 'musician_alone':
                return MusicianExperienceAlone::prepare_data_to_table();
            case 'musician_band':
                return MusicianExperienceBand::prepare_data_to_table();
            case 'band':
                return BandExperience::prepare_data_to_table();
            case 'agent':
                return AgentExperience::prepare_data_to_table();
            default:
                die('experience-get_experience_prepared_data');
        }
    }

//    public static function get_experience_prepared_data_by_user_id($role,$user_id) {
//        $role = DataStructure::prepare_string_comparison($role);
//        switch ($role) {
//            case 'musician_alone':
//                return MusicianExperienceAlone::prepare_data_to_table_by_user_id($user_id);
//            case 'musician_band':
//            case 'band':
//            case 'agent':
//            default:
//                die('experience-get_experience_prepared_data_by_user_id');
//        }
//    }

    public static function get_settings_field_error($field, $value, $exp) {
        $exp = DataStructure::prepare_string_comparison($exp);
        switch ($exp) {
            case 'musician_alone':
                switch ($field) {
                    case 'demo_link':
                        return self::get_error_demo_link($field, $value, $exp);
                    default:
                        return false;
                }
                break;
            case 'musician_bands':
                switch ($field) {
                    case 'band_name':
                        return self::get_error_band_name($value);
                    case 'band_username':
                        return self::get_error_artist_username($field, $value, $exp);
                    case 'start_date':
                        return self::get_error_start_date($value, $exp);
                    case 'end_date':
                        return self::get_error_end_date($field, $value, $exp, $_POST['start_date']);
                    case 'demo_link':
                        return self::get_error_demo_link($field, $value, $exp);
                    default:
                        return false;
                }
            case 'band':
                switch ($field) {
                    case 'demo_link':
                        return self::get_error_demo_link($field, $value, $exp);
                    default:
                        return false;
                }
            case 'agent':
                switch ($field) {
                    case 'artist_name':
                        return self::get_error_band_name($value);
                    case 'artist_username':
                        return self::get_error_artist_username($field, $value, $exp);
                    case 'start_date':
                        return self::get_error_start_date($value, $exp);
                    case 'end_date':
                        return self::get_error_end_date($field, $value, $exp, $_POST['start_date']);
                    case 'demo_link':
                        return self::get_error_demo_link($field, $value, $exp);
                    default:
                        return false;
                }
            default:
                die('exp-get_settings_field_error');
        }
    }

    /*
     * **************************************************
     * ERROR MESSAGES
     * **************************************************
     */

    public static function get_error_start_date($value, $exp) {
        $birth_date = self::get_birth_date($exp);
        if (!Validation::date($value, 'null', 'null') ||
                !Validation::date_d1_before_date_d2($birth_date, $value)) {
            return 'The start date is wrong or has wrong format.';
        }
        return false;
    }

    public static function get_birth_date($exp) {
        switch ($exp) {
            case 'musician_bands':
            case 'agent':
                return Role::get_birth_date();
            default:
                die('exp-get_start_date');
        }
    }

    public static function get_error_end_date($field, $value, $exp, $start) {
        /*
         * Important: validate date format
         */
        switch ($exp) {
            case 'musician_bands':
                if (in_array($field, MusicianExperienceBand::get_non_required_fields()) &&
                        $_POST[$field] == '') {
                    return false;
                }
                break;
            case 'agent':
                if (in_array($field, AgentExperience::get_non_required_fields()) &&
                        $_POST[$field] == '') {
                    return false;
                }
                break;
            default:
                die('sub_mode-get_error_end_date');
        }
        if (!Validation::date($start, 'null', 'null') ||
                !Validation::date($value, 'null', 'null') ||
                !Validation::date_d1_before_date_d2($start, $value)) {
            return 'The end date is wrong or has wrong format.';
        }
        return false;
    }

    public static function get_error_demo_link($field, $value, $exp) {
        $regex = new Regex;
        switch ($exp) {
            case 'musician_alone':
                if (in_array($field, MusicianExperienceAlone::get_non_required_fields()) &&
                        $_POST[$field] == '') {
                    return false;
                }
                break;
            case 'musician_bands':
                if (in_array($field, MusicianExperienceBand::get_non_required_fields()) &&
                        $_POST[$field] == '') {
                    return false;
                }
                break;
            case 'band':
                if (in_array($field, BandExperience::get_non_required_fields()) &&
                        $_POST[$field] == '') {
                    return false;
                }
                break;
            case 'agent':
                if (in_array($field, AgentExperience::get_non_required_fields()) &&
                        $_POST[$field] == '') {
                    return false;
                }
                break;
            default:
                die('sub_mode-get_error_demo_link');
        }

        if (preg_match($regex->get_regex_youtube_link(), $value) == false ||
                !Validation::url_exists($value)) {
            return $regex->get_regex_youtube_link_error_msg();
        }
        return false;
    }

    public static function get_error_band_name($value) {
        $regex = new Regex;
        if (preg_match($regex->get_regex_band_name(), $value) == false) {
            return $regex->get_regex_band_name_error_msg();
        }
        return false;
    }

    public static function get_error_artist_username($field, $value, $exp) {
        switch ($exp) {
            case 'musician_bands':
                if (in_array($field, MusicianExperienceBand::get_non_required_fields()) &&
                        $_POST[$field] == '') {
                    return false;
                }
                break;
            case 'agent':
                if (in_array($field, AgentExperience::get_non_required_fields()) &&
                        $_POST[$field] == '') {
                    return false;
                }
                break;
            default:
                die('sub_mode-get_error_artist_username');
        }
        if (!empty($value) && !Band::username_exists($value)) {
            return 'That username doesn\'t exist or is not associated with a band/solo artist.';
        }
        return false;
    }

    /*
     * 
     */

    public static function agent_exp_field_required($field) {
        
    }

    public static function band_exp_field_required($field) {
        
    }

    public static function mus_alone_exp_field_required($field) {
        
    }

    public static function mus_bands_exp_field_required($field) {
        
    }

    /*
     * ***********************************************************************
     * CRUD
     * ***********************************************************************
     */

    public static function execute_crud_and_redirect($args) {

        if (isset($_GET[Get::SUCCESS_PARAM]) === true && empty($_GET[Get::SUCCESS_PARAM])) {
            Presentation::success_message();
        } else if (isset($_GET[Get::UNSUCCESS_PARAM]) === true && empty($_GET[Get::UNSUCCESS_PARAM]) === true) {
            Presentation::failure_message();
            $text = 'If that\'s the case, you can\'t create/update an experience to information that already exists in the table.';
            Presentation::print_failure_message($text);
        } else {
            if (empty($_POST) === false && empty($args['errors']) === true) {
                $csrf_args = self::filter_csrf_args($args);
                self::check_csrf($csrf_args);
                self::crud($args);
            }
        }
    }

    public static function filter_csrf_args($args) {
        return [
            1 => $args['args_post']['update_mode'],
            2 => $args['args_post']['delete_mode'],
            3 => $args['args_post']['create_mode'],
        ];
    }

    public static function check_csrf($args) {
        if (isset($_POST['form_mode'])) {
            $form_mode = $_POST['form_mode'];
            Token::check_csrf_3_forms($form_mode, $args);
        } else {
            return false;
        }
    }

    public static function crud($args) {
        $sub_mode = $args['args_post']['sub_mode'];
        switch ($sub_mode) {
            case 'musician_alone':
                self::crud_musician_alone($args);
                break;
            case 'musician_bands':
                self::crud_musician_bands($args);
                break;
            case 'band':
                self::crud_band($args);
                break;
            case 'agent':
                self::crud_agent($args);
                break;
            default:
                die('sub_mode-crud');
        }
    }

    /*
     * ***********************************************************************
     * CRUD - Musician alone
     * ***********************************************************************
     */

    public static function crud_musician_alone($args) {

        $form_mode = $_POST['form_mode'];
        $exp_id = self::get_experience_id_on_mode_switch($args);
        $posted_data = self::get_posted_data_on_mode_switch($args);

        switch ($form_mode) {
            case 'update_experience_musician_alone':
                self::crud_musician_alone_update($exp_id, $posted_data);
                break;
            case 'delete_experience_musician_alone':
                self::crud_musician_alone_delete($exp_id);
                break;
            case 'create_experience_musician_alone':
                self::crud_musician_alone_create($posted_data);
                break;
            default:
                die('$form_mode-crud_musician_alone()');
        }
    }

    public static function crud_musician_alone_update($exp_id, $posted_data) {
        if (MusicianExperienceAlone::update($exp_id, $posted_data) == true) {
            Redirect::success_status(self::EXP_MUS_ALO_FILE, 'update', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_MUS_ALO_FILE, 'update', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    public static function crud_musician_alone_delete($exp_id) {
        if (MusicianExperienceAlone::delete($exp_id) == true) {
            Redirect::success_status(self::EXP_MUS_ALO_FILE, 'delete', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_MUS_ALO_FILE, 'delete', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    public static function crud_musician_alone_create($posted_data) {
        global $session_user_id;
        if (MusicianExperienceAlone::create($session_user_id, $posted_data) == true) {
            Redirect::success_status(self::EXP_MUS_ALO_FILE, 'create', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_MUS_ALO_FILE, 'create', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    /*
     * ***********************************************************************
     * CRUD - Musician bands
     * ***********************************************************************
     */

    public static function crud_musician_bands($args) {
        $form_mode = $_POST['form_mode'];
        $exp_id = self::get_experience_id_on_mode_switch($args);
        $posted_data = self::get_posted_data_on_mode_switch($args);

        switch ($form_mode) {
            case 'update_experience_musician_bands':
                self::crud_musician_bands_update($exp_id, $posted_data);
                break;
            case 'delete_experience_musician_bands':
                self::crud_musician_bands_delete($exp_id);
                break;
            case 'create_experience_musician_bands':
                self::crud_musician_bands_create($posted_data);
                break;
            default:
                die('$form_mode-crud_musician_bands()');
        }
    }

    public static function crud_musician_bands_update($exp_id, $posted_data) {
        if (MusicianExperienceBand::update($exp_id, $posted_data) == true) {
            Redirect::success_status(self::EXP_MUS_BAN_FILE, 'update', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_MUS_BAN_FILE, 'update', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    public static function crud_musician_bands_delete($exp_id) {
        if (MusicianExperienceBand::delete($exp_id) == true) {
            Redirect::success_status(self::EXP_MUS_BAN_FILE, 'delete', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_MUS_BAN_FILE, 'delete', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    public static function crud_musician_bands_create($posted_data) {
        global $session_user_id;
        if (MusicianExperienceBand::create($session_user_id, $posted_data) == true) {
            Redirect::success_status(self::EXP_MUS_BAN_FILE, 'create', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_MUS_BAN_FILE, 'create', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    /*
     * ***********************************************************************
     * CRUD - Band
     * ***********************************************************************
     */

    public static function crud_band($args) {
        $form_mode = $_POST['form_mode'];
        $exp_id = self::get_experience_id_on_mode_switch($args);
        $posted_data = self::get_posted_data_on_mode_switch($args);

        switch ($form_mode) {
            case 'update_experience_band':
                self::crud_band_update($exp_id, $posted_data);
                break;
            case 'delete_experience_band':
                self::crud_band_delete($exp_id);
                break;
            case 'create_experience_band':
                self::crud_band_create($posted_data);
                break;
            default:
                die('$form_mode-crud_band()');
        }
    }

    public static function crud_band_update($exp_id, $posted_data) {
        if (BandExperience::update($exp_id, $posted_data) == true) {
            Redirect::success_status(self::EXP_BAN_FILE, 'update', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_BAN_FILE, 'update', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    public static function crud_band_delete($exp_id) {
        if (BandExperience::delete($exp_id) == true) {
            Redirect::success_status(self::EXP_BAN_FILE, 'delete', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_BAN_FILE, 'delete', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    public static function crud_band_create($posted_data) {
        global $session_user_id;
        if (BandExperience::create($session_user_id, $posted_data) == true) {
            Redirect::success_status(self::EXP_BAN_FILE, 'create', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_BAN_FILE, 'create', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    /*
     * ***********************************************************************
     * CRUD - Agent
     * ***********************************************************************
     */

    public static function crud_agent($args) {
        $form_mode = $_POST['form_mode'];
        $exp_id = self::get_experience_id_on_mode_switch($args);
        $posted_data = self::get_posted_data_on_mode_switch($args);

        switch ($form_mode) {
            case 'update_experience_agent':
                self::crud_agent_update($exp_id, $posted_data);
                break;
            case 'delete_experience_agent':
                self::crud_agent_delete($exp_id);
                break;
            case 'create_experience_agent':
                self::crud_agent_create($posted_data);
                break;
            default:
                die('$form_mode-crud_agent()');
        }
    }

    public static function crud_agent_update($exp_id, $posted_data) {
        if (AgentExperience::update($exp_id, $posted_data) == true) {
            Redirect::success_status(self::EXP_AGE_FILE, 'update', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_AGE_FILE, 'update', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    public static function crud_agent_delete($exp_id) {
        if (AgentExperience::delete($exp_id) == true) {
            Redirect::success_status(self::EXP_AGE_FILE, 'delete', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_AGE_FILE, 'delete', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    public static function crud_agent_create($posted_data) {
        global $session_user_id;
        if (AgentExperience::create($session_user_id, $posted_data) == true) {
            Redirect::success_status(self::EXP_AGE_FILE, 'create', Get::SUCCESS_PARAM);
        } else {
            Redirect::success_status(self::EXP_AGE_FILE, 'create', Get::UNSUCCESS_PARAM);
        }
        exit();
    }

    /*
     * ***********************************************************************
     * get exp id
     * ***********************************************************************
     */

    public static function get_experience_id_on_mode_switch($args) {
        $form_mode = $_POST['form_mode'];
        switch ($form_mode) {
            case 'update_experience_musician_alone':
            case 'delete_experience_musician_alone':
            case 'update_experience_musician_bands':
            case 'delete_experience_musician_bands':
            case 'update_experience_band':
            case 'delete_experience_band':
            case 'update_experience_agent':
            case 'delete_experience_agent':
                $exp_id = self::get_experience_id_for_update_or_delete($args);
                return $exp_id;
            case 'create_experience_musician_alone':
            case 'create_experience_musician_bands':
            case 'create_experience_band':
            case 'create_experience_agent':
                return 0;
            default:
                die('$form_mode-get_experience_id_on_mode_switch()');
        }
    }

    public static function get_experience_id_for_update_or_delete($args) {
        $form_mode = $_POST['form_mode'];
        $sub_mode = $args['args_post']['sub_mode'];
        $exp_data = [];
        switch ($sub_mode) {
            case 'musician_alone':
                global $experience_data_musician_alone;
                $exp_data = $experience_data_musician_alone;
                break;
            case 'musician_bands':
                global $experience_data_musician_band;
                $exp_data = $experience_data_musician_band;
                break;
            case 'band':
            case 'agent':
                global $experience_data;
                $exp_data = $experience_data;
                break;
            default:
                die('sub_mode-get_experience_id_for_update_or_delete()');
        }

        $relation_order_id = self::get_relation_element_order_and_id($exp_data);
        $selected_row = $_POST[$form_mode . '_selected_row'];
        return $relation_order_id[$selected_row];
    }

    /*
     * ***********************************************************************
     * get posted data
     * ***********************************************************************
     */

    public static function get_posted_data_on_mode_switch($args) {
        $form_mode = $_POST['form_mode'];
        switch ($form_mode) {
            case 'update_experience_musician_alone':
            case 'create_experience_musician_alone':
            case 'update_experience_musician_bands':
            case 'create_experience_musician_bands':
            case 'update_experience_band':
            case 'create_experience_band':
            case 'update_experience_agent':
            case 'create_experience_agent':
                $posted_data = self::get_posted_data($args);
                return $posted_data;
            case 'delete_experience_musician_alone':
            case 'delete_experience_musician_bands':
            case 'delete_experience_band':
            case 'delete_experience_agent':
                return [];
            default:
                die('$form_mode-get_posted_data_on_mode_switch()');
        }
    }

    public static function get_posted_data($args) {
        $form_mode = $_POST['form_mode'];
        $fields = [];
        switch ($form_mode) {
            case 'update_experience_musician_alone':
            case 'create_experience_musician_alone':
                $fields = MusicianExperienceAlone::get_settings_fields();
                break;
            case 'update_experience_musician_bands':
            case 'create_experience_musician_bands':
                $fields = MusicianExperienceBand::get_settings_fields();
                break;
            case 'update_experience_band':
            case 'create_experience_band':
                $fields = BandExperience::get_settings_fields();
                break;
            case 'update_experience_agent':
            case 'create_experience_agent':
                $fields = AgentExperience::get_settings_fields();
                break;
            default:
                die('$form_mode-get_posted_data()');
        }
        return Post::get_settings_data_to_array($fields);
    }

    public static function get_all_to_array($fields, $table, $args) {
        $all = SharedRepository::select_multi_array($fields, $table, $args);
        return DataStructure::multi_array_to_simple_array($all);
    }

    public static function table_has_data($arg, $table) {
        if (!User::logged_in()) {
            return false;
        }
        global $session_user_id;
        $fields = [
            'id'
        ];
        $args = [
            $arg => $session_user_id
        ];
        $id = SharedRepository::select_exists($table, $fields, $args);

        if (empty($id)) {
            return false;
        }
        return true;
    }

}
