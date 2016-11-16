//selects
var id_update_experience_musician_bands_select = '#update_experience_musician_bands';
var id_delete_experience_musician_bands_select = '#delete_experience_musician_bands';
var id_create_experience_musician_bands_button = '#create_experience_musician_bands';

//forms
var id_experience_musician_bands_form_area = '#experience_musician_bands_form_area';

var id_update_experience_musician_bands_form = '#update_experience_musician_bands_form';
var id_delete_experience_musician_bands_form = '#delete_experience_musician_bands_form';
var id_create_experience_musician_bands_form = '#create_experience_musician_bands_form';

var ids_experience_musician_bands_forms = [
    id_update_experience_musician_bands_form,
    id_delete_experience_musician_bands_form,
    id_create_experience_musician_bands_form
];

var experience_musician_bands;
var experience_musician_bands_fields;


$(document).ready(function () {
    update_experience_musician_bands();
    delete_experience_musician_bands();
    create_experience_musician_bands();
});

function update_experience_musician_bands() {
    update_row(
            id_update_experience_musician_bands_select,
            id_update_experience_musician_bands_form,
            ids_experience_musician_bands_forms);
}

function fill_update_fields_experience_musician_bands(i) {
    fill_update_fields(i, experience_musician_bands_fields, experience_musician_bands);
}

function delete_experience_musician_bands() {
    delete_row(
            id_delete_experience_musician_bands_select,
            id_delete_experience_musician_bands_form,
            experience_musician_bands,
            "band_name",
            "#experience_musician_bands_row_to_delete",
            ids_experience_musician_bands_forms);
}

function create_experience_musician_bands() {
    create_row(
            id_create_experience_musician_bands_button,
            id_create_experience_musician_bands_form,
            ids_experience_musician_bands_forms);
}



