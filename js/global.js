var user_role;
var user_can_search_by_prox;// comes from php
var user_region;
var user_country;
var user_city_state;

$(document).ready(function () {
    ////////////////////////////////////////
    // in case i want to have autocomplete in register for cities
    ////////////////////////////////////////
    cities_countries_to_input('#register_location_input');
    send_location_data_register_php('#register_location_input');
});
/*
 * **************************************************
 * Functions
 * **************************************************
 */
function prepare_str_comparison(str) {
    if (!empty(str)) {
        str = str.toLowerCase();
        str = str.trim();
    }
    return str;
}

function set_selected(id_filter_panel) {
    $(id_filter_panel).on('click', 'li', function (e) {
        e.preventDefault();
        $(this).addClass("selected").siblings().removeClass("selected");
        if (id_filter_panel == id_ov_search_filter_panel_role) {
            ov_search_send_filtered_data_to_php();
        }
    });
}

function set_selected_to_display(id_filter_panel, id_display_selected) {
    var str = '';
    $(id_filter_panel).on('click', 'li', function (e) {
        e.preventDefault();
        str = $(this).html();
        str = prepare_str_comparison(str);
        $(id_display_selected).text(str);
        ov_search_send_filtered_data_to_php();
    });
}

function set_selected_to_display_from_panel_with_select(id_filter_panel, id_display_selected) {
    var str = '';
    $(id_filter_panel).on('click', 'li', function (e) {
        e.preventDefault();
        str = $(this).html();
        str = prepare_str_comparison(str);
        switch (id_filter_panel) {
            ///////////////////////
            // musician
            ///////////////////////
            case id_ov_search_filter_panel_musician_age:
                str = set_ov_search_selected_age_musician(str);
                break;
            case id_ov_search_filter_panel_musician_location:
                str = set_ov_search_selected_location_musician(str);
                break;
            case id_ov_search_filter_panel_musician_instrument:
                str = set_ov_search_selected_instrument_musician(str);
                break;
            case id_ov_search_filter_panel_musician_genre:
                str = set_ov_search_selected_genre_musician(str);
                break;
                ///////////////////////
                // band
                ///////////////////////
            case id_ov_search_filter_panel_band_location:
                str = set_ov_search_selected_location_band(str);
                break;
            case id_ov_search_filter_panel_band_genre:
                str = set_ov_search_selected_genre_band(str);
                break;
                ///////////////////////
                //agent
                ///////////////////////
            case id_ov_search_filter_panel_agent_age:
                str = set_ov_search_selected_age_agent(str);
                break;
            case id_ov_search_filter_panel_agent_location:
                str = set_ov_search_selected_location_agent(str);
                break;
            case id_ov_search_filter_panel_agent_genre:
                str = set_ov_search_selected_genre_agent(str);
                break;
            default:
                alert('id_filter_panel: set_selected_to_display_from_panel_with_select()');
                break;
        }
        $(id_display_selected).text(str);
        ov_search_send_filtered_data_to_php();
    });
}

function set_selected_to_display_from_select(id_select, id_display) {
    $(id_select).change(function () {
        var sel = $(this).val();
        $(id_display).text(sel);
        ov_search_send_filtered_data_to_php();
    });
}

function set_filter_panel_default_value($id_item, id_display_selected) {
    $($id_item).addClass("selected").siblings().removeClass("selected");
    var str = $($id_item).html();
    $(id_display_selected).text(str);
}

function validate_age_interval(id_select_min, id_select_max, id_alert_invalid) {
    var min, max;
    $(id_select_min).change(function () {
        min = $(this).val();
        show_alert_on_invalid_age_interval(min, max, id_alert_invalid);
    });
    $(id_select_max).change(function () {
        max = $(this).val();
        show_alert_on_invalid_age_interval(min, max, id_alert_invalid);
    });
}

function max_equal_or_bigger(min, max) {
    if (max == null || min == null ||
            max == '' || min == '' ||
            max == 'undefined' || min == 'undefined') {
        return true;
    }

    min = parseInt(min);
    max = parseInt(max);

    if (max >= min) {
        return true;
    }
    return false;
}

function show_alert_on_invalid_age_interval(min, max, id_alert_invalid) {
    if (max_equal_or_bigger(min, max) == false) {
        $(id_alert_invalid).show('slow');
    } else {
        $(id_alert_invalid).hide('slow');
    }
}

function empty(str) {
    if (str == null ||
            str == '' ||
            str == 'undefined') {
        return true;
    }
    return false;
}

function locations_to_input(id) {
    var all_locations = get_all_locations();
    location_auto_complete(id, all_locations);
}

function cities_countries_to_input(id) {
    var all_cities = get_all_cities();
    location_auto_complete(id, all_cities);
}

function location_auto_complete(id, data) {
    $(id).autocomplete({
        source: function (request, response) {
            var results = $.ui.autocomplete.filter(data, request.term);
            response(results.slice(0, 10));
        }
    });
}

function array_to_th(array) {
    var n = array.length;
    if (n == 0) {
        return;
    }

    var res = '';
    for (var i = 0; i < n; i++) {
        var f = array[i];
        var append = set_th_sort(f);
        res += '<th' + append + '>' + array[i] + '</th>';
    }
    return res;
}

function set_th_sort(field) {
    switch (field) {
        case 'km':
        case 'miles':
        case 'age':
            return ' data-sort="int" ';
        default:
            return ' data-sort="string" ';
    }
}
function get_age_from_birth_date(date) {
    var today = new Date();
    var birthDate = new Date(date);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function km_to_miles(km) {
    return km * 0.621371192;
}

function get_role() {
    $.post(urls.role, function (role) {
        user_role = JSON.parse(role);
        alert(user_role);
    });
}

function send_location_data_register_php(id) {
//    var btn_name = document.getElementsByName('submit_register');
//    $('form').submit(function () {
//        // get text written by user
//        // get region, country, city
//        var region = 'africa';
//        var country = 'algeria';
//        var city_state = 'algiers';
//        var data_send = {
//            region: region,
//            country: country,
//            city_state: city_state,
//            email:'xxxxxxxxx'
//        };
//        $.post(urls.register, data_send,function(){
//            alert(data_send);
//        });
//    });

}