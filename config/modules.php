<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

var_dump($path);

if (count($path) < 4) {
    $moduleName = empty($path[1]) ? 'main' : $path[1];
    $action = empty($path[2]) ? 'index' : $path[2];

    if ($path[1] == 'admin') {
        $moduleFilename = MODULES . 'admin.php';
        $function = $moduleName . '_' . $action;
    }
    else if ($path[1] == 'catalogue') {
        $moduleFilename = MODULES . 'catalogue.php';
        $function = $moduleName . '_' . $action;
    }
    else if ($path[1] == 'products') {
        $moduleFilename = MODULES . 'catalogue.php';
        $function = $moduleName . '_' . $action;
    }
    else if ($path[1] == 'news') {
        $moduleFilename = MODULES . 'news.php';
        $function = $moduleName . '_' . $action;
    }
    else if ($path[1] == 'auth' || $path[1] == 'reg' || $path[1] == 'logout') {
        $moduleFilename = MODULES . 'users.php';
        $function = $moduleName . '_' . $action;
    }
    else {
        $moduleFilename = MODULES . 'main.php';
        $function = $moduleName . '_' . $action;
    }
}
else {
    if ($path[1] == 'admin') {
        if ($path[2] == 'auth') {
            $action = $path[2];
        }
        else {
            $action = 'index';
        }
        $moduleName = $path[1];
        $moduleFilename = MODULES . $path[1] . '.php';
        $function = $moduleName . '_' . $action;
    }
    else if ($path[1] == 'news') {
        $moduleName = empty($path[1]) ? 'main' : $path[1];
        $action = empty($path[2]) ? 'index' : $path[2];
        $moduleFilename = MODULES . $path[1] . '.php';
        $function = $moduleName . '_show';
    }
    else if ($path[1] == 'catalogue') {
        $moduleName = empty($path[1]) ? 'main' : $path[1];
        $action = empty($path[2]) ? 'index' : $path[2];
        $moduleFilename = MODULES . $path[1] . '.php';
        $function = $moduleName . "_show";
        $param['action'] = $action;
    }
    else if ($path[1] == 'bag') {
        $moduleName = empty($path[1]) ? 'main' : $path[1];
        $action = empty($path[2]) ? 'index' : $path[2];
        $moduleFilename = MODULES . 'users.php';
        $function = $moduleName . "_" . $action;
    }
    else if ($path[1] == 'products') {
        if ($path[3]) {
            $moduleName = empty($path[1]) ? 'main' : $path[1];
            $action = empty($path[2]) ? 'index' : $path[2];
            $moduleFilename = MODULES . 'catalogue.php';
            $function = $moduleName . "_add";
            $param['action'] = $action;
        }
        else {
            $moduleName = empty($path[1]) ? 'main' : $path[1];
            $action = empty($path[2]) ? 'index' : $path[2];
            $moduleFilename = MODULES . 'catalogue.php';
            $function = $moduleName . "_show";
            $param['action'] = $action;
        }
    }
    else if ($path[1] == 'auth' || $path[1] == 'reg') {
        $moduleName = empty($path[1]) ? 'main' : $path[1];
        $action = empty($path[2]) ? 'index' : $path[2];
        $moduleFilename = MODULES . 'users.php';
        $function = $moduleName . "_" . $action;
        $param['action'] = $action;
    }
    else {
        $module = empty($path[1]) ? 'main' : $path[1];
        $moduleName = empty($path[2]) ? 'main' : $path[2];
        $action = empty($path[3]) ? 'index' : $path[3];

        $moduleFilename = MODULES . $module . '.php';
        $moduleName = str_replace('-', '', $moduleName);
        $function = $module . '_' . $moduleName . '_' . $action;
    }
}

if (file_exists($moduleFilename)) {
    require_once "$moduleFilename";

    if (function_exists($function)) {
        if ($param) {
            $function($param);
        }
        else {
            $function();
        }
    }
    else {
        echo render('navigation.php');
        echo render('404.php');
    }
}
else {
    echo render('navigation.php');
    echo render('404.php');
}