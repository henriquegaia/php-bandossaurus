<?php

class Presentation {

    public static function get_div_info_user_is_invited($user, $date) {
        ?>
        <div class="user_has_been_invited">
            You have invited <?php echo $user; ?> to work with you at <?php echo $date; ?>.
        </div>
        <?php
    }

    public static function get_div_chat_area($username) {
        global $config;
        ?>
        <div class="chat_container">
        </div>
        <?php
    }

    public static function get_button_send_invitation($to) {
        global $config;
        include $config['file']['input_token_csrf'];
        ?>
        <form action="" method="post">
            <input name="useless_lbl_invitation" type="hidden">
            <input
                class="btn_send_invitation"
                type="submit"
                value="invite <?php echo $to; ?> to work with you"
                >
        </form>
        <?php
    }

    public static function get_div_no_results() {
        ?>
        <br>
        <div class="no_results">No results</div>
        <?php
    }

    public static function success_message() {
        $text = Presentation::get_success_update_message();
        Presentation::print_success_message($text);
    }

    public static function failure_message() {
        $text = Presentation::get_failure_update_message();
        Presentation::print_failure_message($text);
    }

    public static function get_success_update_message() {
        return 'Your data has been updated.';
    }

    public static function get_failure_update_message() {
        return '<p>Something went wrong while updating the information.</p>'
                . '<p>Could you please try again later?</p>'
                . '<p>Sorry for the inconvenient.</p>';
    }

    public static function get_settings_mode_title($title) {
        ?>
        <div class="separator form-title">
            <?php
            echo $title;
            ?>
        </div>
        <?php
    }

    public static function print_page_title($text) {
        ?>
        <div class="separator page-title">
            <?php
            echo $text;
            ?>
        </div>
        <?php
    }

    public static function print_separator($text) {
        ?>
        <div class="separator sep-info">
            <?php
            echo $text;
            ?>
        </div>
        <?php
    }

    public static function print_success_message($text) {
        ?>
        <div class="separator sep-success">
            <?php
            echo $text;
            ?>
        </div>
        <?php
    }

    public static function print_failure_message($text) {
        ?>
        <div class="separator sep-failure">
            <?php
            echo $text;
            ?>
        </div>
        <?php
    }

    public static function print_no_data_message($text) {
        ?>
        <div class="separator sep-info">
            <?php
            echo $text;
            ?>
        </div>
        <?php
    }

    public static function print_2d_table_if_has_data($data) {
        if (sizeof($data) > 0) {
            self::get_array_2d_to_table($data, false);
        } else {
            return false;
        }
    }

    public static function print_message_if_no_data($rows, $text) {
        if ($rows == 0) {
            self::print_no_data_message($text);
        }
    }

    public static function print_failure_message_array($array) {
        return self::print_separator(self::output_errors($array));
    }

