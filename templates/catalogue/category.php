<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

$category = $path[2];
$cat = new Categories();
$id = (int) $cat->getId($category);
$title = $cat->getName($category);

$cat = new Catalogue();
$product = $cat->getByCat($id);


?>


<!--Кинуть ссылку в links, если такая появится -->
<link rel="stylesheet" href="/css/productList.css"> 
<main class = "productList"> 
<!--Хлебные крошки--> 
<ul class = "brdCrumbs"> 
    <li><a href="/">Главная</a> &gt; </li> <!--Добавить рабочую ссылку-->
    <li><a href="/catalogue/">Каталог</a> &gt; </li> <!--Добавить рабочую ссылку-->
    <li><?= $title ?></li> <!--Добавить рабочую ссылку-->
</ul>
<!--Название страницы-->
<div class = "prdH1"><h1> <?= $title ?> </h1> </div>
<!--Основной блок с фильтрами и товарами--> 
    <div class = "containerPrdList"> 
        <!--Блок фильтров-->
        <div class = "filterPrdList"> 
            <form action="" method="get">
                <div class = "filterPrdListH1">Установить фильтры:</div>
                <!--Фильтр по цене--> 
                <div class = "f1PriceH1">Цена:</div> 
                <div class = "f1Price"> 
                    <input type="text" id="minPrice" class="minPrice" name="minPricef1" placeholder = "От"> 
                    <input type="text" id="maxPrice" class="maxPrice" name="maxPricef1" 
                    minlength="2" placeholder = "До"> 
                </div> 
                <!--Фильтр по размеру--> 
                <div class = "f2SizeH1">Размер:</div> 
                <div class = "f2Size"> 
                    <input type="checkbox" name="minSize" value="s1">Односпальные<Br> 
                    <input type="checkbox" name="middleSize" value="s2">Полуторные<Br> 
                    <input type="checkbox" name="maxSize" value="s3">Двуспальные<Br>
                </div> 
                <!--Фильтр по цвету--> 
                <div class = "f3ColorH1">Цвет:</div> 
                <div class = "f3Color"> 
                    <input type="checkbox" name="color1" value="c1">Черные<Br> 
                    <input type="checkbox" name="color2" value="c2">Белые<Br> 
                    <input type="checkbox" name="color3" value="c3">Синие<Br> 
                </div> 
                <!--Кнопки добавить / сбросить-->
                <div class = "addOrClear">
                    <input class="butAddOrClr" type="submit" value="Применить">
                    <input class="butAddOrClr" type="submit" value="Очистить">
                </div>
            </form>
        </div> 
        <!--Блок товаров-->
        <div class = "prdMain">
            <!--Выбранные фильтры, скрыто, если ни один фильтр не выбран-->
            <div class = "selectedFilters">
                <span>(Фильтр1)</span> <span> x <span> <span>(Фильтр2)</span> <span> x <span><span>(Фильтр3)</span>
            </div>
            <div class = "products">
                <!--Карточка товара 1-->
                <?php while($prod = mysqli_fetch_array($product)) : ?>
                    <?php
                    $image = new Images();
                    $image_obj = $image->getById($prod['id']);

                    $image_info = mysqli_fetch_array($image_obj);
                    ?>
                <div class="product">
                    <a class="prdListItem" href="/products/<?= $prod['id'] ?>/">
                        <div class="prdInf">
                            <img class="prdImg" src="/uploads/small/<?= $image_info['path'] ?>" alt="">
                            <h5 class="prdH5"><?= $prod['title'] ?></h5>
                            <h4 class="prdH4"><?= $prod['price'] ?> ₽</h4>
                         </div>
                    </a>
                    <a href="/products/<?= $prod['id'] ?>/" class="butPrd">
                        <div>
                            <input type="button" class="prdButton" value="Добавить в корзину">
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
<!--            <div class = "pagination">-->
<!--                <ul> -->
<!--                    <li class = "back"><a href = "#">предыдущая</a></li>Добавить стрелочку налево-->
<!--                    <li><a href = "#">1</a></li>-->
<!--                    <li><a href = "#">2</a></li>-->
<!--                    <li><a href = "#">3</a></li>-->
<!--                    <li><a href = "#">4</a></li>-->
<!--                    <li class = "next"><a href = "#">следующая</a></li>Добавить стрелочку направо-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div> 
</main>