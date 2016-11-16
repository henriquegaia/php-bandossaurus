// pre id
var pre_id_ov_search_filter_panel_musician = '#search_overall_filter_panel_musician_';
// age 
var id_ov_search_filter_panel_musician_age = pre_id_ov_search_filter_panel_musician + 'age';
var id_ov_search_default_musician_age = pre_id_ov_search_filter_panel_musician + 'age_default';
var id_ov_search_musician_age_from = pre_id_ov_search_filter_panel_musician + 'age_from';
var id_ov_search_musician_age_to = pre_id_ov_search_filter_panel_musician + 'age_to';
var id_ov_search_musician_age_alert_invalid = pre_id_ov_search_filter_panel_musician + 'alert_invalid';
// results - age
var id_ov_search_display_musician_age_opt = pre_id_ov_search_filter_panel_musician + 'age_option_filtered';
var id_ov_search_display_musician_age_min = pre_id_ov_search_filter_panel_musician + 'age_min_filtered';
var id_ov_search_display_musician_age_max = pre_id_ov_search_filter_panel_musician + 'age_max_filtered';
// location
var id_ov_search_filter_panel_musician_location = pre_id_ov_search_filter_panel_musician + 'location';
var id_ov_search_default_musician_location = pre_id_ov_search_filter_panel_musician + 'location_default';
var id_ov_search_musician_location_input = pre_id_ov_search_filter_panel_musician + 'location_input';
var id_ov_search_musician_location_cant_search_by_prox = pre_id_ov_search_filter_panel_musician + 'cant_search_by_prox';
// results - location
var id_ov_search_display_musician_location_opt = pre_id_ov_search_filter_panel_musician + 'location_opt_filtered';
var id_ov_search_display_musician_location = pre_id_ov_search_filter_panel_musician + 'location_filtered';
// gender
var id_ov_search_filter_panel_musician_gender = pre_id_ov_search_filter_panel_musician + 'gender';
var id_ov_search_default_musician_gender = pre_id_ov_search_filter_panel_musician + 'gender_default';
// results - gender
var id_ov_search_display_musician_gender_opt = pre_id_ov_search_filter_panel_musician + 'gender_opt_filtered';
// instrument
var id_ov_search_filter_panel_musician_instrument = pre_id_ov_search_filter_panel_musician + 'instrument';
var id_ov_search_default_musician_instrument = pre_id_ov_search_filter_panel_musician + 'instrument_default';
var id_ov_search_musician_instrument = pre_id_ov_search_filter_panel_musician + 'instrument_sel';
// results - instrument
var id_ov_search_display_musician_instrument_opt = pre_id_ov_search_filter_panel_musician + 'instrument_opt_filtered';
var id_ov_search_display_musician_instrument = pre_id_ov_search_filter_panel_musician + 'instrument_filtered';
// genre
var id_ov_search_filter_panel_musician_genre = pre_id_ov_search_filter_panel_musician + 'genre';
var id_ov_search_default_musician_genre = pre_id_ov_search_filter_panel_musician + 'genre_default';
var id_ov_search_musician_genre = pre_id_ov_search_filter_panel_musician + 'genre_sel';
// results - genre
var id_ov_search_display_musician_genre_opt = pre_id_ov_search_filter_panel_musician + 'genre_opt_filtered';
var id_ov_search_display_musician_genre = pre_id_ov_search_filter_panel_musician + 'genre_filtered';

/*
 * ************************************************************************
 * ************************************************************************
 */

function set_ov_search_default_values_musician() {
    // age
    set_filter_panel_default_value(id_ov_search_default_musician_age, id_ov_search_display_musician_age_opt);
    // location
    locations_to_input(id_ov_search_musician_location_input);
    set_filter_panel_default_value(id_ov_search_default_musician_location, id_ov_search_display_musician_location_opt);
    // gender
    set_filter_panel_default_value(id_ov_search_default_musician_gender, id_ov_search_display_musician_gender_opt);
    // instrument
    set_filter_panel_default_value(id_ov_search_default_musician_instrument, id_ov_search_display_musician_instrument_opt);
    // genre
    set_filter_panel_default_value(id_ov_search_default_musician_genre, id_ov_search_display_musician_genre_opt);

}
/*
 * ************************************************************************
 * ************************************************************************
 */

