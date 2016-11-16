<?php

class JavaScript {

    public static function alert($var) {
        ?>
        <script>
            alert(<?php echo json_encode($var) ?>);
        </script>
        <?php
    }

    public static function console($var) {
        ?>
        <script>
            console.log(<?php echo json_encode($var) ?>);
        </script>
        <?php
    }

    public static function encode_to_json_user_can_search_by_prox() {
        $user_can_search_by_prox = User::can_search_by_proximity();
        ?>
        <script>
            var user_can_search_by_prox = <?php echo json_encode($user_can_search_by_prox); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_user_region() {
        $region = User::get_region();
        ?>
        <script>
            var user_region = <?php echo json_encode($region); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_user_country() {
        $country = User::get_country();
        ?>
        <script>
            var user_country = <?php echo json_encode($country); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_user_city_state() {
        $city = User::get_city_state();
        ?>
        <script>
            var user_city_state = <?php echo json_encode($city); ?>;
        </script>
        <?php
    }

    /*
     * ***************************************************************************
     * redirect_with_success_status
     * ***************************************************************************
     */

    public static function redirect_with_success_status($file_name, $status) {
        global $config;
        ?>
        <script>
            location.replace("<?php echo $config['file'][$file_name] . '?' . $status; ?>");
        </script>
        <?php
    }

    /*
     * ***************************************************************************
     * settings
     * ***************************************************************************
     */

    public static function encode_to_json_settings($var) {
        ?>
        <script>
            var settings_values = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_settings_fields($var) {
        ?>
        <script>
            var settings_fields = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    /*
     * ***************************************************************************
     * settings band members
     * ***************************************************************************
     */

    public static function encode_to_json_band_members($var) {
        ?>
        <script>
            var band_members = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_band_members_fields($var) {
        ?>
        <script>
            var band_members_fields = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function show_form_after_failed_post_band_members($form_mode) {
        switch ($form_mode) {
            case 'update_band_member':
                ?>
                <script>
                    $(id_update_member_form).show();
                </script>
                <?php
                break;
            case 'create_band_member':
                ?>
                <script>
                    $(id_create_member_form).show();
                </script>
                <?php
                break;
            default:
                break;
        }
    }

    public static function disable_html_elements_band_members($n_elem, $n_elem_without_settings) {
        $dif = $n_elem - $n_elem_without_settings;
        switch ($dif) {
            case 0:
                /*
                 * no settings done yet
                 */
                ?>
                <script>
                    $('#update_band_member').attr('disabled', 'disabled');
                    $('#delete_band_member').attr('disabled', 'disabled');
                </script>
                <?php
                break;
            case $n_elem:
                /*
                 * all settings done 
                 */
                // do nothing
                break;

            default:
                /*
                 * some settings done 
                 */
                // do nothing
                break;
        }
    }

    /*
     * ***************************************************************************
     * exp musician alone
     * ***************************************************************************
     */

    public static function encode_to_json_experience_musician_alone($var) {
        ?>
        <script>
            var experience_musician_alone = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_experience_musician_alone_fields($var) {
        ?>
        <script>
            var experience_musician_alone_fields = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function show_form_after_failed_post_exp_mus_alone($form_mode) {
        switch ($form_mode) {
            case 'update_experience_musician_alone':
                ?>
                <script>
                    $(id_update_experience_musician_alone_form).show();
                </script>
                <?php
                break;
            case 'create_experience_musician_alone':
                ?>
                <script>
                    $(id_create_experience_musician_alone_form).show();
                </script>
                <?php
                break;
            default:
                break;
        }
    }

    /*
     * ***************************************************************************
     * exp musician bands
     * ***************************************************************************
     */

    public static function encode_to_json_experience_musician_bands($var) {
        ?>
        <script>
            var experience_musician_bands = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_experience_musician_bands_fields($var) {
        ?>
        <script>
            var experience_musician_bands_fields = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function show_form_after_failed_post_exp_mus_bands($form_mode) {
        switch ($form_mode) {
            case 'update_experience_musician_bands':
                ?>
                <script>
                    $(id_update_experience_musician_bands_form).show();
                </script>
                <?php
                break;
            case 'create_experience_musician_bands':
                ?>
                <script>
                    $(id_create_experience_musician_bands_form).show();
                </script>
                <?php
                break;
            default:
                break;
        }
    }

    /*
     * ***************************************************************************
     * exp band
     * ***************************************************************************
     */

    public static function encode_to_json_experience_band($var) {
        ?>
        <script>
            var experience_band = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_experience_band_fields($var) {
        ?>
        <script>
            var experience_band_fields = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function show_form_after_failed_post_exp_band($form_mode) {
        switch ($form_mode) {
            case 'update_experience_band':
                ?>
                <script>
                    $(id_update_experience_band_form).show();
                </script>
                <?php
                break;
            case 'create_experience_band':
                ?>
                <script>
                    $(id_create_experience_band_form).show();
                </script>
                <?php
                break;
            default:
                break;
        }
    }

    /*
     * ***************************************************************************
     * exp agent
     * ***************************************************************************
     */

    public static function encode_to_json_experience_agent($var) {
        ?>
        <script>
            var experience_agent = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_experience_agent_fields($var) {
        ?>
        <script>
            var experience_agent_fields = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function show_form_after_failed_post_exp_agent($form_mode) {
        switch ($form_mode) {
            case 'update_experience_agent':
                ?>
                <script>
                    $(id_update_experience_agent_form).show();
                </script>
                <?php
                break;
            case 'create_experience_agent':
                ?>
                <script>
                    $(id_create_experience_agent_form).show();
                </script>
                <?php
                break;
            default:
                break;
        }
    }

    /*
     * ***************************************************************************
     * pursuit
     * ***************************************************************************
     */

    public static function encode_to_json_pursuit($var) {
        ?>
        <script>
            var pursuits = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_pursuit_fields($var) {
        ?>
        <script>
            var pursuits_fields = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function encode_to_json_role($var) {
        ?>
        <script>
            var role = <?php echo json_encode($var); ?>;
        </script>
        <?php
    }

    public static function show_form_after_failed_post_pursuit($form_mode) {
        switch ($form_mode) {
            case 'update_pursuit':
                ?>
                <script>
                    $(id_update_pursuit_form).show();
                </script>
                <?php
                break;
            case 'create_pursuit':
                ?>
                <script>
                    $(id_create_pursuit_form).show();
                </script>
                <?php
                break;
            default:
                break;
        }
    }

}
