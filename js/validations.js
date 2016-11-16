/*
 * *************************************************************
 * 
 * *************************************************************
 */
function is_checkbox_checked(id) {
    var chkbox = document.getElementById(id);
    if (chkbox.checked) {
        return true;
    }
    return false;
}
/*
 * *************************************************************
 * 
 * *************************************************************
 */

var img_bad = urls.general_images_bad;
var img_good = urls.general_images_good;
var alt_bad = "wrong";
var alt_good = "good";
var valid_username = false;
var valid_password = false;
var valid_password_again = false;
var valid_first_name = false;
var valid_last_name = false;
var valid_email = false;


/*
 * *************************************************************
 * validate register form
 * *************************************************************
 */

function validate_register_user_form() {
    if (get_validity_email() === true
            && get_validity_first_name() === true
            && get_validity_password() === true
            && get_validity_password_again() === true
            && get_validity_username() === true) {
        return true;
    }
    return false;
}

/*
 * *************************************************************
 * username  
 * *************************************************************
 */

function validate_username(txt, regex, status_id) {
    var value = validate_input(txt, regex, status_id);
    set_validity_username(value);
}

/*
 * *************************************************************
 * password
 * *************************************************************
 */

function validate_password(txt, regex, status_id) {
    var value = validate_input(txt, regex, status_id);
    set_validity_password(value);
}

/*
 * *************************************************************
 * password again
 * *************************************************************
 */

function validate_password_again(psw_again, status_id, elem_name_to_compare) {
    var elem_id = elem_name_to_compare.toString();
    var password = document.getElementById(elem_id).value;
    var img_validator = document.getElementById(status_id);

    if (psw_again !== '' && get_validity_password() == true) {
        if (psw_again === password) {
            update_image_validator_good(img_validator);
            set_validity_password_again(true);
        } else {
            update_image_validator_bad(img_validator);
            set_validity_password_again(false);
        }
    }
}

/*
 * *************************************************************
 * first name
 * *************************************************************
 */

function validate_first_name(txt, regex, status_id) {
    var value = validate_input(txt, regex, status_id);
    set_validity_first_name(value);
}

/*
 * *************************************************************
 * last name
 * *************************************************************
 */

function validate_last_name(txt, regex, status_id) {
    var value = validate_input(txt, regex, status_id);
    set_validity_last_name(value);
}

/*
 * *************************************************************
 * email
 * *************************************************************
 */

function validate_email(txt, regex, status_id) {
    var value = validate_input(txt, regex, status_id);
    set_validity_email(value);
}

/*
 * *************************************************************
 * city_country
 * *************************************************************
 */

function validate_city_country(id, status_id) {
    var cc = $('#' + id).val();
    var value = is_city_state(cc);
    var img_validator = document.getElementById(status_id);

    if (value == false) {
        update_image_validator_bad(img_validator);
    } else {
        update_image_validator_good(img_validator);
    }
}

/*
 * *************************************************************
 * any select
 * *************************************************************
 */
function validate_selected_option(elem_id, status_id) {
    elem_id = elem_id.toString();
    var img_validator = document.getElementById(status_id);
    var select = document.getElementById(elem_id);
    var selected_txt = select.options[select.selectedIndex].text;

    var selected_index = select.selectedIndex;
    var ret = false;

    if (selected_index == 0 || selected_txt == '') {
        update_image_validator_bad(img_validator);
        ret = false;
    } else {
        update_image_validator_good(img_validator);
        ret = true;
    }
    return ret;
}


function getMessage() {
    return messages[Math.floor(Math.random() * messages.length)];
}

/*
 * *************************************************************
 * text area
 * *************************************************************
 */
function validate_txt_area(txt, regex, status_id) {
//    var img_validator = document.getElementById(status_id);
//    update_image_validator_good(img_validator);
}



/*
 * *************************************************************
 * generic
 * *************************************************************
 */
function validate_input(txt, regex, status_id) {
    var img_validator = document.getElementById(status_id);
    return update_image_validator(txt, regex, img_validator);

}

function validate_date(txt, min, max, status_id, is_birth) {
    /*
     * check if format is valid
     */
    var img_validator = document.getElementById(status_id);
    if (Date.parse(txt)) {
        update_image_validator_good(img_validator);
        return true;
    } else {
        update_image_validator_bad(img_validator);
        return false;
    }

    /*
     * compare with min and max
     */
    var date_test = new Date(txt);
    var date_now = new Date();
    var year_test = date_test.getFullYear();
    var year_now = date_now.getFullYear();
    var year_span = year_now - year_test;

    if (is_birth == true && date_test > date_now) {
        update_image_validator_bad(img_validator);
        return false;
    } else if (txt == '' || year_span < min || year_span > max) {
        update_image_validator_bad(img_validator);
        return false;
    } else {
        update_image_validator_good(img_validator);
        return true;
    }
}

function validate_end_date(start, end) {
    if (end >= start) {
        return true;
    }
    return false;
}
/*
 * *************************************************************
 * update_image_validator
 * *************************************************************
 */

function update_image_validator(txt, regex, field_status) {
    regex = format_regex(regex);
    var reg_exp = new RegExp(regex);
    if (!reg_exp.test(txt)) {
        update_image_validator_bad(field_status);
        return false;
    } else {
        update_image_validator_good(field_status);
        return true;
    }
}

/*
 * *************************************************************
 * update_image_validator_bad
 * *************************************************************
 */

function update_image_validator_bad(field_status) {
    field_status.src = img_bad;
    field_status.alt = alt_bad;
}

/*
 * *************************************************************
 * update_image_validator_good
 * *************************************************************
 */

function update_image_validator_good(field_status) {
    field_status.src = img_good;
    field_status.alt = alt_good;
}

/*
 * *************************************************************
 * format_regex
 * *************************************************************
 */

function format_regex(regex) {
    regex = regex.toString();
    regex = regex.slice(1, -1);
    return regex;
}

/*
 * *************************************************************
 * set 
 * *************************************************************
 */

function set_validity_username(value) {
    valid_username = Boolean(value);
}

function set_validity_password(value) {
    valid_password = Boolean(value);
}

function set_validity_password_again(value) {
    valid_password_again = Boolean(value);
}

function set_validity_first_name(value) {
    valid_first_name = Boolean(value);
}

function set_validity_last_name(value) {
    valid_last_name = Boolean(value);
}

function set_validity_email(value) {
    valid_email = Boolean(value);
}

/*
 * *************************************************************
 * get 
 * *************************************************************
 */

function get_validity_username() {
    return Boolean(valid_username);
}

function get_validity_password() {
    return Boolean(valid_password);
}

function get_validity_password_again() {
    return Boolean(valid_password_again);
}

function get_validity_first_name() {
    return Boolean(valid_first_name);
}

function get_validity_last_name() {
    return Boolean(valid_last_name);
}

function get_validity_email() {
    return Boolean(valid_email);
}
