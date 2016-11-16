var settings_values = [];

var region_txt = '';
var country_txt = '';
var city_state_txt = '';

$(document).ready(function () {

    if ($("#settings_form").length) {
        region_txt = settings_values['region'];
        country_txt = settings_values['country'];
        city_state_txt = settings_values['city_state'];
        populate_location_selects(region_txt, country_txt, city_state_txt);
    }

});