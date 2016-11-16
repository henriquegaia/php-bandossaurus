<?php

$config = include dirname(dirname(dirname(__FILE__))) . "/core/config.php";
include $config["file"]["init"];
Security::protected_page();
include $config["file"]["ov_header"];

$is_premium = User::is_premium();
$role = User::get_role();
if (!$is_premium) {
    Presentation::print_page_title("Matches");
    switch ($role) {
        case "musician":
            //1 -----------------------------------------------------
            $intervals_1 = MatchMusicianBand::get_rates_intervals();
            $all_1 = MatchMusicianBand::get_all_rates_for_musician_ordered($session_user_id);
            $all_1_inter = Match::get_rates_by_intervals($all_1, $intervals_1);
            $append_1 = 'Bands';
            //2 -----------------------------------------------------
            $intervals_2 = MatchMusicianAgent::get_rates_intervals();
            $all_2 = MatchMusicianAgent::get_all_rates_for_musician_ordered($session_user_id);
            $all_2_inter = Match::get_rates_by_intervals($all_2, $intervals_2);
            $append_2 = 'Agents';
            break;
        case "band":
            //1 -----------------------------------------------------
            $intervals_1 = MatchMusicianBand::get_rates_intervals();
            $all_1 = MatchMusicianBand::get_all_rates_for_band_ordered($session_user_id);
            $all_1_inter = Match::get_rates_by_intervals($all_1, $intervals_1);
            $append_1 = 'Musicians';
            //2 -----------------------------------------------------
            $intervals_2 = MatchBandAgent::get_rates_intervals();
            $all_2 = MatchBandAgent::get_all_rates_for_band_ordered($session_user_id);
            $all_2_inter = Match::get_rates_by_intervals($all_2, $intervals_2);
            $append_2 = 'Agents';
            break;
        case "agent":
            //1 -----------------------------------------------------
            $intervals_1 = MatchMusicianAgent::get_rates_intervals();
            $all_1 = MatchMusicianAgent::get_all_rates_for_agent_ordered($session_user_id);
            $all_1_inter = Match::get_rates_by_intervals($all_1, $intervals_1);
            $append_1 = 'Musicians';
            //2 -----------------------------------------------------
            $intervals_2 = MatchBandAgent::get_rates_intervals();
            $all_2 = MatchBandAgent::get_all_rates_for_agent_ordered($session_user_id);
            $all_2_inter = Match::get_rates_by_intervals($all_2, $intervals_2);
            $append_2 = 'Bands';
            break;
        default:
            break;
    }

    echo Match::matches_by_intervals_to_string($all_1_inter, $append_1);
    echo "<br><br>";
    echo Match::matches_by_intervals_to_string($all_2_inter, $append_2);
    echo "<br><br>";
    echo "To know what are your best matches please ";
    Presentation::get_link_premium("become premium");
    echo ".";
} else {
    $top = Match::TOP_TO_SHOW;
    $key_musician = 'musician_id';
    $key_band = 'band_id';
    $key_agent = 'agent_id';

    switch ($role) {
        case "musician":
            //1 -----------------------------------------------------
            $title_1_append = "Bands";
            $rates_1 = MatchMusicianBand::get_top_rates_for_musician_ordered($session_user_id);
            $to_search_1 = $key_band;
            $type_1 = 1;
            //2 -----------------------------------------------------
            $title_2_append = "Agents";
            $rates_2 = MatchMusicianAgent::get_top_rates_for_musician_ordered($session_user_id);
            $to_search_2 = $key_agent;
            $type_2 = 2;
            break;
        case "band":
            //1 -----------------------------------------------------
            $title_1_append = "Musicians";
            $rates_1 = MatchMusicianBand::get_top_rates_for_band_ordered($session_user_id);
            $to_search_1 = $key_musician;
            $type_1 = 1;
            //2 -----------------------------------------------------
            $title_2_append = "Agents";
            $rates_2 = MatchBandAgent::get_top_rates_for_band_ordered($session_user_id);
            $to_search_2 = $key_agent;
            $type_2 = 3;
            break;
        case "agent":
            //1 -----------------------------------------------------
            $title_1_append = "Musician";
            $rates_1 = MatchMusicianAgent::get_top_rates_for_agent_ordered($session_user_id);
            $to_search_1 = $key_musician;
            $type_1 = 2;
            //2 -----------------------------------------------------
            $title_2_append = "Bands";
            $rates_2 = MatchBandAgent::get_top_rates_for_agent_ordered($session_user_id);
            $to_search_2 = $key_band;
            $type_2 = 3;
            break;
        default:
            break;
    }

    Presentation::print_page_title("Top $top Matches with $title_1_append");
    Presentation::get_table_top_matches_2($rates_1, $to_search_1, $type_1);
    Presentation::print_page_title("Top $top Matches with $title_2_append");
    Presentation::get_table_top_matches_2($rates_2, $to_search_2, $type_2);
}


include $config["file"]["ov_footer"];
