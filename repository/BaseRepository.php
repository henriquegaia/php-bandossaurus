<?php

class BaseRepository {

    protected static function insert_into($table_name, $data) {
        $conn = MySQLiConnection::connect();
        $data = Security::array_sanitize($conn, $data);
        $keys = DataStructure::get_keys_from_array_to_sql($data);
        $values = DataStructure::get_values_from_array_to_sql($data);
        $query = "INSERT INTO `$table_name` ($keys) VALUES ($values)";
        return mysqli_query($conn, $query);
    }

    private static function select($fields, $table_name, $args) {
        $conn = MySQLiConnection::connect();
        $args = Security::array_sanitize($conn, $args);
        $fields = DataStructure::get_array_values_to_sql_comma_divide($fields);
        $args = DataStructure::get_array_to_sql_AND_divide($args);
        $query = "SELECT $fields FROM `$table_name` WHERE $args";
        return mysqli_query($conn, $query);
    }
    
    private static function select_no_args($fields, $table_name) {
        $conn = MySQLiConnection::connect();
        $fields = DataStructure::get_array_values_to_sql_comma_divide($fields);
        $query = "SELECT $fields FROM `$table_name`";
        return mysqli_query($conn, $query);
    }

    public static function select_multi_array($fields, $table_name, $args) {
        $result = self::select($fields, $table_name, $args);
        $arr_multi = [];
        while ($arr_multi[] = mysqli_fetch_assoc($result));
        array_pop($arr_multi);
        return $arr_multi;
    }
    
    public static function select_multi_array_no_args($fields, $table_name) {
        $result = self::select_no_args($fields, $table_name);
        $arr_multi = [];
        while ($arr_multi[] = mysqli_fetch_assoc($result));
        array_pop($arr_multi);
        return $arr_multi;
    }

