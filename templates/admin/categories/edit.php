<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

$connection = get_connection();
$category_id = $path[4];
$get_category = mysqli_query($connection, "SELECT * FROM `categories` WHERE `id` LIKE '" . $category_id . "' ");
$category = mysqli_fetch_array($get_category);

?>

<form action="/admin/categories/edit/status/<?= $category_id; ?>" enctype="multipart/form-data" method="post" class="addform">
    <input type="text" name="name" placeholder="название" class="addinput" value="<?= $category['name']; ?>">
    <input type="text" name="url_name" placeholder="url" class="addinput" value="<?= $category['url_name']; ?>">
    <input type="submit" class="btn btn-lg btn-primary mb-5 mt-2" value="Изменить рубрику">
</form>