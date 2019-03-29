<?php

    $cat = new Categories();
    $categories_obj = $cat->get();

?>

<link rel="stylesheet" href="/css/style.css">
<div class="catalogue">
    <a href="">
        <div class="cat1 cat">
        <h1 style="color:white;"> Акции </h1>
        </div>
    </a>
    <?php while($category = mysqli_fetch_array($categories_obj)) : ?>
    <a href="/catalogue/<?= $category['url_name'] ?>/">
        <div class="cat" style="background-image: url(/uploads/<?= $category['image'] ?>); ">
        <h1><?= $category['name']; ?></h1>
        </div>
    </a>
    <?php endwhile; ?>
</div>
