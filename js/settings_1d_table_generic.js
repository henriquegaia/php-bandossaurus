function fill_settings_fields(fields_arr, data_arr) {
    var prefix = "#";
    var n = fields_arr.length;
    var j = 0;
    for (j = 0; j < n; j++) {
        var field = fields_arr[j];
        var data;
        if (data_arr[field] === null) {
            data = '';
        } else {
            data = data_arr[field].toString();
        }
        $(prefix + field).val(data);
    }
}