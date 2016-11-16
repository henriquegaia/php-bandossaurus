<?php

class Invitation {

    const LIMIT_MONTH = 1;

    private static $table = 'invitations';
    private static $fillable_pk = [
        'id'
    ];
    private static $fillable_pt_1 = [
        'user_id_from',
        'user_id_to',
        'created_at'
    ];

    /*
     * case 1: premium  - no limit
     * case 2: normal   - didn't reaach limit
     * case 3: notmal   - reached limit
     */

    public static function create($user_id_from, $user_id_to) {
        $data = [
            'user_id_from' => $user_id_from,
            'user_id_to' => $user_id_to,
        ];
        $val = SharedRepository::insert(self::$table, $data);
        if ($val == true) {
            User::update_values_on_invitation($user_id_from);
            if (User::is_premium()) {
                $email = User::get_email_from_id($user_id_to);
                $username_from = User::get_username($user_id_from);
                $username_to = User::get_username($user_id_to);
                $subject = 'invitation from ' . $username_from;
                $message = Email::get_message_for_invitation($username_from, $username_to);

                return Email::send($email, $subject, $message);
            }
        }
        return false;
    }

    public static function all_sent() {
        global $session_user_id;
        $args = [
            'select' => [
                'invitations.user_id_to',
                'invitations.created_at',
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'invitations'
                    ],
                    'on' => [
                        'invitations.user_id_from = ' . $session_user_id,
                        'users.id = invitations.user_id_from',
                    ],
                ],
            ],
            'order_by' => [
                'invitations.created_at'
            ],
            'limit' => self::get_number_rows()
        ];
        $ret = SharedRepository::select_inner_join_on_order_by($args);
        return self::replace_user_id_by_name($ret, 'user_id_to');
    }

    public static function all_received() {
        global $session_user_id;
        $args = [
            'select' => [
                'invitations.user_id_from',
                'invitations.created_at',
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'invitations'
                    ],
                    'on' => [
                        'invitations.user_id_to = ' . $session_user_id,
                        'users.id = invitations.user_id_to',
                    ],
                ],
            ],
            'order_by' => [
                'invitations.created_at'
            ],
            'limit' => self::get_number_rows()
        ];
        $ret = SharedRepository::select_inner_join_on_order_by($args);
        return self::replace_user_id_by_name($ret, 'user_id_from');
    }

    public static function replace_user_id_by_name($array, $user_type) {
        global $config;
        $ret = $array;
        foreach ($ret as $key => $value) {
            $user_id = $value[$user_type];
            $username = User::get_username($user_id);
            $role = User::get_role_from_id($user_id);
            $name = '';
            if ($role == 'band') {
                $name = Band::get_band_name($user_id);
            } else {
                $name = User::get_full_name($user_id);
            }
            unset($ret[$key][$user_type]);
            $href = $config['file']['check_user_profile'] . '?username=' . $username;
            $ret[$key]['created_at'] = Age::get_friendly_date_from_timestamp($value['created_at']);
            $ret[$key]['name'] = '<a href="' . $href . '">' . $name . '<a>';
            $ret[$key]['role'] = $role;
        }
        return $ret;
    }

    public static function exists($user_id_from, $user_id_to) {
        $args = [
            'user_id_from' => $user_id_from,
            'user_id_to' => $user_id_to
        ];
        return SharedRepository::select_exists(self::$table, ['id'], $args);
    }

    public static function get_date_created($id) {
        $args = [
            'id' => $id,
        ];
        return SharedRepository::select_value(self::$table, ['created_at'], $args);
    }

    public static function get_id($user_id_from, $user_id_to) {
        $args = [
            'user_id_from' => $user_id_from,
            'user_id_to' => $user_id_to
        ];
        return SharedRepository::select_value(self::$table, ['id'], $args);
    }

    public static function get_number_rows() {
        $field_return = 'id';
        return SharedRepository::select_count(self::$table, $field_return, []);
    }

}
