// pre id
var pre_id_ov_search_filter_panel_agent = '#search_overall_filter_panel_agent_';
// age 
var id_ov_search_filter_panel_agent_age = pre_id_ov_search_filter_panel_agent + 'age';
var id_ov_search_default_agent_age = pre_id_ov_search_filter_panel_agent + 'age_default';
var id_ov_search_agent_age_from = pre_id_ov_search_filter_panel_agent + 'age_from';
var id_ov_search_agent_age_to = pre_id_ov_search_filter_panel_agent + 'age_to';
var id_ov_search_agent_age_alert_invalid = pre_id_ov_search_filter_panel_agent + 'alert_invalid';
// results - age
var id_ov_search_display_agent_age_opt = pre_id_ov_search_filter_panel_agent + 'age_option_filtered';
var id_ov_search_display_agent_age_min = pre_id_ov_search_filter_panel_agent + 'age_min_filtered';
var id_ov_search_display_agent_age_max = pre_id_ov_search_filter_panel_agent + 'age_max_filtered';
// location
var id_ov_search_filter_panel_agent_location = pre_id_ov_search_filter_panel_agent + 'location';
var id_ov_search_default_agent_location = pre_id_ov_search_filter_panel_agent + 'location_default';
var id_ov_search_agent_location_input = pre_id_ov_search_filter_panel_agent + 'location_input';
var id_ov_search_agent_location_cant_search_by_prox = pre_id_ov_search_filter_panel_agent + 'cant_search_by_prox';
// results - location
var id_ov_search_display_agent_location_opt = pre_id_ov_search_filter_panel_agent + 'location_opt_filtered';
var id_ov_search_display_agent_location = pre_id_ov_search_filter_panel_agent + 'location_filtered';
// gender
var id_ov_search_filter_panel_agent_gender = pre_id_ov_search_filter_panel_agent + 'gender';
var id_ov_search_default_agent_gender = pre_id_ov_search_filter_panel_agent + 'gender_default';
// results - gender
var id_ov_search_display_agent_gender_opt = pre_id_ov_search_filter_panel_agent + 'gender_opt_filtered';
// genre
var id_ov_search_filter_panel_agent_genre = pre_id_ov_search_filter_panel_agent + 'genre';
var id_ov_search_default_agent_genre = pre_id_ov_search_filter_panel_agent + 'genre_default';
var id_ov_search_agent_genre = pre_id_ov_search_filter_panel_agent + 'genre_sel';
// results - genre
var id_ov_search_display_agent_genre_opt = pre_id_ov_search_filter_panel_agent + 'genre_opt_filtered';
var id_ov_search_display_agent_genre = pre_id_ov_search_filter_panel_agent + 'genre_filtered';

/*
 * ************************************************************************
 * ************************************************************************
 */

function set_ov_search_default_values_agent() {
    // age
    set_filter_panel_default_value(id_ov_search_default_agent_age, id_ov_search_display_agent_age_opt);
    // location
    locations_to_input(id_ov_search_agent_location_input);
    set_filter_panel_default_value(id_ov_search_default_agent_location, id_ov_search_display_agent_location_opt);
    // gender
    set_filter_panel_default_value(id_ov_search_default_agent_gender, id_ov_search_display_agent_gender_opt);
    // genre
    set_filter_panel_default_value(id_ov_search_default_agent_genre, id_ov_search_display_agent_genre_opt);

}
/*
 * ************************************************************************
 * ************************************************************************
 */

function set_ov_search_selected_values_agent() {
    /*
     * ************************************************************************
     * Age
     * ************************************************************************
     */
    // age - set selected
    set_selected(id_ov_search_filter_panel_agent_age);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_agent_age, id_ov_search_display_agent_age_opt);

    // age - to display
    set_selected_to_display_from_select(id_ov_search_agent_age_from, id_ov_search_display_agent_age_min);
    set_selected_to_display_from_select(id_ov_search_agent_age_to, id_ov_search_display_agent_age_max);
    validate_age_interval(id_ov_search_agent_age_from, id_ov_search_agent_age_to, id_ov_search_agent_age_alert_invalid);

    /*
     * ************************************************************************
     * Location
     * ************************************************************************
     */
    // location - set selected
    set_selected(id_ov_search_filter_panel_agent_location);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_agent_location, id_ov_search_display_agent_location_opt);

    // location - to display
    set_selected_to_display_from_select(id_ov_search_agent_location_input, id_ov_search_display_agent_location);

    /*
     * ************************************************************************
     * Gender
     * ************************************************************************
     */
    // gender - set selected
    set_selected(id_ov_search_filter_panel_agent_gender);
    set_selected_to_display(id_ov_search_filter_panel_agent_gender, id_ov_search_display_agent_gender_opt);
    /*
     * ************************************************************************
     * Genre
     * ************************************************************************
     */
    // genre - set selected
    set_selected(id_ov_search_filter_panel_agent_genre);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_agent_genre, id_ov_search_display_agent_genre_opt);

    // genre - to display
    set_selected_to_display_from_select(id_ov_search_agent_genre, id_ov_search_display_agent_genre);

}

/*
 * ************************************************************************
 * Age
 * ************************************************************************
 */

function set_ov_search_selected_age_agent(str) {
    return set_ov_search_selected_age(str, id_ov_search_agent_age_from, id_ov_search_agent_age_to);
}

/*
 * ************************************************************************
 * Location
 * ************************************************************************
 */

function set_ov_search_selected_location_agent(str) {
    return set_ov_search_selected_location(str, id_ov_search_agent_location_input, id_ov_search_agent_location_cant_search_by_prox);
}

/*
 * ************************************************************************
 * Genre
 * ************************************************************************
 */
function set_ov_search_selected_genre_agent(str) {
    return set_ov_search_selected_genre(str, id_ov_search_agent_genre);
}


function ov_search_set_to_send_filtered_data_agent() {
    var loc = $(id_ov_search_agent_location_input).val();
    return {
        role: 'agent',
        //////////////////////////////
        // age
        //////////////////////////////
        age_opt: $(id_ov_search_display_agent_age_opt).html(),
        age_min: $(id_ov_search_display_agent_age_min).html(),
        age_max: $(id_ov_search_display_agent_age_max).html(),
        //////////////////////////////
        // location
        //////////////////////////////
        loc_opt: $(id_ov_search_display_agent_location_opt).html(),
        loc: loc,
        loc_type: get_type_location(loc),
        loc_detail_city: get_city_from_city_and_country(loc),
        loc_detail_country: get_country_from_city_and_country(loc),
        //////////////////////////////
        // gender
        //////////////////////////////
        gender: $(id_ov_search_display_agent_gender_opt).html(),
        //////////////////////////////
        // genre
        //////////////////////////////
        genre_opt: $(id_ov_search_display_agent_genre_opt).html(),
        genre: $(id_ov_search_display_agent_genre).html(),
    };
}

function ov_search_get_agent_table_headers() {
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


