<?php

class Categories
{
    private $connection;

    public function __construct()
    {
        $this->connection = get_connection();
    }

    function add($name, $url_name, $image) {

        $query = "
        INSERT INTO `categories` 
        (
            `name`, 
            `url_name`, 
            `image`
        ) 
        VALUES 
        (
            '$name', 
            '$url_name', 
            '$image'
        );";

        $status = mysqli_query($this->connection, $query);

        if ($status) {
            header("Refresh: 1; url=/admin/categories/");
            echo "Рубрика успешно добавлена!";
        }
        else {
            echo "Ошибка при добавлении!";
        }

    }

    function edit($id, $name, $url_name) {

        $query = "
        UPDATE 
          `categories`
        SET 
          `name`='$name',
          `url_name`='$url_name'
        WHERE
          `id`='$id';
        ";

        $status = mysqli_query($this->connection, $query);

        if ($status) {
            header("Refresh: 1; url=/admin/categories/");
            echo "Рубрика успешно изменена!";
        }
        else {
            echo "Ошибка при изменении!";
        }

    }

    function delete($id) {

        $category_obj = mysqli_query($this->connection, "SELECT * FROM `categories` WHERE `id`='$id'");
        $category = mysqli_fetch_array($category_obj);
        unlink(UPLOADS . $category['image']);
        unlink(UPLOADS_SMALL . $category['image']);

        $query = "
        DELETE FROM
          `categories`
        WHERE
          `id`='$id';
        ";

        $status = mysqli_query($this->connection, $query);

        if ($status) {
            header("Refresh: 1; url=/admin/categories/");
            echo "Рубрика успешно удалена!";
        }
        else {
            echo "Ошибка при удалении!";
        }

    }

    function get() {

        return mysqli_query($this->connection, "SELECT * FROM `categories`");

    }

    function getId($cat) {
        $obj = mysqli_query($this->connection, "SELECT * FROM `categories` WHERE `url_name` LIKE '$cat'");
        $category = mysqli_fetch_array($obj);

        return $category['id'];
    }

    function getName($cat) {
        $obj = mysqli_query($this->connection, "SELECT * FROM `categories` WHERE `url_name` LIKE '$cat'");
        $category = mysqli_fetch_array($obj);

        return $category['name'];
    }

    function getNameById($id) {
        $obj = mysqli_query($this->connection, "SELECT * FROM `categories` WHERE `id` LIKE '$id'");
        $category = mysqli_fetch_array($obj);

        return $category['name'];
    }

    function getUrlNameById($id) {
        $obj = mysqli_query($this->connection, "SELECT * FROM `categories` WHERE `id` LIKE '$id'");
        $category = mysqli_fetch_array($obj);

        return $category['url_name'];
    }
}