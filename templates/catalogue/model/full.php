<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

$id = $path[2];

$cat = new Catalogue();
$prod = $cat->getById($id);

$categ = new Categories();
$categ_name = $categ->getNameById($prod['categories_id']);
$categ_url = $categ->getUrlNameById($prod['categories_id']);

$image = new Images();
$image_obj = $image->getById($id);

while ($image_info = mysqli_fetch_array($image_obj)) {
    $images[] = $image_info['path'];
}

?>

<!--Кинуть ссылку в links, если такая появится-->
<link rel="stylesheet" href="/css/full.css"> 
<main class = "productCard"> 
    <!--Хлебные крошки--> 
    <ul class = "brdCrumbs"> 
        <li><a href="/">Главная</a> &gt; </li> <!--Добавить рабочую ссылку-->
        <li><a href="/catalogue/">Каталог</a> &gt; </li> <!--Добавить рабочую ссылку-->
        <li><a href="/catalogue/<?= $categ_url; ?>/"><?= $categ_name; ?></a> &gt; </li> <!--Добавить рабочую ссылку-->
        <li><?= $prod['title']; ?></li>
    </ul> 
    <!--Основная инфа о товаре--> 
    <div class = "prdCardH1"><h1><?= $prod['title']; ?></h1> </div>
    <div class ="mainInfPrdCard"> 
        <!--Слайдер--> 
        <div class = "autoplay"> 
            <img src="/uploads/<?= $images[0]; ?>">
        </div>
        <!--Информация о товаре-->
        <div class = "prdInf">
            <!--Цена-->
            <form action="/products/<?= $prod['id']; ?>/add/" method="post">
                <div class = "priceMain"> 
                    <div><h3>Цена:</h3></div> 
                    <div class = "prc"><h2> <?= $prod['price']; ?> р</h2> </div>
                </div>
                <!--Увеличение кол-ва товаров  и кнопка Купить-->
                <div class = "mainButtonsPrdCrd">
                    <!--Увеличение-->
                    <div class = "increase">
                        <input type="number" class="buyButtPrdCrd" name="number" value="1">
                    </div>
                    <p>Количество</p>
                </div>
                <!--Изменение цвета-->
                <div class = "chngColor">
                    <p><input name="color" type="radio"  value="Черный">Черный</p>
                    <p><input name="color" type="radio" value="Белый">Белый</p>
                    <p><input name="color" type="radio" value="Синий">Синий</p>
                </div>
                <!--Выбрать размер-->
                <div class = "chngSize">
                    <select size="1" name="size">
                        <option disabled selected>Размер спального места</option>
                        <option value="90x200">90x200</option>
                        <option value="120x200">120x200</option>
                        <option value="140x200">140x200</option>
                    </select>
                </div>
                <!--Покупка-->
                <input type="submit" class="buyButtPrdCrdMain" value="Добавить в корзину">
            </form>
        </div>
    </div> 
    <!--Характеристики-->
    <div class = "prdText"><h2>Описание:</h2><?= replace($prod['characteristics']); ?></div>

    <div class = "prdText"><h2>Характеристики:</h2><?= replace($prod['description']); ?></div>
</main> 