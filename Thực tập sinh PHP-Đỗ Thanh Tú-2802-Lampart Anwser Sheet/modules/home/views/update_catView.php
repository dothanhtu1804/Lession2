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
    <h1>Update category</h1>
    <form method="POST">
        <?php echo form_error('cat') ?>
        <label for="title">Tên danh mục:</label>
        <input type="text" name="title" id="title" value="<?php echo get_info_cat('title', $cat_id); ?>">
        <?php echo form_error('title') ?>
        <label for="">Danh mục cha</label>
        <select name="parent_id" id="parent_id">
            <option <?php if (!empty($_POST['parent_id']) && $_POST['parent_id'] == 0) echo "selected='selected'"; ?> value="0">Danh mục cha</option>
            <?php
            if (!empty($list_cat))
                foreach ($list_cat as $cat) {
                    ?>
                    <option <?php if (!empty($parent_id) && $parent_id == $cat['cat_id']) echo "selected='selected'"; ?> value="<?php echo $cat['cat_id'] ?>"><?php echo str_repeat('-', $cat['level']) . ' ' . $cat['title'] ?></option>
                    <?php
                }
            ?>
        </select>
        <?php echo form_error('parent_id') ?>
        <button type="submit" name="btn-update-cat" class="btn btn-primary d-block mt-3">Update</button>
    </form>
</div>

<?php
get_footer();
?>