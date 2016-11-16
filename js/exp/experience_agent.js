//selects
var id_update_experience_agent_select = '#update_experience_agent';
var id_delete_experience_agent_select = '#delete_experience_agent';
var id_create_experience_agent_button = '#create_experience_agent';

//forms
var id_experience_agent_form_area = '#experience_agent_form_area';

var id_update_experience_agent_form = '#update_experience_agent_form';
var id_delete_experience_agent_form = '#delete_experience_agent_form';
var id_create_experience_agent_form = '#create_experience_agent_form';

var ids_experience_agent_forms = [
    id_update_experience_agent_form,
    id_delete_experience_agent_form,
    id_create_experience_agent_form
];

var experience_agent;
var experience_agent_fields;


$(document).ready(function () {
    update_experience_agent();
    delete_experience_agent();
    create_experience_agent();
});

function update_experience_agent() {
    update_row(
            id_update_experience_agent_select,
            id_update_experience_agent_form,
            ids_experience_agent_forms);
}

function fill_update_fields_experience_agent(i) {
    fill_update_fields(i, experience_agent_fields, experience_agent);
}

function delete_experience_agent() {
    delete_row(
            id_delete_experience_agent_select,
            id_delete_experience_agent_form,
            experience_agent,
            "artist_name",
            "#experience_agent_row_to_delete",
            ids_experience_agent_forms);
}

function create_experience_agent() {
    
    create_row(
            id_create_experience_agent_button,
            id_create_experience_agent_form,
            ids_experience_agent_forms);
}



