<?php
get_header();
$data_cat = db_fetch_array('SELECT* FROM `tbl_cat`');
$list_cat = data_tree($data_cat, 0);
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    $parent_id = get_info_cat('parent_id', $cat_id);
}
?>

<div class="main">
    <h1>Detail category</h1>
    <div class="d-flex">
        <p style="margin-right: 10px;">Tên danh mục:</p>
        <label><?php echo get_info_cat('title', $cat_id); ?></label>
    </div>
    <div class="d-flex">
        <p style="margin-right: 10px;">Danh mục cha:</p>
        <label>
            <?php
            foreach ($list_cat as $cat) {
                if (!empty($parent_id) && $parent_id == $cat['cat_id'])
                    if ($cat['level'] > 0) {
                        echo str_repeat('-', $cat['level']) . ' ' . $cat['title'];
                    } elseif ($cat['level'] == 0) {
                        echo $cat['title'];
                    }
            }
            ?>
        </label>
    </div>

</div>

<?php
get_footer();
?>