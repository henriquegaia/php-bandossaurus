<?php
$config = include dirname(dirname(__FILE__)) . '/core/config.php';
$title = DataStructure::get_page_title();
$description = DataStructure::get_page_description();
$keywords=  DataStructure::get_keywords();
?>

<head>
    <title>
        <?php echo $title; ?>
    </title>

    <meta charset="UTF-8">
    <meta name="Keywords" content="<?php echo $keywords; ?>">
    <meta name="Description" content="<?php echo $description; ?>">

    <!-- js -->
    <script type="text/javascript" src="<?php echo $config['file']['js_angular']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['jquery']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['jquery_ui']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['jquery_lazyload']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_lazy_load']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_plugin_table_sort']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_global']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_urls']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_settings_1d_table_generic']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_settings_2d_table_generic']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_settings_band_members']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_validations']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_usa']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_locations']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_settings_location']; ?>"></script>

    <script type="text/javascript" src="<?php echo $config['file']['js_experience_musician_alone']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_experience_musician_bands']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_experience_band']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_experience_agent']; ?>"></script>

    <script type="text/javascript" src="<?php echo $config['file']['js_settings']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_pursuit']; ?>"></script>

    <script type="text/javascript" src="<?php echo $config['file']['js_search_overall_musician']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_search_overall_band']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_search_overall_agent']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_search_overall_filter']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_search_by_pursuit']; ?>"></script>

    <script type="text/javascript" src="<?php echo $config['file']['js_matches']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['file']['js_messages']; ?>"></script>


    <script type="text/javascript" src="<?php echo $config['file']['js_chat']; ?>"></script>

    <!-- css -->
    <link rel="stylesheet" href="<?php echo $config['file']['jquery_css']; ?>">
    <link rel="stylesheet" href="<?php echo $config['file']['overall']; ?>">
    <link rel="icon" href="<?php echo $config['file']['favicon']; ?>">


</head>