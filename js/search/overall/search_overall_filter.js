// pre id
var pre_id_ov_search_filter_role_panel = '#search_overall_filter_panel_';
// role panel
var id_ov_search_filter_panel_role = pre_id_ov_search_filter_role_panel + 'roles';
// musician
var id_ov_search_filter_panel_musician_group = pre_id_ov_search_filter_role_panel + 'musician_group';
// band
var id_ov_search_filter_panel_band_group = pre_id_ov_search_filter_role_panel + 'band_group';
// agent
var id_ov_search_filter_panel_agent_group = pre_id_ov_search_filter_role_panel + 'agent_group';
// Default role
var id_ov_search_default_role = '#search_overall_role_filter_musician';
// Display default role
var id_ov_search_display_role = '#search_overall_role_filtered';
// search results
var id_ov_search_result = '#search_overall_result';
var id_ov_search_distances = '#search_overall_distances';

// no results
var no_res_msg = '<div class="ov_search_no_results"><b>No Results.</b><div>';

/*
 * **************************************************
 * Ready
 * **************************************************
 */

$(document).ready(function () {
    $('#search_overall_filter_panel li').css('cursor', 'pointer');
    $('#ov_search_sort_by li').css('cursor', 'pointer');
    set_ov_search_default_values();
    set_ov_search_selected_values();
    ov_search_hide_and_show_panels();
    ov_search_hide_and_show_panels_on_change();
    ov_search_send_filtered_data_to_php();
});

function ov_search_hide_and_show_panels() {
    var role = $(id_ov_search_display_role).text();
    role = prepare_str_comparison(role);
    switch (role) {
        case 'musician':
            $(id_ov_search_filter_panel_musician_group).show();
            $(id_ov_search_filter_panel_band_group).hide();
            $(id_ov_search_filter_panel_agent_group).hide();
            break;
        case 'band':
            $(id_ov_search_filter_panel_band_group).show();
            $(id_ov_search_filter_panel_musician_group).hide();
            $(id_ov_search_filter_panel_agent_group).hide();
            break;
        case 'agent':
            $(id_ov_search_filter_panel_agent_group).show();
            $(id_ov_search_filter_panel_band_group).hide();
            $(id_ov_search_filter_panel_musician_group).hide();
            break;
        default:
            break;
    }
}

function ov_search_hide_and_show_panels_on_change() {
    $(id_ov_search_filter_panel_role).on('click', 'li', function (e) {
        e.preventDefault();
        ov_search_hide_and_show_panels();
    });
}


function set_ov_search_default_values() {
    set_filter_panel_default_value(id_ov_search_default_role, id_ov_search_display_role);
    set_ov_search_default_values_musician();
    set_ov_search_default_values_band();
    set_ov_search_default_values_agent();
}



function set_ov_search_selected_values() {
    // Role
    set_selected(id_ov_search_filter_panel_role);
    set_selected_to_display(id_ov_search_filter_panel_role, id_ov_search_display_role);
    set_ov_search_selected_values_musician();
    set_ov_search_selected_values_band();
    set_ov_search_selected_values_agent();

}

function user_can_search_by_proximity() {
    if (user_can_search_by_prox == 1) {
        return true;
    }
    return false;
}

/*
 * ************************************************************************
 * Age
 * ************************************************************************
 */

function set_ov_search_selected_age(str, id_age_from, id_age_to) {
    switch (str) {
        case 'all':
            return 'all';
        default:
            min = $(id_age_from).val();
            max = $(id_age_to).val();
            if (empty(min) && empty(max)) {
                return 'all';
            }
            return 'interval';
    }
}

/*
 * ************************************************************************
 * Location
 * ************************************************************************
 */

function set_ov_search_selected_location(str, id_location_input, id_alert) {
    switch (str) {
        case 'all':
            $(id_alert).hide('slow');
            return 'all';
        case 'proximity':
            if (!user_can_search_by_proximity()) {
                $(id_alert).show('slow');
            } else {
                $(id_alert).hide('slow');
            }
            return 'proximity';
        default:
            $(id_alert).hide('slow');
            detail = $(id_location_input).val();
            if (empty(detail)) {
                return 'all';
            }
//            $(id_location_input).prop('title', detail);
//            $(id_location_input).tooltip();
            return 'detail';
    }
}

/*
 * ************************************************************************
 * Instrument
 * ************************************************************************
 */
function set_ov_search_selected_instrument(str, id_inst_select) {
    switch (str) {
        case 'all':
            return 'all';
        default:
            inst = $(id_inst_select).val();
            if (empty(inst)) {
                return 'all';
            }
            return 'detail';
    }
}

/*
 * ************************************************************************
 * Genre
 * ************************************************************************
 */
function set_ov_search_selected_genre(str, id_genre_select) {
    switch (str) {
        case 'all':
            return 'all';
        default:
            genre = $(id_genre_select).val();
            if (empty(genre)) {
                return 'all';
            }
            return 'detail';
    }
}

function ov_search_get_role_selected() {
    var role = $(id_ov_search_filter_panel_role).find('.selected').html();
    return prepare_str_comparison(role);
}

function ov_search_get_location_input(id_loc_input) {
    $(id_loc_input).keyup(function () {
        var val = $(this).val();
        // opt 1
//        $(this).val(val + ' ');
//        $(this).val(val);

        // opt 2
//        $('#search_overall_filter_panel_musician_location_default').click();
//        $(this).click();
//        alert(val);

    });
}

