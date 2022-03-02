<?php

////xuất thanh phân trang
////thuật toán 
//B1 lấy dữ liệu trang từ url xuống
//B2 tạo đóng mở 2 đầu ul
//B3 tạo trang giữa bằng cách duyệt mảng xuất số lượng trang nếu trang đang duyệt bằng vs trang lấy trên url thì active link
//B4 tạo 2 trang trước nếu trang hiện tại lớn hơn 1
//B5 tạo trang sau nếu trang hiện tại nhỏ hơn tổng số trang

function get_pagging($num_page, $page, $base_url = ''){
    $str_pagging = "<ul class='pagination'>";
//    tạo trang trước
    if($page > 1){
        $page_prev = $page-1;
        $str_pagging .= "<li class='page-item'><a class='page-link' href='{$base_url}&page_id={$page_prev}'>Previous</a></li>";
    }
//    tạo những trang giữa  
    for($i = 1; $i <= $num_page; $i++){
       $active = "";
       if($page == $i){
           $active = "class = 'active-num-page'";
       }
       $str_pagging .= "<li class='page-item'><a class='page-link' href='{$base_url}&page_id={$i}'>$i</a></li>";
    }
//    tạo trang sau
    if($page < $num_page){
        $page_next = $page+1;
        $str_pagging .= "<li class='page-item'><a class='page-link' href='{$base_url}&page_id={$page_next}'>Next</a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}

//lấy số trang
//số trang = tổng trang / số lượng sản phẩm mỗi trang
function db_num_page($tbl, $record){
    global $conn;
    #Số lượng trang
    $sql = "SELECT* FROM $tbl";
    $num_rows = db_num_rows($sql);
    $num_page = ceil($num_rows / $record);
    # danh sách số thứ tự trang 1,2,3,4....
    $list_num_page = array();
    for ($i = 1; $i <= $num_page; $i++) {
        $list_num_page[] = $i;
    }
    return $list_num_page;
}

?>