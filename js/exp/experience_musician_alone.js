//selects
var id_update_experience_musician_alone_select = '#update_experience_musician_alone';
var id_delete_experience_musician_alone_select = '#delete_experience_musician_alone';
var id_create_experience_musician_alone_button = '#create_experience_musician_alone';

//forms
var id_experience_musician_alone_form_area = '#experience_musician_alone_form_area';

var id_update_experience_musician_alone_form = '#update_experience_musician_alone_form';
var id_delete_experience_musician_alone_form = '#delete_experience_musician_alone_form';
var id_create_experience_musician_alone_form = '#create_experience_musician_alone_form';

var ids_experience_musician_alone_forms = [
    id_update_experience_musician_alone_form,
    id_delete_experience_musician_alone_form,
    id_create_experience_musician_alone_form
];

var experience_musician_alone;
var experience_musician_alone_fields;

$(document).ready(function () {
    update_experience_musician_alone();
    delete_experience_musician_alone();
    create_experience_musician_alone();
});

function update_experience_musician_alone() {
    update_row(
            id_update_experience_musician_alone_select,
            id_update_experience_musician_alone_form,
            ids_experience_musician_alone_forms);
}

function fill_update_fields_experience_musician_alone(i) {
    fill_update_fields(i, experience_musician_alone_fields, experience_musician_alone);
}

function delete_experience_musician_alone() {
    delete_row(
            id_delete_experience_musician_alone_select,
            id_delete_experience_musician_alone_form,
            experience_musician_alone,
            "instrument",
            "#experience_musician_alone_row_to_delete",
            ids_experience_musician_alone_forms);
}

function create_experience_musician_alone() {
    create_row(
            id_create_experience_musician_alone_button,
            id_create_experience_musician_alone_form,
            ids_experience_musician_alone_forms);
}



