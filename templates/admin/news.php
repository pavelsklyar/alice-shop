<?php
$connection = get_connection();

$news = mysqli_query($connection, "SELECT * FROM news");
?>

<div class="addProd">
    <label>
        <a href="/admin/news/add/" class="addlink">Добавить новость</a>    
    </label>
</div>

<table class="a-products-table">
    <tr>
        <th class="a-products-td">ID</th>
        <th class="a-products-td">Название</th>
        <th class="a-products-td">Текст</th>
        <th class="a-products-td">Дата</th>
        <th class="a-products-td">Время</th>
        <th class="a-products-td">Изменить</th>
        <th class="a-products-td">Удалить</th>
    </tr>
    <?php while ($news_array = mysqli_fetch_assoc($news)) : ?>
        <tr>
            <td class="a-products-td"><?= $news_array['id']; ?></td>
            <td class="a-products-td"><?= $news_array['title']; ?></td>
            <td class="a-products-td"><?= $news_array['content']; ?></td>
            <td class="a-products-td"><?= edit_date($news_array['date']); ?></td>
            <td class="a-products-td"><?= edit_time($news_array['time']); ?></td>
            <td class="a-products-td"><a href="/admin/news/edit/<?= $news_array['id']; ?>">Изменить</a></td>
            <td class="a-products-td"><a href="/admin/news/delete/status/<?= $news_array['id']; ?>" onclick="return confirm('Вы уверены?')">Удалить</a></td>
        </tr>
    <?php endwhile; ?>
</table>