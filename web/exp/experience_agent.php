<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

$form_is_valid = true;

$args_post = [
    'update_mode' => 'update_experience_agent',
    'delete_mode' => 'delete_experience_agent',
    'create_mode' => 'create_experience_agent',
    'settings_fields' => AgentExperience::get_settings_fields(),
    'required_fields' => AgentExperience::get_required_fields(),
    'non_required_fields' => AgentExperience::get_non_required_fields(),
    'has_location' => true,
    'mode' => 'experience',
    'sub_mode' => 'agent'
];
$errors = Post::get_errors_crud_page($args_post);


/*
 * ***************************************************************************
 * Presentation
 * ***************************************************************************
 */

Presentation::print_page_title('Experience');

if (empty($errors) == false) {
    $form_is_valid = false;
    Presentation::print_failure_message_array($errors);
}

$args_crud = [
    'errors' => $errors,
    'args_post' => $args_post
];

Experience::execute_crud_and_redirect($args_crud);

if (isset($_GET['success']) || isset($_GET['unsuccess'])) {
    include $config['file']['ov_footer'];
    exit();
}

$total_rows = sizeof($experience_data);

JavaScript::encode_to_json_experience_agent($experience_data);
JavaScript::encode_to_json_experience_agent_fields(AgentExperience::get_settings_fields());

Presentation::print_message_if_no_data($total_rows, 'You haven\'t yet edited any of your musical experiences with bands.');
$prepared_data_to_table = Experience::get_experience_prepared_data($role);
Presentation::print_2d_table_if_has_data($prepared_data_to_table);

$order_id_relations = Experience::get_relation_element_order_and_id($experience_data);

$options = [
    'update_id' => 'update_experience_agent',
    'delete_id' => 'delete_experience_agent',
    'create_id' => 'create_experience_agent',
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
<div id="experience_agent_form_area">
    <?php
    include $config['file']['update_experience_agent_form'];
    include $config['file']['delete_experience_agent_form'];
    include $config['file']['create_experience_agent_form'];
    ?>
</div>
<?php
if (!$form_is_valid) {
    $form_mode = $_POST['form_mode'];
    JavaScript::show_form_after_failed_post_exp_agent($form_mode);
}
include $config['file']['ov_footer'];
