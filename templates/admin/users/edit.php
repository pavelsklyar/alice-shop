<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

$connection = get_connection();
$user_id = $path[4];
$get_user = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` LIKE '" . $user_id . "' ");
$user = mysqli_fetch_array($get_user);
?>

<form action="/admin/users/edit/status/<?= $user_id ?>" method="post" class="addform">
    <input type="text" name="login" placeholder="login" value="<?= $user['login']; ?>" class="addinput">
    <input type="password" name="password" placeholder="password" class="addinput">
    <input type="text" name="name" placeholder="name" value="<?= $user['name']; ?>" class="addinput">
    <input type="text" name="surname" placeholder="surname" value="<?= $user['surname']; ?>" class="addinput">
    <input type="submit" class="btn btn-lg btn-primary mb-5 mt-2 addsubmit" value="Изменить">
</form>