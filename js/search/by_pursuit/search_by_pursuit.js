/*
 * *************************************************************
 * Angular + JQuery 
 * *************************************************************
 */


$(document).ready(function () {
    var results_area_id = '#search_by_pursuit_results_area_angular';
    var type = getUrlParameter('type');
    if (empty(type)) {
        return false;
    }
    $.post(urls.search_by_pursuit_send_array, {type: type}, function (data) {
        var results = JSON.parse(data);
        var n = results.length;
        if (n == 0) {
            $(results_area_id).text('no results');
            return false;
        }
    });
});


var ang_app = 'make_a_band';
var ang_search_by_pursuit_ctrl = 'ng_search_by_pursuit_controller';
angular.module(ang_app, []);
angular.module(ang_app).controller(ang_search_by_pursuit_ctrl, function ($scope) {
    var r = search_by_pursuit_get_results();
    $scope.results = $.parseJSON(r);
    $scope.sort_by = function (field) {
        $scope.sort_criteria = field;
        $scope.sort_direction = !$scope.sort_direction;
    };
});

/*
 * *************************************************************
 * Helpers
 * *************************************************************
 */

function search_by_pursuit_get_results() {
    var type = getUrlParameter('type');
    if (empty(type)) {
        return false;
    }
    var r = $.ajax({
        type: 'POST',
        url: urls.search_by_pursuit_send_array,
        data: {type: type},
        success: function (data) {
            return data;
        },
        async: false
    }).responseText;
    return r;
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
