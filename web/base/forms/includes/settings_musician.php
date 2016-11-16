<?php

$regex = new Regex;

//basic stuff
$min_age = Musician::MIN_AGE;
$max_age = Musician::MAX_AGE;
$mode = 'settings';
Presentation::get_label_and_input_date('birth_date', 'Date of Birth', $min_age, $max_age, true, $mode);
Presentation::get_label_and_arr_fil_select('gender', Gender::get_all(), 'Gender', $mode);


