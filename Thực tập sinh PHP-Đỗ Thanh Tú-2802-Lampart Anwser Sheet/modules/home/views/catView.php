<?php
get_header();

$data_cat = db_fetch_array('SELECT* FROM `tbl_cat`');
$list_cat_all = data_tree($data_cat, 0);


#Chức năng phân trang
//Số danh mục mỗi trang
$num_per_page = 10;
//lấy số trang theo bản ghi
$list_num_page = db_num_page('tbl_cat', $num_per_page);
//tổng số bản ghi
$total_row = count($list_cat_all);
//số trang bằng tổng danh mục chia số danh mục mỗi trang
$num_page = ceil($total_row / $num_per_page);
//Nếu chưa có giá trị page thì cho mặc định là trang 1
$page_num = (int) !empty($_GET['page_id']) ? $_GET['page_id'] : 1;
//chuyển giá trị đầu tiên về 0
$start = ($page_num - 1) * $num_per_page;
//danh sách danh mục được chia là 10 danh mục mỗi trang
$list_cat = array_slice($list_cat_all, $start, $num_per_page);

#Chức năng sắp xếp danh mục
$sort = "";
$attr = "";
if (isset($_GET['sort']) && !empty($_GET['sort']) && isset($_GET['attr']) && isset($_GET['attr'])) {
    $sort = $_GET['sort'];
    $attr = $_GET['attr'];
    $list_product_cat = db_fetch_array("SELECT * FROM `tbl_cat` ORDER BY `$attr` $sort LIMIT $start,$num_per_page");
    $list_product_cat_all = data_tree($list_product_cat, 0);
}
?>
<div class="main">
    <div id="search" class="">
        <form method="GET">
            <input type="hidden" name="mod" value="home">
            <input type="hidden" name="controller" value="index">
            <input type="hidden" name="action" value ="search_cat">
            <input class="p-1" type="text" name="value" id="form_search" placeholder="search">
            <button type="submit" id="btn_search" name="btn_search" value="Tìm kiếm"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
                <?php echo form_error('error') ?>
        </form>
    </div>
    <div class="d-flex mt-3 justify-content-between">
        <p>Search found <b><?php echo $total_row; ?></b> results</p>
        <a href="?mod=home&controller=index&action=add_cat"><i class="fa-solid fa-circle-plus" style="font-size:25px;"></i></a>
    </div>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Category name
                    <?php
                    if ($sort == "DESC" && $attr = "title") {
                        ?>
                        <a href="?mod=home&controller=index&action=sort&sort=ASC&attr=title">
                            <i class="fa-solid fa-angle-up"></i>      
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="?mod=home&controller=index&action=sort&sort=DESC&attr=title">
                            <i class="fa-solid fa-angle-down"></i>     
                        </a>
                        <?php
                    }
                    ?>
                </td>
                <td>Operations</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['sort'])) {
                $temp = 0;
                foreach ($list_product_cat_all as $cat) {
                    $temp++
                    ?>
                    <tr>
                        <td><?php echo $temp ?></td>
                        <td><a class="text-decoration-none" href="?mod=home&controller=index&action=detail&cat_id=<?php echo $cat['cat_id'] ?>" title=""><?php echo str_repeat('-', $cat['level']) . ' ' . $cat['title'] ?></a></td>
                        <td>
                            <div class="d-flex">
                                <a href="?mod=home&controller=index&action=update_cat&cat_id=<?php echo $cat['cat_id'] ?>" class="mx-1"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="?mod=home&controller=index&action=copy&cat_id=<?php echo $cat['cat_id'] ?>" class="mx-1"><i class="fa-regular fa-copy"></i></a>
                                <a href="?mod=home&controller=index&action=delete_cat&cat_id=<?php echo $cat['cat_id'] ?>" class="mx-1"><i class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                $temp = 0;
                foreach ($list_cat as $cat) {
                    $temp++
                    ?>
                    <tr>
                        <td><?php echo $temp ?></td>
                        <td><a class="text-decoration-none" href="?mod=home&controller=index&action=detail&cat_id=<?php echo $cat['cat_id'] ?>" title=""><?php echo str_repeat('-', $cat['level']) . ' ' . $cat['title'] ?></a></td>
                        <td>
                            <div class="d-flex">
                                <a href="?mod=home&controller=index&action=update_cat&cat_id=<?php echo $cat['cat_id'] ?>" class="mx-1"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="?mod=home&controller=index&action=copy&cat_id=<?php echo $cat['cat_id'] ?>" class="mx-1"><i class="fa-regular fa-copy"></i></a>
                                <a href="?mod=home&controller=index&action=delete_cat&cat_id=<?php echo $cat['cat_id'] ?>" class="mx-1"><i class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>

        </tbody>
    </table>
    <section>
        <nav aria-label="Page navigation example">
            <?php echo get_pagging($num_page, $page_num, "?mod=home&controller=index&action=index") ?>
        </nav>
    </section>
</div>

<?php
get_footer();
?>
