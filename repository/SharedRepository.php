<?php

class SharedRepository extends BaseRepository {

    public static function insert($table, $data) {
        return BaseRepository::insert_into($table, $data);
    }

    public static function select_multi_array_no_args($fields, $table_name) {
        return BaseRepository::select_multi_array_no_args($fields, $table_name);
    }

    public static function select_exists($table, $fields, $args) {
        return BaseRepository::select_exists($fields, $table, $args);
    }

    public static function select_value($table, $fields, $args) {
        return BaseRepository::select_value($fields, $table, $args);
    }

    public static function select_array_fetch_assoc($table, $fields, $args) {
        return BaseRepository::select_array_fetch_assoc($fields, $table, $args);
    }

    public static function select_multi_array($fields, $table_name, $args) {
        return BaseRepository::select_multi_array($fields, $table_name, $args);
    }

    public static function select_array_fetch_array($table, $fields, $args) {
        return BaseRepository::select_array_fetch_array($fields, $table, $args);
    }

    public static function select_count($table, $field_return, $args) {
        return BaseRepository::select_count($field_return, $table, $args);
    }

    public static function update_set($table, $data_to_set, $args) {
        return BaseRepository::update_set($table, $data_to_set, $args);
    }

    public static function update_set_time_now($table, $field, $arg, $arg_value) {
        return BaseRepository::update_set_time_now($field, $table, $arg, $arg_value);
    }

    public static function update_set_time_now_arr_args($table, $field, $args) {
        return BaseRepository::update_set_time_now_arr_args($field, $table, $args);
    }

    public static function select_max($field, $table) {
        return BaseRepository::select_max($field, $table);
    }

    public static function delete_simple($table_name, $args) {
        return BaseRepository::delete_simple($table_name, $args);
    }

    public static function select_inner_join_on_order_by($args) {
        return BaseRepository::select_inner_join_on_order_by($args);
    }
    
    public static function select_inner_join_on_order_by_for_search_ov($args) {
        return BaseRepository::select_inner_join_on_order_by_for_search_ov($args);
    }

}
