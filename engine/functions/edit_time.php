<?php

function edit_time($mysqldate) {

    $date = explode(':', $mysqldate);

    $hours = $date[0];
    $minutes = $date[1];
    $seconds = $date[2];

    $new_time = $hours . ':' . $minutes;

    return $new_time;

}