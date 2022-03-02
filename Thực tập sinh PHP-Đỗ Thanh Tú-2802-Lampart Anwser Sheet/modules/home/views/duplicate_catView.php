<?php
get_header();
$info_this_cat = db_fetch_array("SELECT* FROM `tbl_cat`");
$info_this_cat_all = data_tree($info_this_cat,0);
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    $parent_id = get_info_cat('parent_id', $cat_id);
}
?>

<div class="main">
    <h1>Duplicate category</h1>
    <form method="POST">
        <?php echo form_error('cat') ?>
        <label for="title">Tên danh mục:</label>
        <input type="text" name="title" id="title" value="<?php echo get_info_cat('title', $cat_id); ?>">
        <?php echo form_error('title') ?>
        <label for="">Danh mục cha</label>
        <select name="parent_id" id="parent_id">
            <option <?php if (!empty($_POST['parent_id']) && $_POST['parent_id'] == 0) echo "selected='selected'"; ?> value="0">Danh mục cha</option>
            <?php
            if (!empty($info_this_cat_all))
                foreach ($info_this_cat_all as $cat) {
                    ?>
                    <option <?php if (!empty($parent_id) && $parent_id == $cat['cat_id']) echo "selected='selected'"; ?> value="<?php echo $cat['cat_id'] ?>"><?php echo str_repeat('-', $cat['level']) . ' ' . $cat['title'] ?></option>
                    <?php
                }
            ?>
        </select>
        <?php echo form_error('parent_id') ?>
        <button type="submit" name="btn_duplicate_cat" class="btn btn-primary d-block mt-3">Copy</button>
    </form>
</div>

<?php
get_footer();
?>