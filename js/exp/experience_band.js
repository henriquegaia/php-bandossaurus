//selects
var id_update_experience_band_select = '#update_experience_band';
var id_delete_experience_band_select = '#delete_experience_band';
var id_create_experience_band_button = '#create_experience_band';

//forms
var id_experience_band_form_area = '#experience_band_form_area';

var id_update_experience_band_form = '#update_experience_band_form';
var id_delete_experience_band_form = '#delete_experience_band_form';
var id_create_experience_band_form = '#create_experience_band_form';

var ids_experience_band_forms = [
    id_update_experience_band_form,
    id_delete_experience_band_form,
    id_create_experience_band_form
];

var experience_band;
var experience_band_fields;


$(document).ready(function () {
    update_experience_band();
    delete_experience_band();
    create_experience_band();
});

function update_experience_band() {
    update_row(
            id_update_experience_band_select,
            id_update_experience_band_form,
            ids_experience_band_forms);
}

function fill_update_fields_experience_band(i) {
    fill_update_fields(i, experience_band_fields, experience_band);
}

function delete_experience_band() {
    delete_row(
            id_delete_experience_band_select,
            id_delete_experience_band_form,
            experience_band,
            "main_genre",
            "#experience_band_row_to_delete",
            ids_experience_band_forms);
}

function create_experience_band() {
    
    create_row(
            id_create_experience_band_button,
            id_create_experience_band_form,
            ids_experience_band_forms);
}



