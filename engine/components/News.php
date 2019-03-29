<?php

class News
{
    private $connection;

    public function __construct()
    {
        $this->connection = get_connection();
    }

    function add($title, $content, $date, $time, $images) {

        $query = "INSERT INTO `news`(
            `title`, 
            `content`, 
            `date`, 
            `time`
        ) 
        VALUES 
            (
                '$title', 
                '$content', 
                '$date', 
                '$time'
            );";

        $status = mysqli_query($this->connection, $query) or trigger_error(mysqli_error($this->connection) . $query);

        if ($status) {
            $news = mysqli_query($this->connection, "SELECT * FROM `news` WHERE id=LAST_INSERT_ID();");
            $news_info = mysqli_fetch_array($news);
            $news_id = $news_info['id'];

            foreach ($images as $image) {
                $status_image = mysqli_query($this->connection,
                    "INSERT INTO `images`(
                    `path`, 
                    `news_id`
                ) 
                VALUES 
                    (
                        '$image', 
                        '$news_id'
                    );"
                );
            };

            if ($status_image) {
                header("Refresh: 1; url=/admin/news/");
                echo "Новость успешно добавлена!";
            }
            else {
                echo "Ошибка при добавлении картинки!";
            }
        }
        else {
            echo "Ошибка при добавлении новости!";
        }
    }

    function edit($id, $title, $content) {
        $status = mysqli_query($this->connection, "UPDATE `news` SET `title`='$title',`content`='$content' WHERE `id` LIKE '$id'");

        if ($status) {
            header("Refresh: 1; url=/admin/news/");
            echo "Новость успешно изменена.";
        }
        else {
            echo "Ошибка при изменении новости!";
        }
    }

    function delete($id) {
        $images = mysqli_query($this->connection, "SELECT * FROM `images` WHERE `news_id` LIKE $id");
        while ($images_array = mysqli_fetch_array($images)) {
            unlink(UPLOADS . $images_array['path']);
            unlink(UPLOADS_SMALL . $images_array['path']);
        }

        $delete_images = mysqli_query($this->connection, "DELETE FROM `images` WHERE `news_id` LIKE $id");
        $delete_post = mysqli_query($this->connection, "DELETE FROM `news` WHERE `id` LIKE $id");

        if ($delete_images && $delete_post) {
            header("Refresh: 1; url=/admin/news/");
            echo "Новость успешно удалена.";
        }
        else {
            echo "Ошибка при удалении новости!";
        }
    }

    function get_news() {
        return mysqli_query($this->connection, "SELECT * FROM `news` ORDER BY `id` DESC");
    }

    function get_news_by_id($id) {
        return mysqli_query($this->connection, "SELECT * FROM `news` WHERE `id` LIKE $id");
    }

    function get_images($id) {
        return mysqli_query($this->connection, "SELECT * FROM `images` WHERE `news_id` LIKE $id");
    }
}