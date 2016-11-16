<?php

class Get {

    const SUCCESS_PARAM = 'success';
    const UNSUCCESS_PARAM = 'unsuccess';

    public static function pursuit_type() {
        $type = 'type';
        if (isset($_GET[$type]) && !empty($_GET[$type])) {
            if (array_key_exists($_GET[$type], Pursuit::get_all_types())) {
                return $_GET[$type];
            }
        }
        return false;
    }

}
