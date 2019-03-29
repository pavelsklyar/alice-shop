<?php

function auth_index() {
    echo render("navigation.php");
    echo render("users/auth.php");
    echo render("footer.php");
}

function auth_status() {

    if(!empty($_POST)) {
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));

        $connection = get_connection();
        $db_user = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` LIKE '$login'");

        if ($db_user->{'num_rows'}) {
            $user_info = mysqli_fetch_array($db_user);

            $check_password = md5($password . $user_info['salt']);
            if ($check_password == $user_info['password']) {
                $user = new Users();
                $user->auth($user_info['id'], $user_info['login'], $user_info['status']);
            }
        }
        else {
            echo "Такого пользователя не существует";
        }

    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function reg_index() {
    echo render("navigation.php");
    echo render("users/reg.php");
    echo render("footer.php");
}

function reg_status() {
    if (!empty($_POST)) {
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));
        $name = htmlspecialchars(trim($_POST['name']));
        $surname = htmlspecialchars(trim($_POST['surname']));
        $status = 'user';

        $users = new Users();
        $check = $users->get_user($login);
        var_dump($check);

        if (!$check->{'num_rows'}) {
            $salt = get_salt();
            $password = md5($password . $salt);

            $users->add($login, $password, $salt, $name, $surname, $status);
        }
        else {
//            header("Refresh: 1; url=/reg/");
            echo "Такой пользователь уже существует!";
        }
    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function logout_index() {
    header("Refresh: 1; url=/");
    session_unset();
    session_destroy();
    echo render("navigation.php");
    echo "Вы успешно вышли!";
    echo render("footer.php");
}

function bag_clear() {
    $bag = new Bag();
    $bag->clear($_SESSION['user_id']);
}