function ov_search_send_filtered_data_to_php() {
    var role = ov_search_get_role_selected();
    var data_send = {};
    switch (role) {
        case 'musician':
            data_send = ov_search_set_to_send_filtered_data_musician();
            break;
        case 'band':
            data_send = ov_search_set_to_send_filtered_data_band();
            break;
        case 'agent':
            data_send = ov_search_set_to_send_filtered_data_agent();
            break;
        default:
            data_send = {role: 'error ov_search_send_filtered_data_to_php()'};
            break;
    }
    ov_search_post(data_send);
}

function ov_search_post(data_send) {
    $(id_ov_search_result).html('Searching, please wait ...');
    if (!ov_search_location_is_valid(data_send)) {
        ov_search_no_results();
        return false;
    }

    $.post(urls.search_overall_get_result, data_send, function (data) {
        ov_search_set_results_table(data, data_send);
    });
}

function ov_search_location_is_valid(data_send) {
    var type = data_send.loc_type;
    var opt = data_send.loc_opt;

    if (opt == 'detail') {
        if (type == 'no_type') {
            return false;
        }
    } else if (opt == 'proximity') {
        return user_can_search_by_proximity();
    }
    return true;
}

function ov_search_no_results() {
    $(id_ov_search_result).html(no_res_msg);
}

function ov_search_set_results_table(data, data_send) {
    var arr = JSON.parse(data);
    var n = arr.length;
//    var res = 'Results: ' + n + '<br><br>';
    var res = '';
    if (n == 0) {
        $(id_ov_search_result).html(no_res_msg);
        return;
    }
//    res += '<table class=\'ov_search_results_table\' id="ov_search_results_table_id">'
    res += '<table>';
    res += '<thead>';
    res += ov_search_get_table_headers();
    var i = 0;
    res += '</thead>';
    res += '<tbody>';
    for (i = 0; i <= n; i++) {
        var obj = arr[i];
        res += '<tr>';
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop)) {
                if (ov_search_result_ignore_field(prop)) {
                    // do nothing
                } else {
                    res += ov_search_set_results_table_td(obj, prop, data_send);
                }
            }
            var loc_opt = data_send.loc_opt;
            var distance_km = ov_search_get_distance(loc_opt, prop, obj[prop]);
            res += ov_search_get_distance_to_td(distance_km);
        }
        res += '</tr>';
    }
    res += '</tbody>';
    res += '</table>';
    $(id_ov_search_result).html(res);
}


function ov_search_get_table_headers() {
    var role = ov_search_get_role_selected();
    switch (role) {
        case 'musician':
            return ov_search_get_musician_table_headers();
            return [];
        case 'band':
            return ov_search_get_band_table_headers();
            return [];
        case 'agent':
            return ov_search_get_agent_table_headers();
            return [];
        default:
            break;
    }
}

function ov_search_result_ignore_field(field) {
    var ignore = [
        'username',
        'last_name',
        'country',
        'city_state'
    ];
    if ($.inArray(field, ignore) == -1) {
        return false;
    }
    return true;
}

function ov_search_set_results_table_td(obj, prop, data_send) {
    switch (prop) {
        case 'birth_date':
            var age = get_age_from_birth_date(obj[prop]);
            return '<td>' + age + '</td>';
        case 'first_name':
            var name = ov_search_get_full_name(obj);
            var name_link = ov_search_name_to_link(name, obj);
            return '<td>' + name_link + '</td>';
        case 'name':
            var band_name_link = ov_search_name_to_link(obj['name'], obj);
            return '<td>' + band_name_link + '</td>';
        case 'region':
            var location = obj['city_state'] + ' (' + obj['country'] + ')';
            return '<td>' + location + '</td>';
        default:
            return '<td>' + obj[prop] + '</td>';
    }
}

function ov_search_name_to_link(name, obj) {
    var href = urls.check_user_profile + obj['username'];
    return '<a href="' + href + '">' + name + '</a>';
}

function ov_search_username_to_link(username) {
    var href = urls.check_user_profile + username;
    return '<a href="' + href + '">' + username + '</a>';
}

function ov_search_get_full_name(obj) {
    var last_name = obj['last_name'];
    if (empty(last_name)) {
        return obj['first_name'];
    }
    return obj['first_name'] + ' ' + last_name;
}

function ov_search_get_distance(loc_opt, prop, obj_prop) {
    if (loc_opt == 'proximity' && prop == 'city_state') {
        var city_test = obj_prop;
        if (city_test == user_city_state) {
            return 1;
        } else {
            return ov_search_get_distance_by_country(city_test, user_city_state);
        }
    }
    return false;
}

function ov_search_get_distance_by_country(city_test, user_city_state) {

    switch (user_country) {
        case 'United States':
            return usa_get_distance_between_cities(city_test, user_city_state);
        default:
            return 99999999;
    }
}

function ov_search_get_distance_to_td(distance) {
    if (distance != false) {
        var distance_ml = Math.ceil(km_to_miles(distance));
        return '<td>' +
                Math.ceil(distance) +
                '</td><td>' +
                distance_ml +
                '</td>';
    }
    return '';
}