function set_ov_search_selected_values_musician() {
    /*
     * ************************************************************************
     * Age
     * ************************************************************************
     */
    // age - set selected
    set_selected(id_ov_search_filter_panel_musician_age);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_musician_age, id_ov_search_display_musician_age_opt);

    // age - to display
    set_selected_to_display_from_select(id_ov_search_musician_age_from, id_ov_search_display_musician_age_min);
    set_selected_to_display_from_select(id_ov_search_musician_age_to, id_ov_search_display_musician_age_max);
    validate_age_interval(id_ov_search_musician_age_from, id_ov_search_musician_age_to, id_ov_search_musician_age_alert_invalid);

    /*
     * ************************************************************************
     * Location
     * ************************************************************************
     */
    // location - set selected
    set_selected(id_ov_search_filter_panel_musician_location);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_musician_location, id_ov_search_display_musician_location_opt);

    // location - to display
    set_selected_to_display_from_select(id_ov_search_musician_location_input, id_ov_search_display_musician_location);
    ov_search_get_location_input(id_ov_search_musician_location_input);
    /*
     * ************************************************************************
     * Gender
     * ************************************************************************
     */
    // gender - set selected
    set_selected(id_ov_search_filter_panel_musician_gender);
    set_selected_to_display(id_ov_search_filter_panel_musician_gender, id_ov_search_display_musician_gender_opt);

    /*
     * ************************************************************************
     * Instrument
     * ************************************************************************
     */
    // instrument - set selected
    set_selected(id_ov_search_filter_panel_musician_instrument);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_musician_instrument, id_ov_search_display_musician_instrument_opt);

    // instrument - to display
    set_selected_to_display_from_select(id_ov_search_musician_instrument, id_ov_search_display_musician_instrument);

    /*
     * ************************************************************************
     * Genre
     * ************************************************************************
     */
    // genre - set selected
    set_selected(id_ov_search_filter_panel_musician_genre);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_musician_genre, id_ov_search_display_musician_genre_opt);

    // genre - to display
    set_selected_to_display_from_select(id_ov_search_musician_genre, id_ov_search_display_musician_genre);

}

/*
 * ************************************************************************
 * Age
 * ************************************************************************
 */

function set_ov_search_selected_age_musician(str) {
    return set_ov_search_selected_age(str, id_ov_search_musician_age_from, id_ov_search_musician_age_to);
}

/*
 * ************************************************************************
 * Location
 * ************************************************************************
 */

function set_ov_search_selected_location_musician(str) {
    return set_ov_search_selected_location(str, id_ov_search_musician_location_input, id_ov_search_musician_location_cant_search_by_prox);
}

/*
 * ************************************************************************
 * Instrument
 * ************************************************************************
 */
function set_ov_search_selected_instrument_musician(str) {
    return set_ov_search_selected_instrument(str, id_ov_search_musician_instrument);
}

/*
 * ************************************************************************
 * Genre
 * ************************************************************************
 */
function set_ov_search_selected_genre_musician(str) {
    return set_ov_search_selected_genre(str, id_ov_search_musician_genre);
}

function ov_search_set_to_send_filtered_data_musician() {
    //$(id_display_selected).html();
    var loc = $(id_ov_search_musician_location_input).val();
    return {
        role: 'musician',
        //////////////////////////////
        // age
        //////////////////////////////
        age_opt: $(id_ov_search_display_musician_age_opt).html(),
        age_min: $(id_ov_search_display_musician_age_min).html(),
        age_max: $(id_ov_search_display_musician_age_max).html(),
        //////////////////////////////
        // location
        //////////////////////////////
        loc_opt: $(id_ov_search_display_musician_location_opt).html(),
        loc: loc,
        loc_type: get_type_location(loc),
        loc_detail_city: get_city_from_city_and_country(loc),
        loc_detail_country: get_country_from_city_and_country(loc),
        //////////////////////////////
        // gender
        //////////////////////////////
        gender: $(id_ov_search_display_musician_gender_opt).html(),
        //////////////////////////////
        // instrument
        //////////////////////////////
        inst_opt: $(id_ov_search_display_musician_instrument_opt).html(),
        inst: $(id_ov_search_display_musician_instrument).html(),
        //////////////////////////////
        // genre
        //////////////////////////////
        genre_opt: $(id_ov_search_display_musician_genre_opt).html(),
        genre: $(id_ov_search_display_musician_genre).html(),
    };
}

function ov_search_get_musician_table_headers() {
    var array = array_to_th([
        'name',
        'age',
        'gender',
        'location',
        'km',
        'miles'
    ]);

    return array;
}




