<?php

function get_admin_title() {
    $url = $_SERVER['REQUEST_URI'];

    if ($cleanURL = stristr($url, '?', true)) {
        $path = explode('/', $cleanURL);
    }
    else {
        $path = explode('/', $url);
    }

    switch ($path[2]) {
        case 'catalogue':
            return "Товары";
        case 'categories':
            return "Рубрики";
        case 'news':
            return "Новости";
        case 'users':
            return "Пользователи";
        case 'images':
            return "Катинки";
        default:
            return "Панель администрирования";
    }
}