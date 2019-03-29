<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

$connection = get_connection();
$post_id = $path[4];
$get_post = mysqli_query($connection, "SELECT * FROM `news` WHERE `id` LIKE '" . $post_id . "' ");
$post = mysqli_fetch_array($get_post);

$post['content'] = replace($post['content']);
?>

<form action="/admin/news/edit/status/<?= $post_id ?>" method="post" class="addform">
    <input type="text" name="title" placeholder="Заголовок" value="<?= $post['title'] ?>" class="addinput">
    <textarea name="content" placeholder="Текст новости" rows="10" class="addtext"><?= $post['content']; ?></textarea>
    <input type="submit" class="btn btn-lg btn-primary mb-5 mt-2 addsubmit" value="Изменить">
</form>