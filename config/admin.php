<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

//var_dump($path);

if (count($path) < 5) {
    $module = $path[2];

    if ($module) {
        echo render("admin/" . $module . ".php");
    }
    else {
        echo render("admin/index.php");
    }
}
else if (count($path) == 5) {
    $module = $path[2];
    $action = $path[3];
    $param[0] = $path[4];

    if ($module && $action) {
        echo render('admin/' . $module . '/' . $action . '.php', $param);
    }
    else {
        echo "Страницы не существует!";
    }
}
else {
    $moduleFilename = MODULES . 'admin.php';
    $moduleName = $path[1];
    $module = $path[2];
    $action = $path[3];

    if ($moduleName && $module && $action) {
        $function = $moduleName . '_' . $module . '_' . $action;
    }
    else {
        echo "Страницы не существует!";
    }

    if (file_exists($moduleFilename)) {
        require_once "$moduleFilename";

        if(function_exists($function)) {
            $function();
        }
        else {
            echo render('404.php');
        }
    }
    else {
        echo render('404.php');
    }
}