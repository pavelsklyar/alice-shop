<?php
$connection = get_connection();

$categories = mysqli_query($connection, "SELECT * FROM `categories`") or die("Ошибка при запросе к базе данных: " . mysqli_error($connection));
?>

<div class="addProd">
    <label>
        <a href="/admin/categories/add/" class="addlink">Добавить рубрику</a>
    </label>
</div>

<table class="a-products-table">
    <tr>
        <th class="a-products-td">ID</th>
        <th class="a-products-td">Название</th>
        <th class="a-products-td">URL</th>
        <th class="a-products-td">Картинка</th>
        <th class="a-products-td">Изменить</th>
        <th class="a-products-td">Удалить</th>
    </tr>
    <?php while ($category = mysqli_fetch_array($categories)) : ?>
        <tr>
            <td class="a-products-td"><?= $category['id']; ?></td>
            <td class="a-products-td"><?= $category['name']; ?></td>
            <td class="a-products-td"><?= $category['url_name']; ?></td>
            <td class="a-products-td"><?= $category['image']; ?></td>
            <td class="a-products-td"><a href="/admin/categories/edit/<?= $category['id']; ?>">Изменить</a></td>
            <td class="a-products-td"><a href="/admin/categories/delete/status/<?= $category['id']; ?>" onclick="return confirm('Вы уверены?')">Удалить</a></td>
        </tr>
    <?php endwhile; ?>
</table>