<?php

function main_index() {
    echo render("navigation.php");
    echo render("main/main.php");
    echo render("footer.php");
}

function about_index() {
    echo render("navigation.php");
    echo render("main/about.php");
    echo render("footer.php");
}

function contacts_index() {
    echo render("navigation.php");
    echo render("main/contacts.php");
    echo render("footer.php");
}

function bag_index() {
    echo render("navigation.php");
    echo render("main/bag.php");
    echo render("footer.php");
}