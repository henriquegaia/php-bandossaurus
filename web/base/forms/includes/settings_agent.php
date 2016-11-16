<?php

$regex = new Regex;
$mode='settings';
//basic stuff
$min_age = Agent::MIN_AGE;
$max_age = Agent::MAX_AGE;
Presentation::get_label_and_input_date('birth_date', 'Date of Birth', $min_age, $max_age, true, $mode);
Presentation::get_label_and_arr_fil_select('gender', Gender::get_all(), 'Gender', $mode);


