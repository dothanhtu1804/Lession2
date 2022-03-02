<?php

function construct(){
    load_model('cat');
}

function indexAction(){
    load_view('cat');
}

//add category
function add_catAction(){
    if(isset($_POST['btn-add-cat'])){
        global $error, $title, $parent_id, $data;
        $error = array();
        // check title 
        if(empty($_POST['title'])){     
            $error['title'] = '(*) Bạn cần nhập tên danh mục';
        } else{
            if(is_exists('tbl_cat', 'title', $_POST['title'])){
                $error['title'] = '(*) Tên danh mục đã tồn tại';
            } else{
                $title = $_POST['title'];
            }
        }
        // check parent id
        if (empty($_POST['parent_id'])) {                                                                      
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        // check not error
        if(empty($error)){
            $data = array(
                'title' => $title,
                'parent_id' => $parent_id,
            );
            add_cat($data);
            $error['cat'] = 'Thêm danh mục mới thành công'."<br>"."<a href='?mod=home&controller=index&action=index'>Trở về danh sách danh mục</a>";
        } 
    }
    load_view('add_cat');
}  

//update category
function update_catAction(){
    global $cat_id, $error,$title, $parent_id, $data, $old_title,  $old_parent_id;
    $cat_id = $_GET['cat_id'];
    if(isset($_POST['btn-update-cat'])){
        $error = array();
        // check title post
        if(empty($_POST['title'])){     
            $error['title'] = '(*) Bạn cần nhập tên danh mục';
        } else{
            $old_title = get_info_cat('title', $cat_id);
            if($_POST['title'] == $old_title){
                $data = array(
                    'title' => '',
                );
                update_cat($data, $cat_id);
            }
            if(is_exists('tbl_cat', 'title', $_POST['title'])){
                $error['title'] = '(*) Tên danh mục đã tồn tại';
            } else{
                $title = $_POST['title'];
            }
        }
        // check parent id
        if (empty($_POST['parent_id'])) {                                                                      
            $parent_id = 0;
            $old_parent_id = get_info_cat('parent_id', $cat_id);
        } else {
            $parent_id = $_POST['parent_id'];
            $old_parent_id = get_info_cat('parent_id', $cat_id);
        }
        // check not change
        if(($_POST['title'] ==  $old_title) && ($_POST['parent_id'] == $old_parent_id)){
            $data = array(
                'title' => $old_title,
            );
            update_cat($data, $cat_id);
            $error['cat'] = "Danh mục chưa có thay đổi gì!";
        }
        // check not error
        if(empty($error)){
            $data = array(
                'title' => $title,
                'parent_id' => $parent_id,
            );
            update_cat($data, $cat_id);
            $error['cat'] = 'Cập nhật danh mục thành công'."<br>"."<a href='?mod=home&controller=index&action=index'>Trở về danh sách danh mục</a>";
        }
    }
    load_view('update_cat');
}

//delete category
function delete_catAction(){
    $cat_id = $_GET['cat_id'];
    delete_cat($cat_id);
    load_view('cat');
}

//search cat
function search_catAction(){
    global $error, $value, $num_page;
    if (isset($_GET['btn_search'])) {
        if(!empty($_GET['value'])){
            $value = $_GET['value'];
            $num_per_page = 5;
            #Tổng số bản ghi
            $list_product_cat_all = db_search_all_cats($value);
            $total_row = count($list_product_cat_all);
            #Số trang
            $num_page = ceil($total_row / $num_per_page);
            load_view('search_cat');
        } else{
            $error['error'] = 'Bạn cần nhập thông tin DANH MỤC cần tìm kiếm!';
            load_view('cat');
        }
    }
}
function result_searchAction(){
    global $value;
    if(!empty($_GET['value'])){
        $value = $_GET['value'];
    }
    load_view('search_product_cat');
}


//chức năng sắp xếp danh mục
function sortAction(){
    load_view('cat');
}

function copyAction(){
    global $cat_id, $error,$title, $parent_id, $data;
    $cat_id = $_GET['cat_id'];
    if(isset($_POST['btn_duplicate_cat'])){
        $error = array();
        if(empty($_POST['title'])){     
            $error['title'] = '(*) Bạn cần nhập tên danh mục';
        } else {
            $title = $_POST['title'];
        }
        if (empty($_POST['parent_id'])) {                                                                      
            $parent_id = 0;
        }else {
            $parent_id = $_POST['parent_id'];
        }
        if(empty($error)){
            $data = array(
                'title' => $title,
                'parent_id' => $parent_id,
            );
            add_cat($data);
            $error['cat'] = 'Copy danh mục thành công'."<br>"."<a href='?mod=home&controller=index&action=index'>Trở về danh sách danh mục</a>";
        } 
    }
    load_view('duplicate_cat');
}

function detailAction(){
    load_view('detail');
}