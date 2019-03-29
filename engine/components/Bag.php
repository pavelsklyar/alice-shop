<?php

class Bag
{
    private $connection;

    public function __construct()
    {
        $this->connection = get_connection();
    }

    public function add($id, $users_id, $title, $color, $size, $number, $price) {

        $query = "
        INSERT INTO `bag`
        (
          `users_id`,
          `title`,
          `color`,
          `size`,
          `num`,
          `price`
        )
        VALUES 
        (
          '$users_id',
          '$title',
          '$color',
          '$size',
          '$number',
          '$price'
        );
        ";

        $status = mysqli_query($this->connection, $query);

        if ($status) {
            header("Refresh: 1; url=/products/$id/");
            echo render("navigation.php");
            echo "Товар добавлен в корзину!";
            echo render("footer.php");
        }
        else {
            echo "Ошибка!";
        }

    }

    public function clear($id) {
        $status = mysqli_query($this->connection, "DELETE FROM `bag` WHERE `users_id`=$id");

        if ($status) {
            header("Location: /bag/");
        }
        else {
            echo render("navigation.php");
            echo "Ошибка при очистке корзины!";
            echo render("footer.php");
        }
    }

    public function get($id) {
        $query = "SELECT * FROM `bag` WHERE `users_id`=$id";

        return mysqli_query($this->connection, $query);
    }
}