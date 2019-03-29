<?php

function edit_date($mysqldate) {

    $date = explode('-', $mysqldate);

    $day = $date[2];
    $month = $date[1];
    $year = $date[0];

    switch($month) {
        case 1:
            $month = 'января';
            break;
        case 2:
            $month = 'февраля';
            break;
        case 3:
            $month = 'марта';
            break;
        case 4:
            $month = 'апреля';
            break;
        case 5:
            $month = 'мая';
            break;
        case 6:
            $month = 'июня';
            break;
        case 7:
            $month = 'июля';
            break;
        case 8:
            $month = 'августа';
            break;
        case 9:
            $month = 'сентября';
            break;
        case 10:
            $month = 'октября';
            break;
        case 11:
            $month = 'ноября';
            break;
        case 12:
            $month = 'декабря';
            break;
    }

    $new_date = $day . ' ' . $month . ' ' . $year;

    return $new_date;

}