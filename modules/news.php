<?php

function news_index() {
    echo render("navigation.php");
    echo render("news/news.php");
    echo render("footer.php");
}

function news_show() {
    echo render("navigation.php");
    echo render("news/model/full.php");
    echo render("footer.php");
}