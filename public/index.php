<?php
require_once '../engine/app.php';

session_start();

$url = $_SERVER['REQUEST_URI'];
if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
} else {
    $path = explode('/', $url);
}

session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php if ($path[1] == 'admin') : ?>
        <link rel="stylesheet" href="/css/admin.css">
    <?php else : ?>
        <link rel="stylesheet" href="/css/style.css">
    <?php endif; ?>
    
    <title><?php get_title(); ?></title>

    <link rel="icon" href="/img/logo.png" type="image/x-icon"/>


    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="https://webdeveloper.pro/demo/blog/owlcarousel/owl-carousel/owl.carousel.css"/>
    <script src="https://webdeveloper.pro/demo/blog/owlcarousel/js/jquery-3.0.0.min.js"></script>
    <script src="https://webdeveloper.pro/demo/blog/owlcarousel/owl-carousel/owl.carousel.min.js"></script>
</head>
<body>
    <?php require_once '../config/modules.php' ?>
</body>
</html>