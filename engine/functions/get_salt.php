<?php

function get_salt() {
    $salt = '';
    $saltLength = 10;
    for($i = 0; $i < $saltLength; $i++) {
        $salt .= chr(mt_rand(33,126));
    }
    return $salt;
}