<?php

function db_search_all_cats($value){
    $sql = "SELECT * FROM `tbl_cat` WHERE `title` LIKE '%$value%'";
    $result = db_fetch_array($sql);
    return $result;
}

function db_search_cats_by_page($value, $start = 1, $num_per_page = 10){
    $sql = "SELECT * FROM `tbl_cat`  WHERE `title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    $result = db_fetch_array($sql);
    return $result;
}
