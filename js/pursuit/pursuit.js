//selects
var id_update_pursuit_select = '#update_pursuit';
var id_delete_pursuit_select = '#delete_pursuit';
var id_create_pursuit_button = '#create_pursuit';

//forms
var id_pursuit_form_area = '#pursuit_form_area';

var id_update_pursuit_form = '#update_pursuit_form';
var id_delete_pursuit_form = '#delete_pursuit_form';
var id_create_pursuit_form = '#create_pursuit_form';

var ids_pursuit_forms = [
    id_update_pursuit_form,
    id_create_pursuit_form,
    id_delete_pursuit_form
];

var pursuits;
var pursuits_fields;


/*
 * *************************************************************
 * 
 * *************************************************************
 */

$(document).ready(function () {
    update_pursuit();
    delete_pursuit();
    create_pursuit();
    create_pursuit_disable_fields_no_sense();
});

/*
 * *************************************************************
 * 
 * *************************************************************
 */

function update_pursuit() {
    update_row(
            id_update_pursuit_select,
            id_update_pursuit_form,
            ids_pursuit_forms);
}

function fill_update_fields_pursuit(i) {
    fill_update_fields(i, pursuits_fields, pursuits);
    disable_all_fields_except_urgency();
}




function delete_pursuit() {
    delete_row(
            id_delete_pursuit_select,
            id_delete_pursuit_form,
            pursuits,
            "",
            "#pursuit_row_to_delete",
            ids_pursuit_forms);

}
function  create_pursuit() {
    create_row(
            id_create_pursuit_button,
            id_create_pursuit_form,
            ids_pursuit_forms);
}

/*
 * disable
 */

function disable_all_fields_except_urgency() {
    var n = pursuits_fields.length;
    var i = 0;
    for (i = 0; i <= n; i++) {
        var field = pursuits_fields[i];
        if (field != 'urgency') {
            var id = '#' + field;
            $(id).attr('disabled', 'disabled');
        }
    }
}

function create_pursuit_disable_fields_no_sense() {
    var user_role;
    $.post(urls.role, function (role) {
        user_role = JSON.parse(role);
    });

    var sel_id = id_create_pursuit_form + " #role_pursuited";
    $(sel_id).change(function () {
        var role_pursuited = "";
        $(sel_id + " option:selected").each(function () {
            role_pursuited += $(this).text();
            if (user_role == 'band' && role_pursuited == 'Agent' ||
                    user_role == 'agent' && role_pursuited == 'Band') {
                disable_instrument_create_form();
            } else {
                enable_instrument_create_form();
            }
        });
    });
}

function disable_instrument_create_form() {
    $(id_create_pursuit_form + " #instrument")[0].selectedIndex = 0;
    $(id_create_pursuit_form + " #instrument").attr('disabled', 'disabled');
}

function enable_instrument_create_form() {
    $(id_create_pursuit_form + " #instrument").removeAttr('disabled');
}