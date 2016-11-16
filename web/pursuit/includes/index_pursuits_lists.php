<?php
$musician_to_band = Pursuit::get_all_musician_pursuit_band(true);
$musician_to_agent = Pursuit::get_all_musician_pursuit_agent(true);
$band_to_musician = Pursuit::get_all_band_pursuit_musician(true);
$band_to_agent = Pursuit::get_all_band_pursuit_agent(true);
$agent_to_musician = Pursuit::get_all_agent_pursuit_musician(true);
$agent_to_band = Pursuit::get_all_agent_pursuit_band(true);

$types = [
    0 => 'mus_ban',
    1 => 'mus_age',
    2 => 'ban_mus',
    3 => 'ban_age',
    4 => 'age_mus',
    5 => 'age_ban'
];
?>
<div class="container_link_lists">
    <?php
    Presentation::array_pursues_to_link_list($musician_to_band, 'Musicians looking for Bands', 1);
    Presentation::array_pursues_to_link_list($musician_to_agent, 'Musicians looking for Agents', 2);
    Presentation::array_pursues_to_link_list($band_to_musician, 'Bands looking for Musicians', 3);
    Presentation::array_pursues_to_link_list($band_to_agent, 'Bands looking for Agents', 4);
    Presentation::array_pursues_to_link_list($agent_to_musician, 'Agents looking for Musicians', 5);
    Presentation::array_pursues_to_link_list($agent_to_band, 'Agents looking for Bands', 6);
    ?>
</div>