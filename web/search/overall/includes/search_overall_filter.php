<?php
JavaScript::encode_to_json_user_can_search_by_prox();
JavaScript::encode_to_json_user_region();
JavaScript::encode_to_json_user_country();
JavaScript::encode_to_json_user_city_state();

$pre_id_role_filter = 'search_overall_role_filter';
$pre_id_role_panel = 'search_overall_filter_panel_';
$pre_id_panel_mus = $pre_id_role_panel . 'musician_';
$pre_id_panel_band = $pre_id_role_panel . 'band_';
$pre_id_panel_agent = $pre_id_role_panel . 'agent_';
?>

<div id="search_overall_filter_panel">
    <div id="search_overall_filter_panel_roles">
        <ul class="filter_group">
            <p class="filter_group_title">Roles:</p>
            <?php Presentation::array_to_li_filter_group($pre_id_role_filter, Role::get_roles()); ?>
        </ul>
    </div>
    <?php include $config['file']['search_overall_panel_musician']; ?>
    <?php include $config['file']['search_overall_panel_band']; ?>
    <?php include $config['file']['search_overall_panel_agent']; ?>
    
</div>
<br><br><br><br><br><br><br><br><br><br>
<div id="search_overall_result">Searching, please wait ...</div>
<br>


<div id="search_overall_helper">
    <b>Role: </b><div id="search_overall_role_filtered"></div>
    -------------------------<b>Musician selections</b> -----------------------
    <?php
    Presentation::show_opts_selected_ov_search_age($pre_id_panel_mus);
    Presentation::show_opts_selected_ov_search_location($pre_id_panel_mus);
    Presentation::show_opts_selected_ov_search_gender($pre_id_panel_mus);
    Presentation::show_opts_selected_ov_search_instrument($pre_id_panel_mus);
    Presentation::show_opts_selected_ov_search_genre($pre_id_panel_mus);
    ?>
    -------------------------<b>Band selections</b> ---------------------------
    <?php
    Presentation::show_opts_selected_ov_search_location($pre_id_panel_band);
    Presentation::show_opts_selected_ov_search_genre($pre_id_panel_band);
    ?>
    -------------------------<b>Agent selections</b> --------------------------
    <?php
    Presentation::show_opts_selected_ov_search_age($pre_id_panel_agent);
    Presentation::show_opts_selected_ov_search_location($pre_id_panel_agent);
    Presentation::show_opts_selected_ov_search_gender($pre_id_panel_agent);
    Presentation::show_opts_selected_ov_search_genre($pre_id_panel_agent);
    ?>
</div>

