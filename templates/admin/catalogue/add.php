<?php

$cat = new Categories();
$categories_obj = $cat->get();

?>

<form action="/admin/catalogue/add/status/" enctype="multipart/form-data" method="post" class="addform">
    <select name="categories_id" class="addselect">
        <?php while ($category = mysqli_fetch_array($categories_obj)) : ?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="text" name="title" placeholder="Название" class="addinput">
    <textarea name="characteristics" placeholder="Характеристики" id="" rows="10" class="addtext"></textarea>
    <textarea name="description" placeholder="Описание" id="" rows="10" class="addtext"></textarea>
    <input type="number" name="price" placeholder="Цена" class="addinput">
    <textarea name="meta" placeholder="Метатег" id="" rows="10" class="addtext"></textarea>
    <div class="file-upload">
    <label>
        <input type="file" name="images[]" id="" multiple>
        <span>Выберите файлы</span>
    </label>
    </div>
    <input type="submit" class="btn" value="Добавить">
</form>