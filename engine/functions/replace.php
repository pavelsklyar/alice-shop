<?php

function replace($string) {
    $string = str_replace("&lt;", "<", $string);
    $string = str_replace("&gt;", ">", $string);
    $string = str_replace("&amp;aps", "'", $string);

    return $string;
}