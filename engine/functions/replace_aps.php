<?php

function replace_aps($string) {
    $string = str_replace("'", "&aps", $string);

    return $string;
}