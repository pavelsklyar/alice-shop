<?php

class Users
{
    private $connection;

    public function __construct()
    {
        $this->connection = get_connection();
    }

    function add($login, $password, $salt, $name, $surname, $status) {
        $status = mysqli_query($this->connection, "
            INSERT INTO `users` (
              `login`, 
              `password`, 
              `salt`, 
              `name`, 
              `surname`,
              `status`
            ) 
            VALUES (
              '$login',
              '$password',
              '$salt',
              '$name',
              '$surname',
              '$status'
            );
        ");

        if ($status) {
            header("Refresh: 1; url=/admin/users/");
            echo "Пользователь успешно добавлен!";
        }
        else {
            echo "Ошибка при добавлении пользователя!";
        }
    }

    function edit($id, $login, $password, $salt, $name, $surname, $stat) {

        $status = array();

        if ($login) {
            $login_status = mysqli_query($this->connection, "UPDATE `users` SET `login` = '$login' WHERE `id` LIKE '$id'");
            $status[] = $login_status;
        }
        if ($password) {
            $password_status = mysqli_query($this->connection, "UPDATE `users` SET `password` = '$password', `salt` = '$salt' WHERE `id` LIKE '$id'");
            $status[] = $password_status;
        }
        if ($name) {
            $name_status = mysqli_query($this->connection, "UPDATE `users` SET `name` = '$name' WHERE `id` LIKE '$id'");
            $status[] = $name_status;
        }
        if ($surname) {
            $surname_status = mysqli_query($this->connection, "UPDATE `users` SET `surname` = '$surname' WHERE `id` LIKE '$id'");
            $status[] = $surname_status;
        }
        if ($status) {
            $status_status = mysqli_query($this->connection, "UPDATE `users` SET `status` = '$stat' WHERE `id` LIKE '$id'");
            $status[] = $status_status;
        }

        $check_status = false;
        foreach ($status as $value) {
            if ($value) {
                $check_status = true;
            }
            else {
                $check_status = false;
                break;
            }
        }

        if ($check_status) {
            header("Refresh: 1; url=/admin/users/");
            echo "Данные пользователя успешно изменены!";
        }
        else {
            echo "Ошибка при изменении ползователя!";
        }
    }

    function delete($id) {
        $status = mysqli_query($this->connection, "DELETE FROM `users` WHERE `id` LIKE $id");

        if ($status) {
            header("Refresh: 1; url=/admin/users/");
            echo "Пользователь успешно удалён!";
        }
        else {
            echo "Ошибка при удалении пользователя!";
        }
    }

    function get_user($login) {
        return mysqli_query($this->connection, "SELECT * FROM `users` WHERE `login` LIKE '$login'");
    }

    function auth($id, $login, $status) {
        header("Refresh: 1; url=/bag/");
        $_SESSION['auth'] = true;
        $_SESSION['user_id'] = $id;
        $_SESSION['user_login'] = $login;
        $_SESSION['user_status'] = $status;
        echo render("navigation.php");
        echo 'Вы успешно авторизовались!';
        echo render("footer.php");
    }
}