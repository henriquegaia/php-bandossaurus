//selects
var id_update_member_select = '#update_band_member';
var id_delete_member_select = '#delete_band_member';
var id_create_member_button = '#create_band_member';

//forms
var id_settings_band_members_form_area = '#settings_band_members_form_area';

var id_update_member_form = '#update_band_member_form';
var id_delete_member_form = '#delete_band_member_form';
var id_create_member_form = '#create_band_member_form';

var ids_settings_band_members_forms = [
    id_update_member_form,
    id_create_member_form,
    id_delete_member_form
];

var band_members;
var band_members_fields;


/*
 * *************************************************************
 * 
 * *************************************************************
 */

$(document).ready(function () {
    update_member();
    delete_member();
    create_member();
});

/*
 * *************************************************************
 * 
 * *************************************************************
 */

function update_member() {
    update_row(
            id_update_member_select,
            id_update_member_form,
            ids_settings_band_members_forms);
}

function fill_update_fields_settings_band_members(i) {
    fill_update_fields(i, band_members_fields, band_members);
}


/*
 * *************************************************************
 * 
 * *************************************************************
 */
function delete_member() {
    delete_row(
            id_delete_member_select,
            id_delete_member_form,
            band_members,
            "name",
            "#member_name_to_delete",
            ids_settings_band_members_forms);
}

/*
 * *************************************************************
 * 
 * *************************************************************
 */
function create_member() {
    create_row(
            id_create_member_button,
            id_create_member_form,
            ids_settings_band_members_forms);
}

