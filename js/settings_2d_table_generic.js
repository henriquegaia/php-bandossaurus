/*
 * ------------------------------------------------------------
 * These functions are called by external files related with
 * setting data
 * ------------------------------------------------------------
 */

/*
 * *************************************************************
 * 
 * *************************************************************
 */
function update_row(id_update_select, id_update_form, ids_forms) {

    $(id_update_select).change(function () {
        var selected_index = $(this)[0].selectedIndex;
        if (selected_index !== 0) {
            var i = selected_index - 1;
            switch (id_update_form) {
                case "#update_band_member_form":
                    fill_update_fields_settings_band_members(i);
                    break;
                case "#update_experience_musician_alone_form":
                    fill_update_fields_experience_musician_alone(i);
                    break;
                case "#update_experience_musician_bands_form":
                    fill_update_fields_experience_musician_bands(i);
                    break;
                case "#update_experience_band_form":
                    fill_update_fields_experience_band(i);
                    break;
                case "#update_experience_agent_form":
                    fill_update_fields_experience_agent(i);
                    break;
                case "#update_pursuit_form":
                    fill_update_fields_pursuit(i);
                    break;
                default:
                    alert('error: id_update_form')
                    break;
            }

            $(id_update_select.toString() + "_selected_row").attr('value', selected_index);
            hide_all_forms(ids_forms);
            $(id_update_form).show();
            scroll_to_form();

        } else {
            $(id_update_form).hide();
        }
    });
}

/*
 * *************************************************************
 * 
 * *************************************************************
 */
function create_row(id_create_button, id_create_form, ids_forms) {
    $(id_create_button).click(function () {
        hide_all_forms(ids_forms);
        $(id_create_form).show();
        scroll_to_form();
    });
}

/*
 * *************************************************************
 * 
 * *************************************************************
 */
function delete_row(id_delete_select, id_delete_form, arr_all, field_show, id_msg_dialog, ids_forms) {
    $(id_delete_select).change(function () {
        var selected_index = $(this)[0].selectedIndex;
        if (selected_index !== 0) {
//            var i = selected_index - 1;
//            var field_txt = arr_all[i][field_show].toString();
//            $(id_msg_dialog).text(field_txt);
            $(id_delete_select.toString() + "_selected_row").attr('value', selected_index);
            $(id_msg_dialog).text(selected_index);
            hide_all_forms(ids_forms);
            $(id_delete_form).show();
            scroll_to_form();
        } else {
            $(id_delete_form).hide();
        }
    });
}

/*
 * *************************************************************
 * 
 * *************************************************************
 */

function hide_all_forms(ids) {
    var n = ids.length;
    for (var i = 0; i < n; i++) {
        $(ids[i]).hide();
    }
}

/*
 * *************************************************************
 * 
 * *************************************************************
 */

function scroll_to_form() {
    $("html, body").animate({scrollTop: $(document).height()}, 1000);
}

/*
 * *************************************************************
 * 
 * *************************************************************
 */

function fill_update_fields(i, fields_arr, data_arr) {
    var prefix = "#";
    var n = fields_arr.length;
    var j = 0;
    for (j = 0; j < n; j++) {

        var field = fields_arr[j];
        var value = data_arr[i][field].toString();
        var tag = $(prefix + field).get(0).tagName;
        value = change_value_to_show(field, value, tag);

        $(prefix + field).val(value);
    }
    

}

function change_value_to_show(field, value, tag) {
    value = change_end_date_value(field, value);
    value = change_select_value_with_zero_value(value, tag);
    value = change_urgency_select_yes_no_value(field, value);
    return value;
}

function change_end_date_value(field, value) {
    /*
     * if the end date is not specified
     */
    if (field == 'end_date' && value == '0000-00-00') {
        value = '';
    }
    return value;
}

function change_select_value_with_zero_value(value, tag) {
    /*
     * if it's a select and the value is zero
     */
    if (tag == 'SELECT' && value != '' && value == 0) {
        value = 'None';
    }
    return value;
}

function change_urgency_select_yes_no_value(field, value) {
    if (field == 'urgency') {
        switch (value) {
            case 'None':
                value = 'No';
                break;
            case '1':
                value = 'Yes';
                break;
            default:
                break;
        }
    }
    return value;
}