    public static function select_count($field_return, $table_name, $args) {
        $conn = MySQLiConnection::connect();
        $aliases = 'total';
        $args = Security::array_sanitize($conn, $args);
        $args = DataStructure::get_array_to_sql_AND_divide($args);
        if (empty($args)) {
            $query = "SELECT COUNT(`$field_return`) as $aliases FROM `$table_name`";
        } else {
            $query = "SELECT COUNT(`$field_return`) as $aliases FROM `$table_name` WHERE $args";
        }
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result);
        return $data[$aliases];
    }

    public static function update_set($table_name, $data_to_set, $args) {
        $conn = MySQLiConnection::connect();
        $args = Security::array_sanitize($conn, $args);
        $data_to_set = DataStructure::get_array_to_sql_comma_divide($data_to_set);
        $args = DataStructure::get_array_to_sql_AND_divide($args);
        $query = "UPDATE `$table_name` SET $data_to_set WHERE $args";
        return mysqli_query($conn, $query);
    }

    public static function update_set_time_now($field, $table, $arg, $arg_value) {
        $conn = MySQLiConnection::connect();
        $arg_value = Security::sanitize($conn, $arg_value);
        $query = "UPDATE `$table` SET `$field`=NOW() WHERE `$arg` = '$arg_value' ";
        return mysqli_query($conn, $query);
    }

    public static function update_set_time_now_arr_args($field, $table, $args) {
        $conn = MySQLiConnection::connect();
        $args = Security::array_sanitize($conn, $args);
        $args = DataStructure::get_array_to_sql_AND_divide($args);
        $query = "UPDATE `$table` SET `$field`=NOW() WHERE $args";
        return mysqli_query($conn, $query);
    }

    public static function select_max($field, $table) {
        $conn = MySQLiConnection::connect();
        $query = "SELECT MAX(id) AS max FROM $table";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row[0];
        }
        return false;
    }

    public static function delete_simple($table_name, $args) {
        $conn = MySQLiConnection::connect();
        $args = Security::array_sanitize($conn, $args);
        $args = DataStructure::get_array_to_sql_OR_divide($args);
        $query = "DELETE FROM `$table_name` WHERE $args";
        return mysqli_query($conn, $query);
    }

    public static function select_inner_join_on_order_by($args) {
        $conn = MySQLiConnection::connect();
        // Args - select
        $select_args = $args['select'];
        $select_args = DataStructure::get_array_to_sql_comma_divide_no_keys($select_args);
        // Args - from
        $from_args = $args['from'][0];
        // Args - order by
        $order_by_args = $args['order_by'][0];
        // Args - inner join
        $inner_join_on = self::multiple_inner_join_on($args['inner_join_on'], $conn);
        // Args - limit
        $limit = $args['limit'];
        // Query
        $query = "SELECT DISTINCT $select_args " .
                "FROM $from_args " .
                $inner_join_on .
                "ORDER BY $order_by_args ".
                "LIMIT $limit";
        $result = mysqli_query($conn, $query);
        $arr_multi = [];
        while ($arr_multi[] = mysqli_fetch_assoc($result));
        array_pop($arr_multi);
        return $arr_multi;
    }
    
    public static function multiple_inner_join_on($args, $conn) {
        $str = '';
        foreach ($args as $key => $value) {
            // inner join ...
            $inner_join_args = $args[$key]['inner_join'][0];
            $inner_join_args = Security::sanitize($conn, $inner_join_args);
            // on ...
            $on_args = $args[$key]['on'];
            $on_args = DataStructure::get_array_to_sql_AND_divide_no_keys($on_args);
            // full inner join ... on ...
            $str.= ' INNER JOIN ' . $inner_join_args . ' ON ' . $on_args . ' ';
        }
        return $str;
    }
    
    /*
     * **************************************************
     * Special Case:
     * -search overall
     * **************************************************
     */
    
    public static function select_inner_join_on_order_by_for_search_ov($args) {
        $conn = MySQLiConnection::connect();
        // Args - select
        $select_args = $args['select'];
        $select_args = DataStructure::get_array_to_sql_comma_divide_no_keys_search_ov($select_args);
        // Args - from
        $from_args = $args['from'][0];
        // Args - order by
        $order_by_args = $args['order_by'][0];
        // Args - inner join
        $inner_join_on = self::multiple_inner_join_on_for_search_ov($args['inner_join_on'], $conn);
        // Args - limit
        $limit = $args['limit'];
        // Query
        $query = "SELECT DISTINCT $select_args " .
                "FROM $from_args " .
                $inner_join_on .
                "ORDER BY $order_by_args ".
                "LIMIT $limit";
        $result = mysqli_query($conn, $query);
        $arr_multi = [];
        while ($arr_multi[] = mysqli_fetch_assoc($result));
        array_pop($arr_multi);
        return $arr_multi;
    }

    public static function multiple_inner_join_on_for_search_ov($args, $conn) {
        $str = '';
        foreach ($args as $key => $value) {
            // inner join ...
            $inner_join_args = $args[$key]['inner_join'][0];
            $inner_join_args = Security::sanitize($conn, $inner_join_args);
            // on ...
            $on_args = $args[$key]['on'];
            $on_args = DataStructure::get_array_to_sql_AND_divide_no_keys_search_ov($on_args);
            // full inner join ... on ...
            $str.= ' INNER JOIN ' . $inner_join_args . ' ON ' . $on_args . ' ';
        }
        return $str;
    }

    /*
     * **************************************************
     * Methods that redirect to the above ones
     * **************************************************
     */

    public static function select_exists($fields, $table_name, $args) {
        $result = self::select($fields, $table_name, $args);
        return (mysqli_num_rows($result) >= 1) ? true : false;
    }

    public static function select_value($fields, $table_name, $args) {
        $result = self::select($fields, $table_name, $args);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row[0];
        }
        return false;
    }

    public static function select_array_fetch_assoc($fields, $table_name, $args) {
        $result = self::select($fields, $table_name, $args);
        return mysqli_fetch_assoc($result);
    }
    
    public static function select_array_fetch_array($fields, $table_name, $args) {
        return self::select($fields, $table_name, $args);
    }

}
