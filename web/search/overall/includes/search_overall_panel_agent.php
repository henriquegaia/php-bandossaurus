<?php
$min_age = Agent::MIN_AGE;
$max_age = Agent::MAX_AGE;
?>

<div id="<?php echo $pre_id_panel_agent . 'group'; ?>">
    <?php
    Presentation::overall_search_panel_age($pre_id_panel_agent, $min_age, $max_age);
    Presentation::overall_search_panel_location($pre_id_panel_agent);
    Presentation::overall_search_panel_gender($pre_id_panel_agent);
    Presentation::overall_search_panel_genre($pre_id_panel_agent);
    ?>
</div>
