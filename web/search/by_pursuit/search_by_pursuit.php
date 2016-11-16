<?php
$config = include dirname(dirname(dirname(dirname(__FILE__)))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];

$type = '';
if (isset($_GET['type'])) {
    $type = Get::pursuit_type();
    if ($type == false) {
        Redirect::to_index();
    }
}else{
    Redirect::to_index();
}

Presentation::print_page_title(Pursuit::get_name_by_type($type));
Presentation::get_links_types_pursuits($type);

/*
 * ************************************************************************
 * Old Version
 * ************************************************************************
 */

//$pursuit_arr = Pursuit::get_all_by_type($type);
//
//$args_table = [
//    'array' => $pursuit_arr,
//    'type' => $type
//];
//
//Presentation::all_pursuits_by_type_to_table($args_table);

/*
 * ************************************************************************
 * New Version
 * ************************************************************************
 */
?>

<div id="search_by_pursuit_results_area"></div>
<div id="search_by_pursuit_results_area_angular">
    <div ng-controller="ng_search_by_pursuit_controller">
        <input
            class="search_by_pursuit_criteria"
            type="text"
            ng-model="search_criteria"
            placeholder="search"/>
        <table>
            <thead>
                <?php Presentation::get_table_headers_search_by_pursuit($type); ?>
            </thead>
            <tbody>
                <tr ng-repeat="result in results| filter: search_criteria | orderBy: sort_criteria:sort_direction  ">
                    <?php Presentation::get_table_data_search_by_pursuit($type); ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
/*
 * ***************************************************************************
 * Footer
 * ***************************************************************************
 */
include $config['file']['ov_footer'];
