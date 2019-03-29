<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

$cat = new Categories();
$categories_obj = $cat->get();

$product = new Catalogue();
$prod = $product->getById($path[4]);

?>

<form action="/admin/catalogue/edit/status/<?= $prod['id']; ?>" enctype="multipart/form-data" method="post" class="addform">
    <select name="categories_id" class="addselect">
        <?php while ($category = mysqli_fetch_array($categories_obj)) : ?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="text" name="title" placeholder="title" class="addinput" value="<?= $prod['title']; ?>">
    <textarea name="characteristics" placeholder="characteristics" id="" rows="10" class="addtext"><?= $prod['characteristics']; ?></textarea>
    <textarea name="description" placeholder="description" id="" rows="10" class="addtext"><?= $prod['description']; ?></textarea>
    <input type="number" name="price" placeholder="price" class="addinput" value="<?= $prod['price']; ?>">
    <textarea name="meta" placeholder="meta tag" id="" rows="10" class="addtext"><?= $prod['meta']; ?></textarea>
    <input type="submit" class="btn btn-lg btn-primary mb-5 mt-2" value="Изменить">
</form>