<?php

function catalogue_index() {
    echo render("navigation.php");
    echo render("catalogue/catalogue.php");
    echo render("footer.php");
}

function catalogue_show($category) {
    echo render("navigation.php");
    echo render("catalogue/category.php", $category);
    echo render("footer.php");
}

function products_show($param) {
    echo render("navigation.php");
    echo render("catalogue/model/full.php");
    echo render("footer.php");
}

function products_add($param) {
    if(!empty($_POST)) {

//        var_dump($_POST);

        $number = (int) htmlspecialchars(trim($_POST['number']));
        $color = htmlspecialchars(trim($_POST['color']));
        $size = htmlspecialchars(trim($_POST['size']));

        $cat = new Catalogue();
        $prod = $cat->getById($param['action']);

        $title = $prod['title'];
        $price = (int) $prod['price'];

        $users_id = $_SESSION['user_id'];

        $add = new Bag();
        $add->add($param['action'], $users_id, $title, $color, $size, $number, $price);

    }
    else {
        echo "Ошибка!";
    }
}