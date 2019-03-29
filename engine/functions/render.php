<?php

function render($template, $params = []) {
    extract($params);

    if(file_exists(TEMPLATES . $template )) {
        ob_start();

        include TEMPLATES . $template;

        $content = ob_get_clean();

        return $content;
    } else {
        echo "Страницы не существует";
        exit();
    }
}