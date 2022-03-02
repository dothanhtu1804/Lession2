<?php
get_header();
#Số bản ghi/trang
$num_per_page = 10;
# search product and get list products
if (!empty($_GET['value'])) {
    $value = $_GET['value'];
}
#Tổng số bản ghi tìm được
$data_cat = db_search_all_cats($value);
$total_row = count($data_cat);
#Số trang
$num_page = ceil($total_row / $num_per_page);

#chỉ số bắt đầu của trang
$page_num = (int) !empty($_GET['page_id']) ? $_GET['page_id'] : 1;
$start = ($page_num - 1) * $num_per_page;
$order_num = $start;
$list_cats = db_search_cats_by_page($value, $start, $num_per_page);
$list_cat_all = data_tree($list_cats,0);
?>
<div class="main">
    <div id="search" class="">
        <form method="GET">
            <input type="hidden" name="mod" value="home">
            <input type="hidden" name="controller" value="index">
            <input type="hidden" name="action" value ="search_cat">
            <input class="p-1" type="text" name="value" id="form_search" placeholder="search" value="<?php echo set_value('value') ?>">
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
                <td>Category name</td>
                <td>Operations</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $temp = 0;
            foreach ($list_cat_all as $cat) {
                $temp++
                ?>
                <tr>
                    <td><?php echo $temp ?></td>
                    <td><a class="text-decoration-none" href="?mod=home&controller=index&action=update_cat&cat_id=<?php echo $cat['cat_id'] ?>" title=""><?php echo str_repeat('-', $cat['level']) . ' ' . $cat['title'] ?></a></td>
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
