<?php

$user_id = $_SESSION['user_id'];

$bag_info = new Bag();
$bag_obj = $bag_info->get($user_id);

?>

<main class="bag">
    <h1>КОРЗИНА</h1>
    <?php if ($bag_obj->{'num_rows'}) : ?>
        <div class="kor">
            <div class="titleh">Название</div>
            <div class="numh">Количество</div>
            <div class="priceh">Цена за шт.</div>
            <div class="sum">Сумма</div>
        </div>
        <?php while($bag = mysqli_fetch_array($bag_obj)) : ?>
            <div class="kor">
                <div class="title"><?= $bag['title']; ?></div>
                <div class="num"><?= $bag['num']; ?></div>
                <div class="price"><?= $bag['price']; ?></div>
                <div class="sum"><?= $bag['num'] * $bag['price']; ?></div>
            </div>
        <?php endwhile; ?>
        <div class="korkn" >
            <form> <input class="och" value="оформить заказ" type="submit"> </form>
            <form action="/bag/clear/"> <input class="ofz" value="очистить корзину" type="submit"> </form>
        </div>
    <?php else : ?>
        <p>В вашей корзине пусто :с</p>
    <?php endif; ?>

    <a href="/logout/">Выйти</a>
</main>