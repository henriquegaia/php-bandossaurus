<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

$file = 'pursuit';
$form_is_valid = true;
Presentation::print_page_title('Pursuits');

if (!empty($_POST)) {
    $form_mode = $_POST['form_mode'];

    switch ($form_mode) {
        case 'update_pursuit':
        case 'create_pursuit':
            $req_fields = Pursuit::get_settings_required_fields();
            $non_req_fields = Pursuit::get_settings_non_required_fields();
            $errors = Post::form_req_fields_filled($req_fields, $non_req_fields);
            break;
        case 'delete_pursuit':
            break;
        default:
            die('pursuit.php - $form_mode');
    }
}

if (isset($_GET[Get::SUCCESS_PARAM]) === true && empty($_GET[Get::SUCCESS_PARAM])) {
    Presentation::success_message();
} else if (isset($_GET[Get::UNSUCCESS_PARAM]) === true && empty($_GET[Get::UNSUCCESS_PARAM]) === true) {
    Presentation::failure_message();
    $text = 'If that\'s the case, you can\'t create/update a pursuit to information that already exists in the table.';
    Presentation::print_failure_message($text);
} else {
    if (empty($_POST) === false && empty($errors) === true) {
        $form_mode = $_POST['form_mode'];
        $modes_arr = [
            1 => 'update_pursuit',
            2 => 'delete_pursuit',
            3 => 'create_pursuit'
        ];
        Token::check_csrf_3_forms($form_mode, $modes_arr);

        switch ($form_mode) {
            case 'update_pursuit':
                $pursuit_id = Pursuit::get_id_update_or_delete($form_mode);
                $pursuit_data = Post::get_settings_data_to_array(Pursuit::get_settings_fields());
                $pursuit_data = Pursuit::get_data_for_update($pursuit_data);
                if (Pursuit::update($pursuit_id, $pursuit_data, false) == true) {
                    Redirect::success_status($file, 'update', 'success');
                } else {
                    Redirect::success_status($file, 'update', 'unsuccess');
                }
                break;
            case 'delete_pursuit':
                $pursuit_id = Pursuit::get_id_update_or_delete($form_mode);
                if (Pursuit::delete($pursuit_id) == true) {
                    Redirect::success_status($file, 'delete', 'success');
                } else {
                    Redirect::success_status($file, 'delete', 'unsuccess');
                }
                break;
            case 'create_pursuit':
                $pursuit_data = Post::get_settings_data_to_array(Pursuit::get_settings_fields());
                if (Pursuit::create($pursuit_data, $session_user_id) == true) {
                    Redirect::success_status($file, 'create', 'success');
                } else {
                    Redirect::success_status($file, 'create', 'unsuccess');
                }
                break;
            default:
                break;
        }
    } else if (empty($errors) === false) {
        Presentation::print_failure_message_array($errors);
        $form_is_valid = false;
    }

    global $pursuits, $role, $config;

    $total_rows = sizeof($pursuits);

    JavaScript::encode_to_json_pursuit($pursuits);
    JavaScript::encode_to_json_pursuit_fields(Pursuit::get_settings_fields());

    Presentation::print_message_if_no_data($total_rows, 'You haven\'t yet edited any pursuit.');

    $prepared_data_to_table = Pursuit::prepare_data_to_table();
    Presentation::print_2d_table_if_has_data($prepared_data_to_table);

    $order_id_relations = DataStructure::get_relation_element_order_and_id($pursuits, Pursuit::get_pk());

    $options = [
        'update_id' => 'update_pursuit',
        'delete_id' => 'delete_pursuit',
        'create_id' => 'create_pursuit',
        'update_text' => 'Update Row Number',
        'delete_text' => 'Delete Row Number',
        'create_text' => 'Create New',
    ];
    Presentation::get_settings_table_options($options, $order_id_relations);
    /*
     * ***************************************************************************
     * forms
     * ***************************************************************************
     */
    ?>
    <div id="pursuit_form_area">
        <?php
        include $config['file']['update_pursuit_form'];
        include $config['file']['delete_pursuit_form'];
        include $config['file']['create_pursuit_form'];
        ?>
    </div>
    <?php
    if (!$form_is_valid) {
        $form_mode = $_POST['form_mode'];
        JavaScript::show_form_after_failed_post_pursuit($form_mode);
    }
}

include $config['file']['ov_footer'];