    public static function bool_to_string($bool) {
        if ($bool == 1) {
            return 'yes';
        }
        return 'no';
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function print_array($array) {
        echo '<pre>', print_r($array, true), '</pre>';
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function print_array_2d($array) {
        foreach ($array as $arr) {
            echo 'size: ' . sizeof($arr) . '<br>';
            self::print_array($arr);
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_registration_separator($text) {
        ?>
        <br>
        <li>
            <label></label>
            <b><?php echo $text; ?></b>
        </li>
        <br>
        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    private static function get_value_by_populating($mode, $tag_name) {
        switch ($mode) {
            case 'settings':
                echo self::populate_field_settings($tag_name);
                break;
            default:
                echo self::populate_field($tag_name, '');
                break;
        }
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_label_and_input_date($input_name, $label_txt, $min, $max, $is_birth, $mode) {
        global $config;
        $status_id = $input_name . '_status_' . Random::integer();
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <input type="date" 
                   placeholder="yyyy-mm-dd"
                   name="<?php echo $input_name; ?>" 
                   value="<?php self::get_value_by_populating($mode, $input_name); ?>"
                   id="<?php echo $input_name; ?>"
                   value="<?php self::populate_field($input_name, ''); ?>"
                   onkeyup="validate_date(this.value, '<?php echo $min; ?>', '<?php echo $max; ?>', '<?php echo $status_id; ?>', '<?php echo $is_birth; ?>');" 
                   onchange="validate_date(this.value, '<?php echo $min; ?>', '<?php echo $max; ?>', '<?php echo $status_id; ?>', '<?php echo $is_birth; ?>');"
                   onblur="validate_date(this.value, '<?php echo $min; ?>', '<?php echo $max; ?>', '<?php echo $status_id; ?>', '<?php echo $is_birth; ?>');"/>
                   <?php self::show_form_field_status($status_id, $mode); ?>
        </li>
        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_label_and_input_txt($input_name, $label_txt, $pre_fill, $regex, $mode) {
        global $config, $user_data;
        $status_id = $input_name . '_status_' . Random::integer();
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <input type="text" 
                   name="<?php echo $input_name; ?>"
                   value="<?php self::get_value_by_populating($mode, $input_name); ?>"
                   id="<?php echo $input_name; ?>"
                   onkeyup="validate_input(this.value, <?php echo $regex; ?>, '<?php echo $status_id; ?>');" 
                   onblur="validate_input(this.value,<?php echo $regex; ?>, '<?php echo $status_id; ?>');"/>
                   <?php
                   self::show_form_field_status($status_id, $mode);
                   ?>
        </li>
        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_label_and_input_password($input_name, $label_txt, $pre_fill, $regex, $mode, $use_js_validation, $is_repeated, $elem_name_to_compare) {
        global $config, $user_data;
        $status_id = $input_name . '_status_' . Random::integer();
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <input type="password" 
                   name="<?php echo $input_name; ?>"
                   value="<?php self::get_value_by_populating($mode, $input_name); ?>"
                   id="<?php echo $input_name; ?>"
                   <?php
                   if ($is_repeated == true) {
                       ?>
                       onkeyup="validate_password_again(this.value, '<?php echo $status_id; ?>', '<?php echo $elem_name_to_compare; ?>');" 
                       onblur="validate_password_again(this.value, '<?php echo $status_id; ?>', '<?php echo $elem_name_to_compare; ?>');"
                       <?php
                   } else {
                       ?>
                       onkeyup="validate_password(this.value, <?php echo $regex; ?>, '<?php echo $status_id; ?>');" 
                       onblur="validate_password(this.value,<?php echo $regex; ?>, '<?php echo $status_id; ?>');"
                       <?php
                   }
                   echo '/>';
                   if ($use_js_validation == true) {
                       echo ' ';
                       self::show_form_field_status($status_id, $mode);
                   }
                   ?>
        </li>
        <?php
    }

    /*
     * **************************************************
     * Not Checked
     * **************************************************
     */

    public static function get_label_and_empty_text_area($txt_area_name, $label_txt, $regex_name, $rows, $cols, $max_length, $mode) {
        $status_id = $txt_area_name . '_status_' . Random::integer();
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <textarea 
                maxlength="<?php echo $max_length; ?>"
                placeholder="max length is <?php echo $max_length; ?> characters"
                value="<?php self::populate_field($txt_area_name, ''); ?>"
                rows="<?php echo $rows; ?>" 
                cols="<?php echo $cols; ?>"
                type="text" 
                name="<?php echo $txt_area_name; ?>" 
                id="<?php echo $txt_area_name; ?>"
                onkeyup="validate_txt_area(this.value, '<?php echo $regex; ?>', '<?php echo $status_id; ?>');" 
                onblur="validate_txt_area(this.value, '<?php echo $regex; ?>', '<?php echo $status_id; ?>');"/>
        </textarea>

        <?php self::show_form_field_status($status_id, $mode); ?>
        </li>
        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_label_and_arr_fil_select($select_name, $arr, $label_txt, $mode) {
        $status_id = $select_name . '_status_' . Random::integer();
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <?php self::get_arr_fil_select($select_name, $arr, $status_id); ?>
            <?php self::show_form_field_status($status_id, $mode); ?>
        </li>
        <?php
    }

    public static function get_arr_fil_select($select_name, $arr, $status_id) {
        ?>
        <select 
            name="<?php echo $select_name; ?>"
            id="<?php echo $select_name; ?>"
            onkeyup="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>');" 
            onchange="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>');"
            onblur="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>');">
            <option value=""></option>
            <?php
            foreach ($arr as $value) {
                ?>
                <option value="<?php echo $value; ?>" <?php echo self::populate_select($select_name, $value); ?>><?php echo $value; ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_label_and_arr_role_select($select_name, $arr, $label_txt, $mode) {
        $size = sizeof($arr);
        $status_id = $select_name . '_status_' . Random::integer();
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <select 
                name="<?php echo $select_name; ?>"
                id="<?php echo $select_name; ?>"
                onkeyup="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);" 
                onchange="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);"
                onblur="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);">
                <option value=""></option>
                <?php
                foreach ($arr as $key => $value) {
                    ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                }
                ?>
            </select>
            <?php self::show_form_field_status($status_id, $mode); ?>
        </li>

        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

//role,numeric,fil
    public static function get_label_and_numeric_select($select_name, $label_txt, $begin, $end, $mode) {
        $status_id = $select_name . '_status_' . Random::integer();
        $selected_value = self::get_selected_value($select_name);
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <?php self::get_numeric_select($select_name, $begin, $end, $status_id); ?>
            <?php self::show_form_field_status($status_id, $mode); ?>
        </li>
        <?php
    }

    public static function get_numeric_select($select_name, $begin, $end, $status_id) {
        ?>
        <select 
            name="<?php echo $select_name; ?>"
            id="<?php echo $select_name; ?>"
            onkeyup="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);" 
            onchange="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);"
            onblur="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);">
            <option value=""></option>
            <?php
            for ($i = $begin; $i <= $end; $i++) {
                if ($i != 0) {
                    ?>
                    <option value="<?php echo $i; ?>" <?php echo self::populate_select($select_name, $i); ?>><?php echo $i; ?></option>
                    <?php
                } else {
                    ?>
                    <option value="<?php echo 'None'; ?>" <?php echo self::populate_select($select_name, $i); ?>><?php echo 'None'; ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <?php
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_settings_table_options($args, $relations) {
        ?>
        <ul>
            <?php
            self::get_label_and_select_alter_table_row($args['update_id'], $relations, $args['update_text']);
            self::get_label_and_select_alter_table_row($args['delete_id'], $relations, $args['delete_text']);
            self::get_label_and_button_insert_table_row($args['create_id'], $args['create_text'], '');
            ?>
        </ul>
        <?php
    }

    public static function get_members_settings_options($relations) {
        ?>
        <ul>
            <?php
            self::get_label_and_select_alter_table_row('update_band_member', $relations, 'Update Row Number');
            self::get_label_and_select_alter_table_row('delete_band_member', $relations, 'Delete Row Number');
            self::get_label_and_button_insert_table_row('create_band_member', 'create new', '');
            ?>
        </ul>
        <?php
    }

    public static function get_label_and_button_insert_table_row($btn_name, $value, $label_txt) {
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <button
                name="<?php echo $btn_name; ?>"
                id="<?php echo $btn_name; ?>">
                    <?php echo $value; ?>
            </button>
        </li>
        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_label_and_select_alter_table_row($select_name, $relations, $label_txt) {
        ?>
        <li>
            <label><?php echo $label_txt; ?></label>
            <select
                name="<?php echo $select_name; ?>"
                id="<?php echo $select_name; ?>">
                <option value=""></option>
                <?php
                foreach ($relations as $table_row => $id) {
                    ?>
                    <option value="<?php echo $id; ?>"><?php echo $table_row; ?></option>
                    <?php
                }
                ?>
            </select>
        </li>
        <?php
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_input_city_country($pre_id) {
        ?>
        <li>
            <label>City</label>

            <?php
            $input_name = $pre_id . '_location_input';
            $status_id = $input_name . '_status_' . Random::integer();
            ?>
            <input 
                type="text" 
                onblur="validate_city_country('<?php echo $input_name; ?>', '<?php echo $status_id; ?>')"
                onkeyup="validate_city_country('<?php echo $input_name; ?>', '<?php echo $status_id; ?>')"
                id="<?php echo $input_name; ?>">
                <?php Presentation::show_form_field_status($status_id, $pre_id); ?>
        </li>
        <?php
    }

    public static function get_label_and_region_select($mode) {
        ?>
        <li>
            <label>Region</label>

            <?php $select_name = 'region'; ?>
            <?php $status_id = $select_name . '_status_' . Random::integer(); ?>

            <?php self::get_region_select($select_name, $status_id); ?>
            <?php Presentation::show_form_field_status($status_id, $mode); ?>
        </li>
        <?php
    }

    public static function get_region_select($select_name, $status_id) {
        ?>
        <select 
            onchange="set_country(this, country, city_state)" 
            size="1" 
            name="<?php echo $select_name; ?>"
            id="<?php echo $select_name; ?>"
            onkeyup="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);" 
            onblur="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);">

            <option value="" selected="selected">Select Region</option>
            <option value=""></option>
            <script type="text/javascript">
                setRegions();
            </script>
        </select>
        <?php
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_label_and_country_select($mode) {
        ?>
        <li>
            <label>Country</label>
            <?php $select_name = 'country'; ?>
            <?php $status_id = $select_name . '_status_' . Random::integer(); ?>
            <?php self::get_country_select($select_name, $status_id); ?>
            <?php Presentation::show_form_field_status($status_id, $mode); ?>
        </li>
        <?php
    }

    public static function get_country_select($select_name, $status_id) {
        ?>
        <select 
            size="1" 
            disabled="disabled" 
            name="<?php echo $select_name; ?>"
            id="<?php echo $select_name; ?>"
            onkeyup="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);" 
            onblur="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);"
            onchange="set_city_state(this, city_state)">
        </select>
        <?php
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_label_and_city_select($mode) {
        ?>
        <li>
            <label>City/State</label>

            <?php $select_name = 'city_state'; ?>
            <?php $status_id = $select_name . '_status_' . Random::integer(); ?>
            <?php self::get_city_select($select_name, $status_id); ?>
            <?php Presentation::show_form_field_status($status_id, $mode); ?>
        </li>
        <?php
    }

    public static function get_city_select($select_name, $status_id) {
        ?>
        <select 
            size="1" 
            disabled="disabled" 
            name="<?php echo $select_name; ?>"
            id="<?php echo $select_name; ?>"
            onkeyup="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);" 
            onblur="validate_selected_option('<?php echo $select_name; ?>', '<?php echo $status_id; ?>', false);"
            onchange="print_city_state(country, this)">

        </select>
        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_hidden_input($input_name) {
        ?>
        <input 
            type="hidden" 
            id="<?php echo $input_name; ?>"
            name="<?php echo $input_name; ?>">

        <?php
    }

    public static function set_hidden_input_with_form_mode($mode) {
        ?>
        <input 
            type="hidden" 
            id="form_mode"
            name="form_mode"
            value="<?php echo $mode; ?>">

        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    private static function get_selected_value($select_name) {
        $selected_value = '';
        if (empty($_POST) === false && isset($_POST[$select_name])) {
            $selected_value = $_POST[$select_name];
        }
        return $selected_value;
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_label_and_submit_input($input_name) {
        ?>
        <li>
            <label></label>
            <input 
                type="submit" 
                name="<?php echo $input_name; ?>">
        </li>
        <?php
    }

    /*
     * **************************************************
     * Checked
     * **************************************************
     */

    public static function get_array_to_table($array_to_table) {
        ?>
        <div>
            <table>
                <?php
                foreach ($array_to_table as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $key; ?></td>
                        <td><?php echo $value; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }

    /*
     * **************************************************
     * Checking
     * **************************************************
     */

    public static function get_array_2d_to_table($arr, $append) {
        if (empty($arr)) {
            self::get_div_no_results();
            return false;
        }
        $headers = array_keys($arr[0]);
        ?>
        <div>
            <table>
                <?php
                // Headers
                self::get_array_2d_to_table_th($headers);
                // Content
                self::get_array_2d_to_table_content($arr, $append);
                ?>

            </table>
            <?php
            // End append
            self::get_array_2d_to_table_append_end($append);
            ?>
        </div>
        <?php
    }

    public static function get_array_2d_to_table_th($headers) {
        ?>
        <tr>
            <?php
            //Headers
            foreach ($headers as $key => $value) {
                $value_th = DataStructure::database_column_to_th($value);
                ?>
                <th><?php echo $value_th; ?></th>
                <?php
            }
            ?>
        </tr>
        <?php
    }

    public static function get_array_2d_to_table_content($arr, $append) {
        foreach ($arr as $row) {
            ?>
            <tr>
                <?php
                foreach ($row as $key => $value) {
                    if ($key != 'demo link' && $key != 'demo_link') {
                        ?>
                        <td><?php echo $value; ?></td>
                        <?php
                    } else {
                        ?>
                        <td><a href="<?php echo $value; ?>"><?php echo $value; ?></a></td>
                        <?php
                    }
                }
                if ($append) {
                    foreach ($append['row'] as $name => $class) {
                        ?>
                        <td>
                        </td>
                        <?php
                    }
                }
                ?>
            </tr>
            <?php
        }
    }

    public static function get_array_2d_to_table_append_end($append) {
        if ($append) {
            ?>
            <div class="table_2d_end_append">
                <?php
                foreach ($append['end'] as $name => $class) {
                    ?>
                    <td>
                    </td>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }

    public static function show_progress_bar() {
        echo 'Downloading progress: <progress value="22" max="100"></progress>';
    }

    public static function output_errors($errors) {
        $output = array();
        foreach ($errors as $error) {
            $output[] = '<li>' . $error . '</li>';
        }
        return '<ul class="errors_list">' . implode('', $output) . '</ul>';
    }

    public static function show_form_field_status($image_id, $mode) {
        global $config;
        $start = '<image id="' . $image_id . '" class="images_form_validation" src="' . $config['url']['images/general'];
        switch ($mode) {
            case 'update_band_member':
            case 'update_experience_agent':
            case 'update_experience_band':
            case 'update_experience_musician_alone':
            case 'update_experience_musician_bands':
            case 'settings':
                echo $start . '/good.png' . '" alt="good"/>';
                break;
            default:
                echo $start . '/bad.png' . '" alt="wrong"/>';
                break;
        }
    }

    public static function show_form_field_status_settings($image_id) {
        global $config;
        echo '<image id="' . $image_id . '" class="images_form_validation" src="' . $config['url']['images/general'] . '/good.png' . '" alt="wrong"/>';
    }

    public static function show_field_acceptance($txt) {
        echo '<label class="txt_form_acceptance">' . $txt . '</label>';
    }

    public static function populate_field($data_posted, $pre_fill) {
        if (isset($_POST[$data_posted])) {
            echo $_POST[$data_posted];
        } else {
            echo $pre_fill;
        }
    }

    public static function populate_select($elem_name, $value) {
        $post = '';
        if (isset($_POST[$elem_name])) {
            $post = $_POST[$elem_name];
            if ($post != '' && $post == $value) {
                return "selected";
            }
        }
    }

    public static function populate_field_settings($key) {
        global $config, $user_data, $role_data;
        if (array_key_exists($key, $user_data)) {
            echo $user_data[$key];
            return;
        } else if (array_key_exists($key, $role_data)) {
            echo $role_data[$key];
            return;
        }
    }

    /*
     * **************************************************
     * Form Fields
     * **************************************************
     */

    public static function get_form_fields_create_update_member($mode) {
        $regex = new Regex;
        self::get_label_and_input_txt('name', 'Name', '', $regex->get_regex_band_name(), $mode);
        $min_age = BandMember::MIN_AGE;
        $max_age = BandMember::MAX_AGE;
        self::get_label_and_input_date('birth_date', 'Date of Birth', $min_age, $max_age, true, $mode);
        self::get_label_and_arr_fil_select('gender', Gender::get_all(), 'Gender', $mode);
        self::get_label_and_arr_fil_select('instrument', Instrument::get_all(), 'Instrument', $mode);
        $min_join = Band::MIN_AGE;
        $max_join = Band::MAX_AGE;
        self::get_label_and_input_date('join_date', 'Join Date', $min_join, $max_join, true, $mode);
        self::get_label_and_input_txt('username', 'Username (if member has an account)', '', $regex->get_regex_username(), $mode);
        self::get_hidden_input($mode . '_selected_row');
        self::set_hidden_input_with_form_mode($mode);
    }

    public static function get_form_fields_create_update_musician_alone_experience($mode) {
        $regex = new Regex;
        self::get_label_and_arr_fil_select('instrument', Instrument::get_all(), 'Instrument', $mode);
        self::get_label_and_arr_fil_select('genre', Genre::get_all(), 'Main Genre', $mode);
        self::get_label_and_arr_fil_select('hours_practice', Practice::get_all_hours(), 'Hours of practice', $mode);
        self::get_label_and_arr_fil_select('writes_composes', MusicComposition::get_all_options(), 'Writing/Composing', $mode);
        self::get_label_and_arr_fil_select('sings', Singer::get_all_options(), 'Singing', $mode);
        self::get_label_and_input_txt('demo_link', 'Demo Link (youtube)', '', $regex->get_regex_youtube_link(), $mode);
        self::get_hidden_input($mode . '_selected_row');
        self::set_hidden_input_with_form_mode($mode);
    }

    public static function get_form_fields_create_update_musician_bands_experience($mode) {
        $regex = new Regex;

        self::get_label_and_input_txt('band_name', 'Band name', '', $regex->get_regex_band_name(), $mode);
        self::get_label_and_region_select($mode);
        self::get_label_and_country_select($mode);
        self::get_label_and_city_select($mode);
        self::get_label_and_input_txt('band_username', 'Band Username (if band has an account)', '', $regex->get_regex_username(), $mode);
        self::get_label_and_input_date('start_date', 'Start Date', 0, 0, false, $mode);
        self::get_label_and_input_date('end_date', 'End Date', 0, 0, false, $mode);
        self::get_label_and_arr_fil_select('instrument', Instrument::get_all(), 'Instrument', $mode);
        self::get_label_and_arr_fil_select('songs_type', Song::get_all_sources(), 'Type of Songs', $mode);
        self::get_label_and_arr_fil_select('main_genre', Genre::get_all(), 'Main Genre', $mode);
        self::get_label_and_arr_fil_select('hours_practice', Practice::get_all_hours(), 'Hours of practice', $mode);
        self::get_label_and_numeric_select('number_concerts', 'Concerts', 0, MusicianExperienceBand::MAX_CONCERTS, $mode);
        self::get_label_and_numeric_select('number_tours', 'Tours', 0, MusicianExperienceBand::MAX_TOURS, $mode);
        self::get_label_and_numeric_select('number_albums', 'Albums', 0, MusicianExperienceBand::MAX_ALBUMS, $mode);
        self::get_label_and_numeric_select('number_songs', 'Songs', 0, MusicianExperienceBand::MAX_SONGS, $mode);
        self::get_label_and_arr_fil_select('sings', Singer::get_all_options(), 'Singing', $mode);
        self::get_label_and_input_txt('demo_link', 'Demo Link (youtube)', '', $regex->get_regex_youtube_link(), $mode);
//for js
        self::get_hidden_input($mode . '_selected_row');
        self::set_hidden_input_with_form_mode($mode);
    }

    public static function get_form_fields_create_update_band_experience($mode) {
        $regex = new Regex;
//fields
        self::get_label_and_arr_fil_select('songs_type', Song::get_all_sources(), 'Type of Songs', $mode);
        self::get_label_and_arr_fil_select('main_genre', Genre::get_all(), 'Main Genre', $mode);
        self::get_label_and_arr_fil_select('hours_practice', Practice::get_all_hours(), 'Hours of practice', $mode);
        self::get_label_and_numeric_select('number_concerts', 'Concerts', 0, MusicianExperienceBand::MAX_CONCERTS, $mode);
        self::get_label_and_numeric_select('number_tours', 'Tours', 0, MusicianExperienceBand::MAX_TOURS, $mode);
        self::get_label_and_numeric_select('number_albums', 'Albums', 0, MusicianExperienceBand::MAX_ALBUMS, $mode);
        self::get_label_and_numeric_select('number_songs', 'Songs', 0, MusicianExperienceBand::MAX_SONGS, $mode);
        self::get_label_and_input_txt('demo_link', 'Demo Link (youtube)', '', $regex->get_regex_youtube_link(), $mode);
//for js
        self::get_hidden_input($mode . '_selected_row');
        self::set_hidden_input_with_form_mode($mode);
    }

    public static function get_form_fields_create_update_agent_experience($mode) {
        $regex = new Regex;
//fields
        self::get_label_and_input_txt('artist_name', 'Artist name', '', $regex->get_regex_band_name(), $mode);
        self::get_label_and_region_select($mode);
        self::get_label_and_country_select($mode);
        self::get_label_and_city_select($mode);
        self::get_label_and_arr_fil_select('artist_type', ArtistType::get_all_options(), 'Type of Artist', $mode);
        self::get_label_and_input_txt('artist_username', 'Artist Username (if it has an account)', '', $regex->get_regex_username(), $mode);
        self::get_label_and_input_date('start_date', 'Start Date', 0, 0, true, $mode);
        self::get_label_and_input_date('end_date', 'End Date', 0, 0, true, $mode);
        self::get_label_and_arr_fil_select('main_genre', Genre::get_all(), 'Main Genre', $mode);
        self::get_label_and_numeric_select('number_concerts', 'Concerts', 0, MusicianExperienceBand::MAX_CONCERTS, $mode);
        self::get_label_and_numeric_select('number_tours', 'Tours', 0, MusicianExperienceBand::MAX_TOURS, $mode);
        self::get_label_and_numeric_select('number_albums', 'Albums', 0, MusicianExperienceBand::MAX_ALBUMS, $mode);
        self::get_label_and_input_txt('demo_link', 'Demo Link (youtube)', '', $regex->get_regex_youtube_link(), $mode);

//for js
        self::get_hidden_input($mode . '_selected_row');
        self::set_hidden_input_with_form_mode($mode);
    }

    public static function get_form_fields_create_update_pursuit($mode) {
        $regex = new Regex;
//fields
        self::get_label_and_arr_fil_select('role_pursuited', Role::get_roles_except_this(), 'Who are you looking for?', $mode);
        self::get_label_and_arr_fil_select('instrument', Instrument::get_all(), 'What it the instrument?', $mode);
        self::get_label_and_arr_fil_select('genre', Genre::get_all(), 'What\'s the musical genre?', $mode);
        self::get_label_and_arr_fil_select('urgency', Urgency::get_all_options(), 'Is it urgent?', $mode);
//for js
        self::get_hidden_input($mode . '_selected_row');
        self::set_hidden_input_with_form_mode($mode);
    }

    /*
     * **************************************************
     * Link List on Index (short version)
     * **************************************************
     */

    public static function array_pursues_to_link_list($array, $title, $type) {
        ?>

        <div class="link_list">
            <span></span>
            <?php
            self::get_link_to_more($type);
            self::get_link_list_title($title);
            $continue = self::check_no_data_link_list($array);
            if (!$continue) {
                return false;
            }
            self::get_link_list_items($array, $type);
            ?>
        </div>
        <?php
    }

    public static function get_link_to_more($type) {
        global $config;
        ?>
        <a 
            href="<?php echo $config['file']['search_by_pursuit'] . '?type=' . $type ?>"
            class="link_to_more"
            id=""
            >more ...
        </a>
        <?php
    }

    public static function get_link_list_title($title) {
        ?>
        <h3>
            <div class="link_list_title">
                <?php echo $title . ' '; ?>
            </div>

        </h3>
        <?php
    }

    public static function check_no_data_link_list($array) {
        if (sizeof($array) == 0) {
            ?>
            <div class="link_list_item">
                <p>There are no results.</p>
            </div>
            </div>
            <?php
            return false;
        }
        return true;
    }

    public static function get_link_list_items($array, $type) {
        global $config;
        foreach ($array as $key => $value) {
            $username = $value['username'];
            ?>
            <div class="link_list_item">
                <hr>
                <a href="<?php echo $config['file']['check_user_profile'] . '?username=' . $username; ?>">
                    <?php self::get_role_params_to_link_list($value, $type); ?>
                </a>

            </div>
            <?php
        }
    }

    public static function get_role_params_to_link_list($value, $type) {
        switch ($type) {
// mus_ban
            case 1:
// mus_age
            case 2:
// age_mus
            case 5:
                self::get_generic_params_to_link_list($value);
                break;
// ban_mus
            case 3:
                self::get_band_to_musician_params_to_link_list($value);
                break;
// ban_age
            case 4:
                self::get_band_to_agent_params_to_link_list($value);
                break;
// age_ban
            case 6:
                self::get_agent_to_band_params_to_link_list($value);
                break;
            default:
                break;
        }
    }

    public static function get_generic_params_to_link_list($value) {
        ?>
        <strong>
            <?php echo $value['first_name'] . ' ' . $value['last_name']; ?>
        </strong>
        <?php
        echo ' (' . $value['country'] . ')';
        echo ' - ' . $value['instrument'];
        echo ' - ' . $value['genre'];
    }

    public static function get_band_to_musician_params_to_link_list($value) {
        ?>
        <strong>
            <?php echo $value['name']; ?>
        </strong>
        <?php
        echo ' (' . $value['country'] . ')';
        echo ' - ' . $value['instrument'];
        echo ' - ' . $value['genre'];
    }

    public static function get_band_to_agent_params_to_link_list($value) {
        ?>
        <strong>
            <?php echo $value['name']; ?>
        </strong>
        <?php
        echo ' (' . $value['country'] . ')';
        echo ' - ' . $value['genre'];
    }

    public static function get_agent_to_band_params_to_link_list($value) {
        ?>
        <strong>
            <?php echo $value['first_name'] . ' ' . $value['last_name']; ?>
        </strong>
        <?php
        echo ' (' . $value['country'] . ')';
        echo ' - ' . $value['genre'];
    }

    /*
     * **************************************************
     * Search Panel
     * **************************************************
     */

    public static function roles_to_li_filter_group($id_pre) {
        $roles = Role::get_roles();
        foreach ($roles as $key => $value) {
            $value = strtolower($value);
            $id = $id_pre . '_' . $value;
            ?>
            <li 
                id="<?php echo $id; ?>"
                value="<?php echo $value; ?>"
                >
                    <?php echo $value; ?>
            </li>
            <?php
        }
    }

    public static function array_to_li_filter_group($id_pre, $array) {
        foreach ($array as $key => $value) {
            $value = strtolower($value);
            $id = $id_pre . '_' . $value;
            ?>
            <li 
                id="<?php echo $id; ?>"
                value="<?php echo $value; ?>"
                >
                    <?php echo $value; ?>
            </li>
            <?php
        }
    }

    /*
     * **************************************************
     * Link List (long version)
     * **************************************************
     */

    public static function get_links_types_pursuits() {
        global $config;
        $href = $config['file']['search_by_pursuit'] . '?type=';
        ?>
        <div class="block_looking_for">
            <a href="<?php echo $href . '1'; ?>">Musicians Looking For Bands</a>
            <br>
            <a href="<?php echo $href . '2'; ?>">Musicians Looking For Agents</a>
        </div>
        <div class="block_looking_for">
            <a href="<?php echo $href . '3'; ?>">Bands Looking For Musicians</a>
            <br>
            <a href="<?php echo $href . '4'; ?>">Bands Looking For Agents</a>
        </div>
        <div class="block_looking_for">
            <a href="<?php echo $href . '5'; ?>">Agents Looking For Musicians</a>
            <br>
            <a href="<?php echo $href . '6'; ?>">Agents Looking For Bands</a>
        </div>
        <?php
    }

    public static function all_pursuits_by_type_to_table($args) {
        switch ($args['type']) {
            case 1:
                return self::musician_pursuit_band_to_table($args);
            case 2:
                return self::musician_pursuit_agent_to_table($args);
            case 3:
                return self::band_pursuit_musician_to_table($args);
            case 4:
                return self::band_pursuit_agent_to_table($args);
            case 5:
                return self::agent_pursuit_musician_to_table($args);
            case 6:
                return self::agent_pursuit_band_to_table($args);
            default:
                break;
        }
    }

    public static function musician_pursuit_band_to_table($args) {
        self::get_array_2d_to_table($args['array'], false);
    }

    public static function musician_pursuit_agent_to_table($args) {
        self::get_array_2d_to_table($args['array'], false);
    }

    public static function band_pursuit_musician_to_table($args) {
        self::get_array_2d_to_table($args['array'], false);
    }

    public static function band_pursuit_agent_to_table($args) {
        self::get_array_2d_to_table($args['array'], false);
    }

    public static function agent_pursuit_musician_to_table($args) {
        self::get_array_2d_to_table($args['array'], false);
    }

    public static function agent_pursuit_band_to_table($args) {
        self::get_array_2d_to_table($args['array'], false);
    }

    /*
     * **************************************************
     * Filter Panels
     * **************************************************
     */

    public static function overall_search_panel_age($pre_id, $min_age, $max_age) {
        ?>
        <div id="<?php echo $pre_id . 'age'; ?>">
            <ul class="filter_group">
                <p class="filter_group_title">Age:</p>
                <li id="<?php echo $pre_id . 'age_default'; ?>">all</li>
                <li>
                    from: <?php Presentation::get_numeric_select($pre_id . 'age_from', $min_age, $max_age, false); ?>
                    to: <?php Presentation::get_numeric_select($pre_id . 'age_to', $min_age, $max_age, false); ?>
                </li>
                <li id="<?php echo $pre_id . 'alert_invalid'; ?>"
                    class="invalid_age_interval">
                    Invalid age interval!
                </li>
            </ul>
        </div>    
        <?php
    }

    public static function overall_search_panel_location($pre_id) {
        global $config;
        $countries_accept_search_prox = DataStructure::item_array_to_text(Location::get_countries_with_coordinates());
        ?>
        <div id="<?php echo $pre_id . 'location'; ?>">
            <ul class="filter_group">
                <p class="filter_group_title">Location:</p>
                <li id="<?php echo $pre_id . 'location_default'; ?>">all</li>
                <li>proximity</li>
                <div id="<?php echo $pre_id . 'cant_search_by_prox'; ?>"
                     class="cant_search_by_prox">
                    To select this option you have to:
                    <br>
                    <br><b>1)</b> be <a href="<?php echo $config['file']['login']; ?>">logged in </a>
                    <br>
                    <br><b>2)</b> have a <a href="<?php echo $config['file']['premium']; ?>">premium account</a>
                    <br>
                    <br><b>3)</b> be registered in one of the following countries: 
                    <u><?php echo $countries_accept_search_prox; ?></u>
                </div>
                <li>
                    region/country/city:
                    <input 
                        type="text" 
                        id="<?php echo $pre_id . 'location_input'; ?>">
                    </input>
                </li>
                <li id="<?php echo $pre_id . 'alert_invalid'; ?>"
                    class="invalid_location">
                    Invalid location!
                </li>
            </ul>
        </div>
        <?php
    }

    public static function overall_search_panel_gender($pre_id) {
        ?>
        <div id="<?php echo $pre_id . 'gender'; ?>">
            <ul class="filter_group">
                <p class="filter_group_title">Gender:</p>
                <li id="<?php echo $pre_id . 'gender_default'; ?>">all</li>
                <?php Presentation::array_to_li_filter_group($pre_id, Gender::get_all()); ?>
            </ul>
        </div>
        <?php
    }

    public static function overall_search_panel_instrument($pre_id) {
        ?>
        <div id="<?php echo $pre_id . 'instrument'; ?>">
            <ul class="filter_group">
                <p class="filter_group_title">Instrument:</p>
                <li id="<?php echo $pre_id . 'instrument_default'; ?>">all</li>
                <li>select:<?php Presentation::get_arr_fil_select($pre_id . 'instrument_sel', Instrument::get_all(), false); ?></li>
            </ul>
        </div>
        <?php
    }

    public static function overall_search_panel_genre($pre_id) {
        ?>
        <div id = "<?php echo $pre_id . 'genre'; ?>">
            <ul class = "filter_group">
                <p class = "filter_group_title">Genre:</p>
                <li id="<?php echo $pre_id . 'genre_default'; ?>">all</li>
                <li>select: <?php Presentation::get_arr_fil_select($pre_id . 'genre_sel', Genre::get_all(), false); ?></li>
            </ul>
        </div>
        <?php
    }

    public static function show_opts_selected_ov_search_age($pre_id) {
        ?>
        <br>
        <b>Age opt sel: </b><div id="<?php echo $pre_id . 'age_option_filtered'; ?>"></div>
        <b>Age Min: </b><div id="<?php echo $pre_id . 'age_min_filtered'; ?>"></div>
        <b>Age Max: </b><div id="<?php echo $pre_id . 'age_max_filtered'; ?>"></div>
        <?php
    }

    public static function show_opts_selected_ov_search_location($pre_id) {
        ?>
        <br>
        <b>Location opt sel: </b><div id="<?php echo $pre_id . 'location_opt_filtered'; ?>"></div>
        <b>Location choice: </b><div id="<?php echo $pre_id . 'location_filtered'; ?>"></div>
        <?php
    }

    public static function show_opts_selected_ov_search_gender($pre_id) {
        ?>
        <br>
        <b>Gender opt sel: </b><div id="<?php echo $pre_id . 'gender_opt_filtered'; ?>"></div>
        <?php
    }

    public static function show_opts_selected_ov_search_instrument($pre_id) {
        ?>
        <br>
        <b>Instrument opt sel: </b><div id="<?php echo $pre_id . 'instrument_opt_filtered'; ?>"></div>
        <b>Instrument choice: </b><div id="<?php echo $pre_id . 'instrument_filtered'; ?>"></div>
        <?php
    }

    public static function show_opts_selected_ov_search_genre($pre_id) {
        ?>
        <br>
        <b>Genre opt sel: </b><div id="<?php echo $pre_id . 'genre_opt_filtered'; ?>"></div>
        <b>Genre choice: </b><div id="<?php echo $pre_id . 'genre_filtered'; ?>"></div>
        <?php
    }

    public static function get_button_search_matches_musician_band($to_search) {
        $id = 'btn_search_matches_musician_band';
        $value = "Search for matches with $to_search";
        self::get_button_search_matches($id, $value);
    }

    public static function get_button_search_matches_musician_agent($to_search) {
        $id = 'btn_search_matches_musician_agent';
        $value = "Search for matches with $to_search";
        self::get_button_search_matches($id, $value);
    }

    public static function get_button_search_matches_band_agent($to_search) {
        $id = 'btn_search_matches_band_agent';
        $value = "Search for matches with $to_search";
        self::get_button_search_matches($id, $value);
    }

    public static function get_button_search_matches($id, $value) {
        ?>
        <input
            type="button"
            class="btn_search_matches"
            id="<?php echo $id; ?>"
            value="<?php echo $value; ?>">
        </input>

        <?php
    }

    public static function get_div_result_search_matches_musician_band() {
        $id = 'search_result_matches_musician_band';
        self::get_div_result_search_matches($id);
    }

    public static function get_div_result_search_matches_musician_agent() {
        $id = 'result_search_matches_musician_agent';
        self::get_div_result_search_matches($id);
    }

    public static function get_div_result_search_matches_band_agent() {
        $id = 'result_search_matches_band_agent';
        self::get_div_result_search_matches($id);
    }

    public static function get_div_result_search_matches($id) {
        ?>
        <div id="<?php echo $id; ?>"></div>
        <?php
    }

    public static function get_table_top_matches_2($arr, $to_search, $type) {
        $desc = Match::get_weights_description_by_type($type);
        ?>
        <table>
            <?php self::get_table_top_matches_2_thead($arr, $to_search, $type); ?>
            <?php self::get_table_top_matches_2_tbody($arr, $to_search, $desc); ?>
        </table>
        <?php
    }

    private static function get_table_top_matches_2_thead($arr, $to_search, $type) {
        ?>
        <thead>
            <tr>
                <th></th>
                <?php
                foreach ($arr as $key => $value) {
                    $id = $value[$to_search];
                    $username = User::get_username($id);
                    ?>
                    <th><?php echo $username; ?></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <?php
    }

    private static function get_table_top_matches_2_tbody($arr, $to_search, $desc) {
        ?>
        <tbody>
            <?php self::get_table_top_matches_2_tbody_content($arr, $to_search, $desc); ?>
            <?php self::get_table_top_matches_2_tbody_description($arr, $to_search, $desc); ?>
        </tbody>
        <?php
    }

    private static function get_table_top_matches_2_tbody_description($arr, $to_search, $desc) {
        foreach ($desc as $key_desc => $value) {
            ?>
            <tr>
                <td><?php echo $value['description']; ?></td>
                <?php
                foreach ($arr as $key_user => $user_score_info) {
                    ?>
                    <td><?php echo $user_score_info['scores'][$key_desc]; ?></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
    }

    private static function get_table_top_matches_2_tbody_content($arr, $to_search, $desc) {
        ?>
        <tr>
            <td><b>Total (%)</b></td>
            <?php
            foreach ($arr as $key_user => $user_score_info) {
                ?>
                <td><b><?php echo $user_score_info['rate'] . ' %'; ?></b></td>
                <?php
            }
            ?>
        </tr>
        <?php
    }

    public static function get_table_top_matches($arr, $to_search, $type) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Match Rate (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($arr as $key => $value) {
                    $id = $value[$to_search];
                    $username = User::get_username($id);
                    ?>
                    <tr>
                        <td><?php self::get_link_check_user_profile($username, $username); ?></td>
                        <td><?php echo $value['rate']; ?></td>
                        <td><?php self::get_table_scores_of_match($value['scores'], $type); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public static function get_table_scores_of_match($array, $type) {
        $desc = [];
        switch ($type) {
            case 1:
                $desc = MatchMusicianBand::get_weights_description();
                break;
            case 2:
                $desc = MatchMusicianAgent::get_weights_description();
                break;
            case 3:
                $desc = MatchBandAgent::get_weights_description();
                break;
            default:
                break;
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>score</th>
                    <th>description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($array as $key => $value) {
                    $d = $desc[$key]['description'];
                    ?>
                    <tr>
                        <td><?php echo $value; ?></td>
                        <td><?php echo $d; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public static function get_link_check_user_profile($username, $text) {
        global $config;
        ?>
        <a href="<?php echo $config['file']['check_user_profile'] . '?username=' . $username; ?>">
            <?php echo $text; ?>
        </a>
        <?php
    }

    public static function get_link_premium($text) {
        global $config;
        ?>
        <b>
            <a href="<?php echo $config['file']['premium']; ?>">
                <?php echo $text; ?>
            </a>
        </b>
        <?php
    }

    public static function messages_to_text_area($msgs) {

        foreach ($msgs as $key => $user) {
            foreach ($user as $user_id => $user_messages) {
                echo "<br>$user_id: <br>";
                $ms = '';
                foreach ($user_messages as $msg_param => $msg_param_val) {
                    $content = $msg_param_val['content'];
                    $created_at = $msg_param_val['created_at'];
                    if (array_key_exists('user_id_to', $msg_param_val)) {
                        $direction = 'to';
                    } else if (array_key_exists('user_id_from', $msg_param_val)) {
                        $direction = 'from';
                    }
                    $ms.="$created_at: ($direction) $content";
                }
                ?>
                <textarea rows="4" cols="100" class="msgs_txt_area"><?php echo $ms; ?></textarea>
                <?php
            }
        }
    }

    public static function get_table_headers_search_by_pursuit($type) {
        ?>
        <th><a href="" ng-click="sort_by('username')">username</a></th>  
        <?php
        $others = self::get_headers_array_for_search_by_pursuit($type);
        foreach ($others as $field) {
            ?>
            <th><a href="" ng-click="sort_by('<?php echo $field; ?>')"><?php echo $field; ?></a></th>
            <?php
        }
    }

    public static function get_table_data_search_by_pursuit($type) {
        global $config;
        ?>
        <?php $href = $config['file']['check_user_profile'] . '?username='; ?>
        <td><a href="<?php echo $href; ?>{{result.username}}">{{result.username}}</a></td>
        <?php
        $others = self::get_headers_array_for_search_by_pursuit($type);
        foreach ($others as $field) {
            if ($field == 'city_state') {
                ?>
                <td>{{result.<?php echo $field; ?>}} ({{result.country}})</td>
                <?php
            } else {
                ?>
                <td>{{result.<?php echo $field; ?>}}</td>
                <?php
            }
        }
    }

    public static function get_headers_array_for_search_by_pursuit($type) {
        switch ($type) {
            case '1':
            case '2':
                return ['birth_date', 'gender', 'city_state', 'instrument', 'genre'];
            case '3':
                return ['name', 'city_state', 'instrument', 'genre'];
            case '4':
                return ['name', 'city_state', 'genre'];
            case '5':
                return ['birth_date', 'instrument', 'gender', 'city_state', 'genre'];
            case '6':
                return ['birth_date', 'gender', 'city_state', 'genre'];
        }
    }

}
