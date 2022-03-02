<?php
get_header();
$data_cat = db_fetch_array('SELECT* FROM `tbl_cat`');
$list_cat = data_tree($data_cat, 0);
?>

<div class="main">
    <h1>Add new category</h1>
    <form method="POST">
        <?php echo form_error('cat')?>
        <label for="title">Tên danh mục:</label>
        <input type="text" name="title" id="title" >
        <?php echo form_error('title')?>
        <label for="">Danh mục cha</label>
        <select name="parent_id" id="parent_id">
            <option <?php if (!empty($_POST['parent_id']) && $_POST['parent_id'] == 0) echo "selected='selected'"; ?> value="0">Danh mục cha</option>
            <?php if (!empty($list_cat))
                foreach ($list_cat as $cat) {
                    ?>
                    <option <?php if (!empty($_POST['parent_id']) && $_POST['parent_id'] == $cat['cat_id']) echo "selected='selected'"; ?> value="<?php echo $cat['cat_id'] ?>"><?php echo str_repeat('-', $cat['level']) . ' ' . $cat['title'] ?></option>
                    <?php
                }
            ?>
        </select>
        <?php echo form_error('parent_id')?>
        <button type="submit" name="btn-add-cat" class="btn btn-primary d-block mt-3">Thêm mới</button>
    </form>
</div>

<?php
get_footer();
?>