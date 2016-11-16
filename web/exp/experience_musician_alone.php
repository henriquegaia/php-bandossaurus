<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

$form_is_valid = true;

$args_post = [
    'update_mode' => 'update_experience_musician_alone',
    'delete_mode' => 'delete_experience_musician_alone',
    'create_mode' => 'create_experience_musician_alone',
    'settings_fields' => MusicianExperienceAlone::get_settings_fields(),
    'required_fields' => MusicianExperienceAlone::get_required_fields(),
    'non_required_fields' => MusicianExperienceAlone::get_non_required_fields(),
    'has_location' => false,
    'mode' => 'experience',
    'sub_mode' => 'musician_alone'
];
$errors = Post::get_errors_crud_page($args_post);



/*
 * ***************************************************************************
 * Presentation
 * ***************************************************************************
 */
Presentation::print_page_title('Experience alone');

if (empty($errors) == false) {
    Presentation::print_failure_message_array($errors);
    $form_is_valid = false;
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

$total_rows_alone = sizeof($experience_data_musician_alone);

JavaScript::encode_to_json_experience_musician_alone($experience_data_musician_alone);
JavaScript::encode_to_json_experience_musician_alone_fields(MusicianExperienceAlone::get_settings_fields());

Presentation::print_message_if_no_data($total_rows_alone, 'You haven\'t yet edited any of your musical experiences alone.');
$prepared_data_musician_alone_to_table = Experience::get_experience_prepared_data('musician_alone');
Presentation::print_2d_table_if_has_data($prepared_data_musician_alone_to_table);
$order_id_relations_alone = MusicianExperienceAlone::get_relation_element_order_and_id();

$options = [
    'update_id' => 'update_experience_musician_alone',
    'delete_id' => 'delete_experience_musician_alone',
    'create_id' => 'create_experience_musician_alone',
    'update_text' => 'Update Row Number',
    'delete_text' => 'Delete Row Number',
    'create_text' => 'Create New',
];

Presentation::get_settings_table_options($options, $order_id_relations_alone);

/*
 * ***************************************************************************
 * forms
 * ***************************************************************************
 */
?>
<div id="experience_musician_alone_form_area">
    <?php
    include $config['file']['update_experience_musician_alone_form'];
    include $config['file']['delete_experience_musician_alone_form'];
    include $config['file']['create_experience_musician_alone_form'];
    ?>
</div>
<?php
if (!$form_is_valid) {
    $form_mode = $_POST['form_mode'];
    JavaScript::show_form_after_failed_post_exp_mus_alone($form_mode);
}

include $config['file']['ov_footer'];
