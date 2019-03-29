<?php
$connection = get_connection();

$users = mysqli_query($connection, "SELECT * FROM users");
?>

<div class="addProd">
    <label>
        <a href="/admin/users/add/" class="addlink">Добавить пользователя</a>  
    </label>
</div>

<table class="a-products-table">
    <tr>
        <th class="a-products-td">ID</th>
        <th class="a-products-td">Логин</th>
        <th class="a-products-td">Имя</th>
        <th class="a-products-td">Фамилия</th>
        <th class="a-products-td">Изменить</th>
        <th class="a-products-td">Удалить</th>
    </tr>
    <?php while ($users_array = mysqli_fetch_assoc($users)) : ?>
        <tr>
            <td class="a-products-td"><?= $users_array['id']; ?></td>
            <td class="a-products-td"><?= $users_array['login']; ?></td>
            <td class="a-products-td"><?= $users_array['name']; ?></td>
            <td class="a-products-td"><?= $users_array['surname']; ?></td>
            <td class="a-products-td"><a href="/admin/users/edit/<?= $users_array['id']; ?>">Изменить</a></td>
            <td class="a-products-td"><a href="/admin/users/delete/status/<?= $users_array['id']; ?>" onclick="return confirm('Вы уверены?')">Удалить</a></td>
        </tr>
    <?php endwhile; ?>
</table>