<?php

function req($dir) {

    $dir = ENGINE . $dir . '/';

    $filelist = array();

    if ($catalog = opendir($dir)) {
        do {
            $file = readdir($catalog);
            if ($file != false) {
                $filelist[] = $file;
                $count = true;
            }
            else {
                $count = false;
            }
        } while ($count);

        foreach ($filelist as $key => $file) {
            if ($file == '.' || $file == '..') {
                unset($filelist[$key]);
            }
            else {
                $filelist[$key] = $dir . $file;
            }
        }
    }

    foreach ($filelist as $file) {
        require_once "$file";
    }
}