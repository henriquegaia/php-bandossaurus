<?php

class Message {

    const LIMIT_MONTH = 1;
    const CONTENT_MAX_LENGHT = 400;

    private static $table = 'messages';
    private static $fillable_pk = [
        'id'
    ];
    private static $fillable_pt_1 = [
        'user_id_from',
        'user_id_to',
        'content',
        'created_at'
    ];

    public static function create($user_id_from, $user_id_to, $content) {
        if (strlen($content) > self::CONTENT_MAX_LENGHT) {
            return false;
        }

        if (!self::user_can_send()) {
            return false;
        }
        $data = [
            'user_id_from' => $user_id_from,
            'user_id_to' => $user_id_to,
            'content' => $content
        ];
        $val = SharedRepository::insert(self::$table, $data);
        if ($val == true) {
            return User::update_values_on_message($user_id_from);
        }
        return false;
    }

    public static function user_can_send() {
        if (!User::logged_in()) {
            return false;
        }
        if ((!User::is_premium()) && User::reached_limit_messages()) {
            return false;
        }
        return true;
    }

    public static function get_date($id) {
        $args = [
            'id' => $id,
        ];
        return SharedRepository::select_value(self::$table, ['created_at'], $args);
    }

    public static function all_sent() {
        global $session_user_id;
        $args = [
            'select' => [
                'messages.user_id_to',
                'messages.created_at',
                'messages.content',
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'messages'
                    ],
                    'on' => [
                        'messages.user_id_from = ' . $session_user_id,
                        'users.id = messages.user_id_from',
                    ],
                ],
            ],
            'order_by' => [
                'messages.created_at'
            ],
            'limit' => self::get_number_rows()
        ];
        $ret = SharedRepository::select_inner_join_on_order_by($args);
        return self::add_username($ret, 'user_id_to');
    }

    public static function all_received() {
        global $session_user_id;
        $args = [
            'select' => [
                'messages.user_id_from',
                'messages.created_at',
                'messages.content',
            ],
            'from' => [
                'users'
            ],
            'inner_join_on' => [
                0 => [
                    'inner_join' => [
                        'messages'
                    ],
                    'on' => [
                        'messages.user_id_to = ' . $session_user_id,
                        'users.id = messages.user_id_to',
                    ],
                ],
            ],
            'order_by' => [
                'messages.created_at'
            ],
            'limit' => self::get_number_rows()
        ];
        $ret = SharedRepository::select_inner_join_on_order_by($args);
        return self::add_username($ret, 'user_id_from');
    }

    public static function add_username($array, $user_type) {
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
            $ret[$key]['created_at'] = Age::get_friendly_date_from_timestamp($value['created_at']);
            $ret[$key]['role'] = $role;
            $ret[$key]['name'] = $name;
            $ret[$key]['username'] = $username;
        }
        return $ret;
    }

    public static function all() {
        $sent = self::all_sent();
        $received = self::all_received();
        $all = array_merge($sent, $received);
        $all_arranged = self::arrange_all_by_user_id($all);
        $all_ordered = self::sort_all_by_date_time($all_arranged);
        return $all_ordered;
    }

    public static function arrange_all_by_user_id($all) {
        $all_arranged = [];
        $users = [];
        foreach ($all as $key => $value) {
            if (array_key_exists('user_id_to', $value)) {
                $user_id = $value['user_id_to'];
            } else if (array_key_exists('user_id_from', $value)) {
                $user_id = $value['user_id_from'];
            }
            if (in_array($user_id, $users)) {
                $user_key = array_search($user_id, $users);
                array_push($all_arranged[$user_key][$user_id], $value);
            } else {
                $array = [
                    $user_id => [
                        $value
                    ]
                ];
                array_push($users, $user_id);
                array_push($all_arranged, $array);
            }
        }
        return $all_arranged;
    }

    public static function sort_all_by_date_time($all_arranged) {
        $all_ordered = [];
        foreach ($all_arranged as $key => $value) {
            foreach ($value as $messages_key => $messages) {
                $m = self::sort_user_messages_by_date_time($messages);
                $all_ordered[$key][$messages_key] = $m;
            }
        }
        return $all_ordered;
    }

    public static function sort_user_messages_by_date_time($messages) {
        usort($messages, function($a, $b) {
            $d1 = new DateTime($a['created_at']);
            $d2 = new DateTime($b['created_at']);
            if ($d1 == $d2) {
                return 0;
            }
            return ($d1 > $d2) ? 1 : -1;
        });
        return $messages;
    }

    public static function get_number_rows() {
        $field_return = 'id';
        return SharedRepository::select_count(self::$table, $field_return, []);
    }

}
