<?php

function get_connection() {
    static $connection = null;

    $config = require CONFIG . "database.php";

    $connection = mysqli_connect(
        $config['server'],
        $config['user'],
        $config['password'],
        $config['database']
    );
    mysqli_query($connection, "set NAMES utf8");

    return $connection;
}