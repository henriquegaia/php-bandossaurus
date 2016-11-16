<?php

class User {

    private static $table = 'users';
    private static $fillable_pk = array(
        'id'
    );
    private static $fillable_pt_1 = array(
        'username',
        'password',
        'first_name',
        'email',
    );
    private static $fillable_pt_2 = array(
        'last_name',
        'email_code',
        'active',
        'password_recover',
        'type',
        'allow_email',
        'profile',
        'profile_img_name',
        'premium',
        'premium_begin',
        'premium_end',
        'first_failed_login',
        'failed_login_count',
        'is_locked'
    );

    /*
     * new stuff 
     */
    private static $fillable_pt_3 = array(
        'region',
        'country',
        'city_state'
    );
    private static $fillable_pt_4 = array(
        'phone_number',
        'last_activity',
        'last_login',
        'is_online',
        'created_at',
        'updated_at',
        'role',
        'invitation_count',
        'last_invitation',
        'message_count',
        'last_message'
    );
    private static $fillable_end = array(
        'other_details'
    );

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function generate($username, $role) {

        $data = [
            'username' => 'margaret_del_monte', //change-------
            'password' => '12345a',
            'first_name' => 'Maria', //change-------
            'last_name' => 'Del Monte', //change-------
            'email' => 'henriquebroculo@gmail.com',
            'email_code' => 'email_code',
            'region' => 'North America',
            'country' => 'United States',
            'city_state' => 'Wynot, NE', //change-------
            'role' => $role,
            'active' => 1,
        ];
        $val = self::register($data, true);
        return $val;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function generate_multiple($amount, $role) {
        $last_user_id = SharedRepository::select_max('id', self::$table);
        $next_user_id = $last_user_id + 1;
        foreach (range(1, $amount) as $i) {
            $username = 'user_' . $next_user_id;
            self::generate($username, $role);
            $next_user_id++;
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_table_columns() {
        return array_merge(
                self::$fillable_pk, self::$fillable_pt_1, self::$fillable_pt_2, self::$fillable_pt_3, self::$fillable_pt_4, self::$fillable_end);
    }

    public static function get_location_field_names() {
        return self::$fillable_pt_3;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_register_required_fields() {
        return array_merge(self::$fillable_pt_1, self::$fillable_pt_2);
    }

    public static function get_settings_required_fields() {
        $fillable_pt_1_part = [self::$fillable_pt_1[2], self::$fillable_pt_1[3]];
        return array_merge($fillable_pt_1_part, self::$fillable_pt_3);
    }

    public static function get_settings_fields() {
        return [
            'first_name',
            'last_name',
            'email',
            'region',
            'country',
            'city_state'
        ];
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function brute_force_attack($username) {
        $first_failed_login = self::select_value('first_failed_login', 'username', $username);
        $failed_login_count = self::select_value('failed_login_count', 'username', $username);

        if ($first_failed_login == 0) {
            $first_failed_login = time();
        }
        $failed_login_count++;
        $time_from_first_fail = self::get_time_dif_from_first_failed_login_seconds($username);

        if (($failed_login_count >= Security::BAD_LOGIN_LIMIT_TRIES) &&
                ($time_from_first_fail <= Security::BAD_LOGIN_LIMIT_TIME)) {
            //update user table to zeros
            self::reset_login_security_cols_to_zero($username);
            self::update_set('is_locked', 1, 'username', $username);
            //log attack info
            $error_txt = $username;
            File::write_error_to_file('brute_force', $error_txt);
            return true;
        } else {
            //update user table to present values
            self::update_set('failed_login_count', $failed_login_count, 'username', $username);
            if ($failed_login_count == 1) {
                SharedRepository::update_set_time_now(self::$table, 'first_failed_login', 'username', $username);
            } else if ($time_from_first_fail > Security::BAD_LOGIN_LIMIT_TIME) {
                self::reset_login_security_cols_to_zero($username);
            }

            return false;
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function reset_login_security_cols_to_zero($username) {
        self::update_set('first_failed_login', 'NOW()', 'username', $username);
        self::update_set('failed_login_count', 0, 'username', $username);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_time_dif_from_first_failed_login_seconds($username) {
        $first_failed_login = self::select_value('first_failed_login', 'username', $username);
        $time_first_failed_login = strtotime($first_failed_login);
        return intval((time() - $time_first_failed_login) - 3600);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_type() {
        global $session_user_id;
        if (self::logged_in()) {
            if (self::has_access($session_user_id, 0) === true) {
                return 'Regural account ';
            } else if (self::has_access($session_user_id, 1) === true) {
                return 'Admin account ';
            } else if (self::has_access($session_user_id, 2) === true) {
                return 'Moderator account ';
            }
        } else {
            return 'No user logged in';
        }
    }

    /*
     * **************************************************
     * Not Checked
     * **************************************************
     */

    public static function get_profile_image($class) {
        global $config;
        if (empty($user_data['profile']) === false) {
            $filepath = $config['url']['images/profile'] . '/' . $user_data['profile_img_name'];
            echo '<img class = ', $class, 'src = "', $filepath, '" alt = "y-profile image">';
        } else {
            echo '<img class = ', $class, 'src = "', $config['url']['images/profile'], '/default.gif', '" alt = "n-profile image">';
        }
    }

    /*
     * **************************************************
     * Checked
     * 
     * Only 1 field
     * Only 1 arg
     * **************************************************
     */

    public static function update_set($field, $field_value, $arg, $arg_value) {
        $data_to_set = [
            $field => $field_value
        ];
        $args = [
            $arg => $arg_value
        ];

        return SharedRepository::update_set(self::$table, $data_to_set, $args);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function change_profile_image($user_id, $file_temp, $file_extn) {
        global $config;
        $basepath = $config['dir']['profile'];
        $filename = substr(md5(time()), 0, 10);
        $filename_extn = $filename . '.' . $file_extn;
        $file_path = $basepath . '/' . $filename_extn;
        move_uploaded_file($file_temp, $file_path);

        self::update_set('profile', $file_path, 'id', $user_id);

        /*
         * ****************************************************
         * this part was necessary otherwise the image would not be displayed
         * ****************************************************
         */
        self::update_set('profile_img_name', $filename_extn, 'id', $user_id);
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function mail_all($subject, $body) {
        $fields = [
            'email',
            'first_name'
        ];
        $args = [
            'allow_email' => 1,
        ];

        $result = SharedRepository::select_array_fetch_array(self::$table, $fields, $args);

        while ($row = mysqli_fetch_array($result)) {
            $emailRecipient = $row['email'];
            $message = "Hello " . $row['first_name'] . ",\n\n" . $body;
            Email::send($emailRecipient, $subject, $message);
        }
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function recover($mode, $email) {
        $user_id = self::get_id_from_email($email);
        $user_data = self::get_data($user_id, ['id', 'first_name', 'username']);
        $first_name = $user_data['first_name'];
        $username = $user_data['username'];

        if ($mode == 'username') {
            $message = Email::get_message_for_recovery($first_name, $username, 'username');
            $subject = Email::get_email_subject_for_recovery('username');
        } else if ($mode == 'password') {
            $generated_password = substr(md5(rand(999, 999999)), 0, 14);
            self::change_password($user_data['id'], $generated_password);
            $update_array = array('password_recover' => '1');
            self::update($user_data['id'], $update_array);
            $message = Email::get_message_for_recovery($first_name, $generated_password, 'new password');
            $subject = Email::get_email_subject_for_recovery('password');
        }
        $result = Email::send($email, $subject, $message);
        if ($result === true) {
            self::update_set('is_locked', 0, 'username', $username);
        }
        return $result;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function update($user_id, $update_data) {
        $args = [
            'id' => $user_id
        ];
        $val = SharedRepository::update_set(self::$table, $update_data, $args);
        if ($val == true) {
            SharedRepository::update_set_time_now(self::$table, 'updated_at', 'id', $user_id);
        }
        return $val;
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function activate($email, $email_code) {
//        $args = [
//            'email' => $email,
//            'email_code' => $email_code,
//            'active' => 0
//        ];
//
//        $num_users = SharedRepository::select_count(self::$table, 'id', $args);
//        if ($num_users == 1) {
//            return self::update_set('active', 1, 'email', $email);
//        }
//        return false;
        $data_to_set = [
            'active' => 1
        ];
        $args = [
            'email' => $email,
            'email_code' => $email_code,
        ];
        return SharedRepository::update_set(self::$table, $data_to_set, $args);
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function change_password($session_user_id, $password_posted) {
        $user_id = (int) $session_user_id;
        $password = Security::encrypte_password($password_posted);
        $data_to_set = [
            'password' => $password,
            'password_recover' => 0
        ];

        $args = [
            'id' => $user_id
        ];

        return SharedRepository::update_set(self::$table, $data_to_set, $args);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function register($register_data, $is_dummy) {
        $email_successful = Email::send_activation_account_email($register_data);
        if ($email_successful === true) {
            return self::create($register_data, $is_dummy);
        }
        return false;
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function create($register_data, $is_dummy) {
        $username = $register_data['username'];
        $register_data['password'] = Security::encrypte_password($register_data['password']);
        $val = SharedRepository::insert(self::$table, $register_data);
        if ($val == true) {
            SharedRepository::update_set_time_now(self::$table, 'created_at', 'username', $username);
            /////////////////////////////            
            //add new musician/band/agent to respective table
            /////////////////////////////
            $role = $register_data['role'];
            $val = Role::create($role, $username, $is_dummy);
            if ($is_dummy == true) {
                if ($val == true) {
                    /////////////////////////////
                    //create pursuit
                    /////////////////////////////
                    $user_id = self::get_id_from_username($username);
                    $dummy_pursuit = Pursuit::generate_data($role);
                    return Pursuit::create($dummy_pursuit, $user_id);
                }
            } else {
                return $val;
            }
        }
        return false;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function count_active() {
        $fields = [
            'id'
        ];
        $args = [
            'active' => 1
        ];
        return SharedRepository::select_count(self::$table, $fields, $args);
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function get_data($user_id, $fields) {
        $data = [];
        $user_id = (int) $user_id;
        if (sizeof($fields) > 0) {
            $args = [
                'id' => $user_id
            ];
            $data = SharedRepository::select_array_fetch_assoc(self::$table, $fields, $args);
        }
        return $data;
    }

    public static function get_id() {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        } else {
            return false;
        }
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function get_all_data($user_id) {
        return self::get_data($user_id, self::get_table_columns());
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function logged_in() {
        if (isset($_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function online_by_username($username) {
        $val = SharedRepository::select_value(self::$table, ['is_online'], ['username' => $username]);
        if ($val == 1) {
            return true;
        }
        return false;
    }

    /*
     * **************************************************
     * Checked
     * 
     * Only 1 field
     * Only 1 arg
     * **************************************************
     */

    public static function select_exists($field, $arg_name, $arg_value) {
        $fields = [
            $field
        ];

        $args = [
            $arg_name => $arg_value,
        ];
        return SharedRepository::select_exists(self::$table, $fields, $args);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function has_access($user_id, $type) {
        $user_id = (int) $user_id;
        $type = (int) $type;
        $fields = [
            'id'
        ];
        $args = [
            'id' => $user_id,
            'type' => $type
        ];
        return SharedRepository::select_exists(self::$table, $fields, $args);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function exists($username) {
        return self::select_exists('id', 'username', $username);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function email_exists($email) {
        return self::select_exists('id', 'email', $email);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function active($username) {
        $fields = [
            'id',
        ];

        $args = [
            'username' => $username,
            'active' => 1
        ];
        return SharedRepository::select_exists(self::$table, $fields, $args);
    }

    /*
     * **************************************************
     * Checked
     * 
     * Only 1 field
     * Only 1 arg
     * **************************************************
     */

    public static function select_value($field, $arg_name, $arg_value) {
        $fields = [
            $field
        ];

        $args = [
            $arg_name => $arg_value,
        ];

        return SharedRepository::select_value(self::$table, $fields, $args);
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function locked($username) {
        return self::select_value('is_locked', 'username', $username);
    }

    /*
     * **************************************************
     * Checked 
     * **************************************************
     */

    public static function get_id_from_email($email) {
        return self::select_value('id', 'email', $email);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_id_from_username($username) {
        return self::select_value('id', 'username', $username);
    }

    public static function get_role_from_username($username) {
        return self::select_value('role', 'username', $username);
    }

    public static function get_role_from_id($id) {
        return self::select_value('role', 'id', $id);
    }

    public static function get_first_name($id) {
        return self::select_value('first_name', 'id', $id);
    }

    public static function get_last_name($id) {
        return self::select_value('last_name', 'id', $id);
    }

    public static function get_full_name($id) {
        $fname = self::get_first_name($id);
        $lname = self::get_last_name($id);
        return $fname . ' ' . $lname;
    }

    public static function get_username($id) {
        return self::select_value('username', 'id', $id);
    }

    public static function get_invitations_count() {
        global $session_user_id;
        return self::select_value('invitation_count', 'id', $session_user_id);
    }

    public static function get_last_invitation() {
        global $session_user_id;
        return self::select_value('last_invitation', 'id', $session_user_id);
    }

    public static function get_messages_count() {
        global $session_user_id;
        return self::select_value('message_count', 'id', $session_user_id);
    }

    public static function get_last_message() {
        global $session_user_id;
        return self::select_value('last_message', 'id', $session_user_id);
    }

    public static function get_email_from_id($id) {
        return self::select_value('email', 'id', $id);
    }
    
    public static function get_username_from_email($email) {
        return self::select_value('username', 'email', $email);
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function login($username, $password) {
        $conn = MySQLiConnection::connect();
        $password = Security::sanitize($conn, $password);
        $user_id = self::get_id_from_username($username);
        $password_db = self::select_value('password', 'id', $user_id);
        if (!empty($password_db)) {

            if (password_verify($password, $password_db)) {
                SharedRepository::update_set_time_now(self::$table, 'last_login', 'username', $username);
                $data_to_set = [
                    'is_online' => 1
                ];
                $args = [
                    'username' => $username
                ];
                SharedRepository::update_set(self::$table, $data_to_set, $args);
                return $user_id;
            }
        }

        return false;
    }

    public static function logout($user_id) {
        $data_to_set = [
            'is_online' => 0
        ];
        $args = [
            'id' => $user_id
        ];
        return SharedRepository::update_set(self::$table, $data_to_set, $args);
    }

    public static function get_value($field) {
        if (self::logged_in()) {
            global $user_data;
            return $user_data[$field];
        }
        return false;
    }

    public static function profile_to_array() {
        global $user_data;
        return [
            'first name' => $user_data['first_name'],
            'last name' => $user_data['last_name'],
            'email' => $user_data['email'],
            'allow email' => Presentation::bool_to_string($user_data['allow_email']),
            'premium' => Presentation::bool_to_string(self::is_premium()),
            'premium end' => self::premium_end_to_string(),
            'region' => $user_data['region'],
            'country' => $user_data['country'],
            'city / state' => $user_data['city_state'],
            'created at' => $user_data['created_at'],
            'updated at' => $user_data['updated_at'],
            'role' => $user_data['role']
        ];
    }

    public static function premium_end_to_string() {
        if (self::is_premium() == false) {
            return '-';
        }
        $end = self::get_premium_end();
        if ($end == 0) {
            return '-';
        }
        $now = date(Validation::DATE_FORMAT);
        if ($now > $end) {
            return '-';
        }
        return $end;
    }

    public static function profile_to_array_by_id($id) {
        $user_data = self::get_data($id, self::get_table_columns());
        $is_online = self::is_online_to_string($user_data['is_online']);
        return [
            'first name' => $user_data['first_name'],
            'last name' => $user_data['last_name'],
            'region' => $user_data['region'],
            'country' => $user_data['country'],
            'city / state' => $user_data['city_state'],
//            'is online' => $is_online,
        ];
    }

    private static function is_online_to_string($is_online) {
        if ($is_online == 0) {
            return 'No';
        }
        return 'Yes';
    }

    public static function update_field_updated_at($user_id) {
        return SharedRepository::update_set_time_now(self::$table, 'updated_at', 'id', $user_id);
    }

    public static function get_table_name() {
        return self::$table;
    }

    public static function get_role() {
        if (self::logged_in()) {
            global $role;
            return $role;
        }
        return false;
    }

    public static function get_region() {
        if (self::logged_in()) {
            $id = self::get_id();
            return self::select_value('region', 'id', $id);
        }
        return false;
    }

    public static function get_country() {
        if (self::logged_in()) {
            $id = self::get_id();
            return self::select_value('country', 'id', $id);
        }
        return false;
    }

    public static function get_city_state() {
        if (self::logged_in()) {
            $id = self::get_id();
            return self::select_value('city_state', 'id', $id);
        }
        return false;
    }

    public static function is_premium() {
        if (self::logged_in() == false) {
            return false;
        }
        if (self::premium_is_1()) {
            return true;
        }
        return self::premium_end_is_after_than_now();
    }

    public static function premium_is_1() {
        if (self::logged_in() == false) {
            return false;
        }
        global $session_user_id;
        $args = [
            'premium' => 1,
            'id' => $session_user_id
        ];
        $is_premium = SharedRepository::select_exists(self::$table, ['id'], $args);
        if ($is_premium != 1) {
            return false;
        }
        return true;
    }

    public static function set_premium_end($date) {
        if (self::logged_in() == false) {
            return false;
        }
        global $session_user_id;
        return SharedRepository::update_set(self::$table, ['premium_end' => $date], ['id' => $session_user_id]);
    }

    public static function set_premium_begin() {
        if (self::logged_in() == false) {
            return false;
        }
        global $session_user_id;
        return SharedRepository::update_set_time_now(self::$table, 'premium_begin', 'id', $session_user_id);
    }

    public static function get_premium_end() {
        return self::get_premium_date('premium_end');
    }

    public static function premium_end_is_after_than_now() {
        if (self::logged_in() == false) {
            return false;
        }
        $end = self::get_premium_end();
        if ($end == 0) {
            return false;
        }
        $now = date(Validation::DATE_FORMAT);
        if ($now > $end) {
            return false;
        }
        return true;
    }

    public static function get_premium_begin() {
        return self::get_premium_date('premium_begin');
    }

    public static function get_premium_date($field) {
        if (self::logged_in() == false) {
            return false;
        }
        global $session_user_id;
        return SharedRepository::select_value(self::$table, [$field], ['id' => $session_user_id]);
    }

    public static function revoke_premium() {
        if (self::premium_is_1() == false) {
            return false;
        }
        global $session_user_id;
        return SharedRepository::update_set(self::$table, ['premium' => 0], ['id' => $session_user_id]);
    }

    public static function become_premium() {
        if (self::logged_in() == false) {
            return false;
        }
        global $session_user_id;
        if (SharedRepository::update_set(self::$table, ['premium' => 1], ['id' => $session_user_id]) == false) {
            return false;
        }
        return SharedRepository::update_set_time_now(self::$table, 'premium_begin', 'id', $session_user_id);
    }

    public static function different_than_logged_in($username) {
        global $session_user_id;
        $user_2_id = self::get_id_from_username($username);
        if ($user_2_id == $session_user_id) {
            return false;
        }
        return true;
    }

    public static function can_search_by_proximity() {
        if (User::is_premium()) {
            $user_country = self::get_country();
            return Location::country_has_coordinates($user_country);
        }
        return false;
    }

    public static function reached_limit_invitations() {
        if (User::is_premium()) {
            return false;
        }
        $last = self::get_last_invitation();
        if ($last == 0) {
            return false;
        }
        $count = self::get_invitations_count();
        if ($count >= Invitation::LIMIT_MONTH && Age::same_year_and_month($last)) {
            return true;
        }
        return false;
    }

    public static function reached_limit_messages() {
        if (User::is_premium()) {
            return false;
        }
        $last = self::get_last_message();
        if ($last == 0) {
            return false;
        }
        $count = self::get_messages_count();
        if ($count >= Message::LIMIT_MONTH && Age::same_year_and_month($last)) {
            return true;
        }
        return false;
    }

    public static function update_values_on_invitation($user_id_from) {
        $table = self::$table;
        $last_invitation = SharedRepository::select_value($table, ['last_invitation'], ['id' => $user_id_from]);
        $new_count = 0;
        if (Age::same_year_and_month($last_invitation) == true) {
            $cont = SharedRepository::select_value($table, ['invitation_count'], ['id' => $user_id_from]);
            $new_count = $cont + 1;
        } else {
            $new_count = 1;
        }

        $data = ['invitation_count' => $new_count];
        $args = ['id' => $user_id_from];
        if (SharedRepository::update_set($table, $data, $args) == true) {
            return SharedRepository::update_set_time_now($table, 'last_invitation', 'id', $user_id_from);
        }
        return false;
    }

    public static function update_values_on_message($user_id_from) {
        $table = self::$table;
        $last_message = SharedRepository::select_value($table, ['last_message'], ['id' => $user_id_from]);
        $new_count = 0;
        if (Age::same_year_and_month($last_message) == true) {
            $cont = SharedRepository::select_value($table, ['message_count'], ['id' => $user_id_from]);
            $new_count = $cont + 1;
        } else {
            $new_count = 1;
        }

        $data = ['message_count' => $new_count];
        $args = ['id' => $user_id_from];
        if (SharedRepository::update_set($table, $data, $args) == true) {
            return SharedRepository::update_set_time_now($table, 'last_message', 'id', $user_id_from);
        }
        return false;
    }

    public static function get_musician_id($user_id_1, $user_id_2) {
        return User::get_role_id($user_id_1, $user_id_2, 'musician');
    }

    public static function get_band_id($user_id_1, $user_id_2) {
        return User::get_role_id($user_id_1, $user_id_2, 'band');
    }

    public static function get_agent_id($user_id_1, $user_id_2) {
        return User::get_role_id($user_id_1, $user_id_2, 'agent');
    }

    public static function get_role_id($user_id_1, $user_id_2, $role) {
        $role_1 = User::get_role_from_id($user_id_1);
        $role_2 = User::get_role_from_id($user_id_2);
        $role_1_real = User::get_role_from_id($user_id_1);
        $role_2_real = User::get_role_from_id($user_id_2);
        if (strcasecmp($role_1, $role_1_real) == 0 && strcasecmp($role_1, $role) == 0) {
            return $user_id_1;
        } else if (strcasecmp($role_2, $role_2_real) == 0 && strcasecmp($role_2, $role) == 0) {
            return $user_id_2;
        } else {
            return false;
        }
    }

    public static function musician_and_band($role_1, $role_2) {
        return self::role_1_and_role_2($role_1, $role_2, 'musician', 'band');
    }

    public static function musician_and_agent($role_1, $role_2) {
        return self::role_1_and_role_2($role_1, $role_2, 'musician', 'agent');
    }

    public static function band_and_agent($role_1, $role_2) {
        return self::role_1_and_role_2($role_1, $role_2, 'band', 'agent');
    }

    public static function role_1_and_role_2($role_1, $role_2, $role_1_txt, $role_2_txt) {
        if ((strcasecmp($role_1, $role_1_txt) == 0 && strcasecmp($role_2, $role_2_txt) == 0) ||
                (strcasecmp($role_1, $role_2_txt) == 0 && strcasecmp($role_2, $role_1_txt) == 0)) {
            return true;
        }
        return false;
    }

    public static function get_profile_completeness() {
        if (!self::logged_in()) {
            return false;
        }
        $n_fac = 4;
        $ret = 1 / $n_fac;
        $each = $ret;
        if (self::role_table_has_data()) {
            $ret = $ret + $each;
        }
        if (self::role_exp_table_has_data()) {
            $ret = $ret + $each;
        }
        if (self::has_data_in_pursuit_table()) {
            $ret = $ret + $each;
        }
        return $ret;
    }

    public static function role_table_has_data() {
        if (!self::logged_in()) {
            return false;
        }
        $role = self::get_role();
        switch ($role) {
            case 'musician':
                return Musician::table_has_data();
            case 'band':
                return Band::table_has_data();
            case 'agent':
                return Agent::table_has_data();
        }
    }

    public static function role_exp_table_has_data() {
        if (!self::logged_in()) {
            return false;
        }
        $role = self::get_role();
        switch ($role) {
            case 'musician':
                if (MusicianExperienceAlone::table_has_data() == false) {
                    return MusicianExperienceBand::table_has_data();
                }
                return true;
            case 'band':
                return BandExperience::table_has_data();
            case 'agent':
                return AgentExperience::table_has_data();
        }
    }

    public static function has_data_in_pursuit_table() {
        if (!self::logged_in()) {
            return false;
        }
        return Pursuit::table_has_data();
    }

}
