// pre id
var pre_id_ov_search_filter_panel_band = '#search_overall_filter_panel_band_';
// location
var id_ov_search_filter_panel_band_location = pre_id_ov_search_filter_panel_band + 'location';
var id_ov_search_default_band_location = pre_id_ov_search_filter_panel_band + 'location_default';
var id_ov_search_band_location_input = pre_id_ov_search_filter_panel_band + 'location_input';
var id_ov_search_band_location_cant_search_by_prox = pre_id_ov_search_filter_panel_band + 'cant_search_by_prox';
// results - location
var id_ov_search_display_band_location_opt = pre_id_ov_search_filter_panel_band + 'location_opt_filtered';
var id_ov_search_display_band_location = pre_id_ov_search_filter_panel_band + 'location_filtered';
// genre
var id_ov_search_filter_panel_band_genre = pre_id_ov_search_filter_panel_band + 'genre';
var id_ov_search_default_band_genre = pre_id_ov_search_filter_panel_band + 'genre_default';
var id_ov_search_band_genre = pre_id_ov_search_filter_panel_band + 'genre_sel';
// results - genre
var id_ov_search_display_band_genre_opt = pre_id_ov_search_filter_panel_band + 'genre_opt_filtered';
var id_ov_search_display_band_genre = pre_id_ov_search_filter_panel_band + 'genre_filtered';

/*
 * ************************************************************************
 * ************************************************************************
 */

function set_ov_search_default_values_band() {
    // location
    locations_to_input(id_ov_search_band_location_input);
    set_filter_panel_default_value(id_ov_search_default_band_location, id_ov_search_display_band_location_opt);
    // genre
    set_filter_panel_default_value(id_ov_search_default_band_genre, id_ov_search_display_band_genre_opt);
}
/*
 * ************************************************************************
 * ************************************************************************
 */

function set_ov_search_selected_values_band() {

    /*
     * ************************************************************************
     * Location
     * ************************************************************************
     */
    // location - set selected
    set_selected(id_ov_search_filter_panel_band_location);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_band_location, id_ov_search_display_band_location_opt);

    // location - to display
    set_selected_to_display_from_select(id_ov_search_band_location_input, id_ov_search_display_band_location);
    /*
     * ************************************************************************
     * Genre
     * ************************************************************************
     */
    // genre - set selected
    set_selected(id_ov_search_filter_panel_band_genre);
    set_selected_to_display_from_panel_with_select(id_ov_search_filter_panel_band_genre, id_ov_search_display_band_genre_opt);

    // genre - to display
    set_selected_to_display_from_select(id_ov_search_band_genre, id_ov_search_display_band_genre);

}


/*
 * ************************************************************************
 * Location
 * ************************************************************************
 */

function set_ov_search_selected_location_band(str) {
    return set_ov_search_selected_location(str, id_ov_search_band_location_input, id_ov_search_band_location_cant_search_by_prox);
}


/*
 * ************************************************************************
 * Genre
 * ************************************************************************
 */
function set_ov_search_selected_genre_band(str) {
    return set_ov_search_selected_genre(str, id_ov_search_band_genre);
}

function ov_search_set_to_send_filtered_data_band() {
    var loc = $(id_ov_search_band_location_input).val();
    return {
        role: 'band',
        //////////////////////////////
        // location
        //////////////////////////////
        loc_opt: $(id_ov_search_display_band_location_opt).html(),
        loc: loc,
        loc_type: get_type_location(loc),
        loc_detail_city: get_city_from_city_and_country(loc),
        loc_detail_country: get_country_from_city_and_country(loc),
        //////////////////////////////
        // genre
        //////////////////////////////
        genre_opt: $(id_ov_search_display_band_genre_opt).html(),
        genre: $(id_ov_search_display_band_genre).html(),
    };
}

function ov_search_get_band_table_headers() {
    var array = array_to_th([
        'band name',
        'location',
        'km',
        'miles'
    ]);

    return array;
}


