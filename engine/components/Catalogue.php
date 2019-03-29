<?php

class Catalogue
{
    private $connection;

    public function __construct()
    {
        $this->connection = get_connection();
    }

    public function add($categories_id, $title, $characteristics, $description, $price, $meta, $images) {

        $query_prod = "
        INSERT INTO `catalogue`
        (
          `categories_id`,
          `title`,
          `characteristics`,
          `description`,
          `price`,
          `meta`
        )
        VALUES
        (
          '$categories_id',
          '$title',
          '$characteristics',
          '$description',
          '$price',
          '$meta'
        );   
        ";

        $status_prod = mysqli_query($this->connection, $query_prod);

        if ($status_prod) {
            $product = mysqli_query($this->connection, "SELECT * FROM `catalogue` WHERE `id`=LAST_INSERT_ID();");
            $product_info = mysqli_fetch_array($product);
            $product_id = $product_info['id'];

            foreach ($images as $image) {
                $query_img = "
                INSERT INTO `images`
                (
                  `path`,
                  `catalogue_id`
                )
                VALUES 
                (
                  '$image',
                  '$product_id'
                );
                ";

                $status_img[] = mysqli_query($this->connection, $query_img);
            }

            foreach ($status_img as $st) {
                if ($st) {
                    $add_img = true;
                }
                else {
                    $add_img = false;
                    break;
                }
            }

            if ($add_img) {
                header("Refresh: 1; url=/admin/catalogue/");
                echo "Товар успешно добавлен!";
            }
            else {
                echo "Ошибка при добавлении картинок!";
            }
        }
        else {
            echo "Ошибка при добавлении товара!";
        }

    }

    public function edit($id, $categories_id, $title, $characteristics, $description, $price, $meta) {

        $query = "
        UPDATE
          `catalogue`
        SET
          `categories_id`='$categories_id',
          `title`='$title',
          `characteristics`='$characteristics',
          `description`='$description',
          `price`='$price',
          `meta`='$meta'
        WHERE 
          `id`
        LIKE 
          $id
        ";

        $status = mysqli_query($this->connection, $query);

        if ($status) {
            header("Refresh: 1; url=/admin/catalogue/");
            echo "Товар успешно изменён!";
        }
        else {
            echo "Ошибка при изменении товара!";
        }
    }

    public function delete($id) {
        $images_obj = mysqli_query($this->connection, "SELECT * FROM `images` WHERE `catalogue_id`=$id");

        while ($image = mysqli_fetch_array($images_obj)) {
            unlink(UPLOADS . $image['path']);
            unlink(UPLOADS_SMALL . $image['path']);
        }

        $query = "
        DELETE FROM `catalogue`
        WHERE `id`=$id
        ";
        $query_img = "
        DELETE FROM `images`
        WHERE `catalogue_id`=$id
        ";

        $status_img = mysqli_query($this->connection, $query_img);
        $status = mysqli_query($this->connection, $query);

        if ($status && $status_img) {
            header("Location: /admin/catalogue/");
            echo "Товар успешно удалён!";
        }
        else {
            echo "Ошибка при удалении товара!";
        }
    }

    public function getById($id) {
        $obj = mysqli_query($this->connection, "SELECT * FROM `catalogue` WHERE `id`=$id");

        if ($obj) {
            return mysqli_fetch_array($obj);
        }
        else {
            return null;
        }
    }

    public function getByCat($id) {
        $obj = mysqli_query($this->connection, "SELECT * FROM `catalogue` WHERE `categories_id`=$id");

        if ($obj) {
            return $obj;
        }
        else {
            return null;
        }
    }
}