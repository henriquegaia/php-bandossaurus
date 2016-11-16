<?php

$regex = new Regex;
$mode = 'settings';
//basic stuff
Presentation::get_label_and_input_txt('name', 'Band Name', '', $regex->get_regex_band_name(), $mode);
$min_age = Band::MIN_AGE;
$max_age = Band::MAX_AGE;
Presentation::get_label_and_input_date('formation_date', 'Date of Formation', $min_age, $max_age, true, $mode);
Presentation::get_label_and_numeric_select('number_elements', 'Number of Elements in the Band', 1, BAND::MAX_ELEM, $mode);

