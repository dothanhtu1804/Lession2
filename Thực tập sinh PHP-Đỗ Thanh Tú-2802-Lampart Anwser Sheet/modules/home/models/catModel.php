<?php
//get list caterogy
function get_cat($start = 0, $num_per_page = 10){
    $list_product_cats = db_fetch_array("SELECT* FROM `tbl_cat` LIMIT {$start}, {$num_per_page}");
    return $list_product_cats;
} 
//get_info_cat
function get_info_cat($field, $cat_id){
    $info_cat = db_fetch_row("SELECT `$field` FROM `tbl_cat` WHERE `cat_id` = '{$cat_id}'");
    return  $info_cat[$field];
}
//add cat
function add_cat($data) {
    db_insert('tbl_cat', $data);
}
// update cat
function update_cat($data, $cat_id){
    db_update('tbl_cat', $data, "`cat_id` = '{$cat_id}'");
}
//delete cat
function delete_cat($cat_id){
    db_delete('tbl_cat', "`cat_id` = '{$cat_id}'");
}
//get product cat
function get_cats($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $list_cats = db_fetch_array("SELECT* FROM `tbl_cat` {$where} LIMIT {$start}, {$num_per_page}");
    return $list_cats;
} 

function is_exists($table, $key, $value) {
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0) return true;
    
    return false;
}