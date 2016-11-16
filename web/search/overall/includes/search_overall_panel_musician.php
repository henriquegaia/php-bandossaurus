<?php
$min_age = Musician::MIN_AGE;
$max_age = Musician::MAX_AGE;
?>

<div id="<?php echo $pre_id_panel_mus . 'group'; ?>">
    <?php
    Presentation::overall_search_panel_age($pre_id_panel_mus, $min_age, $max_age);
    Presentation::overall_search_panel_location($pre_id_panel_mus);
    Presentation::overall_search_panel_gender($pre_id_panel_mus);
    Presentation::overall_search_panel_instrument($pre_id_panel_mus);
    Presentation::overall_search_panel_genre($pre_id_panel_mus);
    ?>
</div>


