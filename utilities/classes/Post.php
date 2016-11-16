<?php

class Post {

    public static function check_post($name) {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return '';
    }

    public static function get_settings_data_to_array($fields) {
        $ret = [];
        foreach ($fields as $value) {
            $posted = self::check_post($value);
            $ret[$value] = $posted;
        }
        return $ret;
    }

    public static function get_errors_crud_page($args) {
        global $errors;
        $form_mode = '';

        if (!empty($_POST)) {
            $form_mode = $_POST['form_mode'];

            switch ($form_mode) {
                case $args['update_mode']:
                case $args['create_mode']:
                    $req_fields = $args['required_fields'];

//                    $zero = (int) 0;

                    foreach ($_POST as $key => $value) {
                        if ((empty($value) &&
                                in_array($key, $req_fields) === true) ||
                                self::has_location_but_not_posted($args['has_location'])) {
                            $errors[] = DataStructure::get_fields_required_message($args['non_required_fields']);
                            break;
                        }
                    }

                    if (empty($errors)) {
                        switch ($args['mode']) {
                            case 'experience':
                                foreach ($args['settings_fields'] as $key => $value) {
                                    $error = Experience::get_settings_field_error($value, $_POST[$value], $args['sub_mode']);
                                    if ($error != false) {
                                        $errors [] = $error;
                                    }
                                }
                                break;
                            default:
                                die('post-get_errors_crud_page');
                        }
                    }

                    break;
                case $args['delete_mode']:
                    break;
                default:
                    die('error passing form mode');
            }
        }
        return $errors;
    }

    public static function check_if($field) {
        if (isset($_POST[$field]) && !empty($_POST[$field])) {
            return true;
        }
        return false;
    }

    public static function region() {
        return self::check_if('region');
    }

    public static function country() {
        return self::check_if('country');
    }

    public static function city_state() {
        return self::check_if('city_state');
    }

    public static function location() {
        if (!self::region() || !self::country() || !self::city_state()) {
            return false;
        }
        return true;
    }

    public static function has_location_but_not_posted($has_location) {
        if (!$has_location) {
            return false;
        }
        if (!self::location()) {
            return true;
        }
        return false;
    }

    public static function form_req_fields_filled($req_fields, $non_req_fields) {
        $errors = [];
        foreach ($_POST as $key => $value) {
            if ((empty($value) && in_array($key, $req_fields) === true)) {
                $errors[] = DataStructure::get_fields_required_message($non_req_fields);
                break;
            }
        }
        return $errors;
    }

}
