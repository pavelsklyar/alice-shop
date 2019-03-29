<?php
$connection = get_connection();

$catalogue = mysqli_query($connection, "SELECT * FROM `catalogue`") or die("Ошибка при запросе к базе данных: " . mysqli_error($connection));
?>
<div class="addProd">
<label>
        <a href="/admin/catalogue/add/" class="addlink">Добавить товар</a>
</label>
</div>

<table class="a-products-table">
    <tr>
        <th class="a-products-td">ID</th>
        <th class="a-products-td">Категория</th>
        <th class="a-products-td">Название</th>
        <th class="a-products-td">Характеристики</th>
        <th class="a-products-td">Описание</th>
        <th class="a-products-td">Цена</th>
        <th class="a-products-td">Мета-теги</th>
        <th class="a-products-td">Изменить</th>
        <th class="a-products-td">Удалить</th>
    </tr>
    <?php while ($product = mysqli_fetch_array($catalogue)) : ?>
        <tr>
            <td class="a-products-td"><?= $product['id']; ?></td>
            <td class="a-products-td"><?= $product['categories_id']; ?></td>
            <td class="a-products-td"><?= $product['title']; ?></td>
            <td class="a-products-td"><?= $product['characteristics']; ?></td>
            <td class="a-products-td"><?= $product['description']; ?></td>
            <td class="a-products-td"><?= $product['price']; ?></td>
            <td class="a-products-td"><?= $product['meta']; ?></td>
            <td class="a-products-td"><a href="/admin/catalogue/edit/<?= $product['id']; ?>">Изменить</a></td>
            <td class="a-products-td"><a href="/admin/catalogue/delete/status/<?= $product['id']; ?>" onclick="return confirm('Вы уверены?')">Удалить</a></td>
        </tr>
    <?php endwhile; ?>
</table>