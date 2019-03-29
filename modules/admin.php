<?php

function admin_index() {
    echo render("admin/main.php");
}

function admin_categories_add() {
    if (!empty($_POST)) {

        if (!empty($file = $_FILES['image'])) {

            if ($file['error'] != 0) {
                echo "Ошибка при загрузке файла #1: Загружаемый файл отсутствует!";
                return false;
            }

            if ($file['size'] == 0) {
                echo "Ошибка при загрузке файла #2: Размер файла равен нулю!";
                return false;
            }

            foreach ($file as $f => $val) {
                $image[] = $val;
            }

            $filename = hash('sha256', $image[0]);
            $img['img'] = getimagesize($image[2]);
            $size = explode('"', $img['img'][3]);
            $width = (int)$size[1];
            $height = (int)$size[3];

            while ($width >= 500) {
                $width /= 2;
                $height /= 2;
            }

            move_uploaded_file($image[2], UPLOADS . $filename);
            resize(UPLOADS . $filename, UPLOADS_SMALL . $filename, $width, $height);

        }
        else {
            echo "Ошибка при загрузке файла #1: Загружаемый файл отсутствует!";
            return false;
        }

        $name = htmlspecialchars($_POST['name']);
        $url_name = htmlspecialchars($_POST['url_name']);

        $add = new Categories();
        $add->add($name, $url_name, $filename);

    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function admin_categories_edit() {

    if (!empty($_POST)) {
        $url = $_SERVER['REQUEST_URI'];

        if ($cleanURL = stristr($url, '?', true)) {
            $path = explode('/', $cleanURL);
        }
        else {
            $path = explode('/', $url);
        }

        $id = $path[5];
        $name = htmlspecialchars($_POST['name']);
        $url_name = htmlspecialchars($_POST['url_name']);

        $edit = new Categories();
        $edit->edit($id, $name, $url_name);
    }
    else {
        echo "Ошибка: форма была пустая!";
    }

}

function admin_categories_delete() {

    $url = $_SERVER['REQUEST_URI'];

    if ($cleanURL = stristr($url, '?', true)) {
        $path = explode('/', $cleanURL);
    }
    else {
        $path = explode('/', $url);
    }

    $id = $path[5];

    $delete = new Categories();
    $delete->delete($id);

}

function admin_catalogue_add() {
    if (!empty($_POST)) {

        $files = $_FILES['images'];

        if (!empty($files)) {

            $images = array();
            $images_name = array();

            foreach ($files['error'] as $error) {
                if ($error != 0) {
                    echo 'Ошибка при загрузке файла - загружаемый файл отсутствует!';
                    return false;
                }
            }

            foreach ($files['size'] as $size) {
                if ($size == 0) {
                    echo 'Ошибка при загрузке файла - размер файла равен нулю!';
                    return false;
                }
            }

            foreach ($files as $file) {
                foreach ($file as $f => $val) {
                    $f += 1;
                    $images['$_IMAGE_' . $f][] = $val;
                }
            }

            foreach ($images as $key => $image) {

                $filename = hash('sha256', $image[0]);
                $images_name[] = $filename;
                $img['img'] = getimagesize($image[2]);
                $size = explode('"', $img['img'][3]);
                $width = (int)$size[1];
                $height = (int)$size[3];

                while ($width >= 500) {
                    $width /= 2;
                    $height /= 2;
                }

                move_uploaded_file($image[2], UPLOADS . $filename);
                resize(UPLOADS . $filename, UPLOADS_SMALL . $filename, $width, $height);
            }

            $categories_id = htmlspecialchars($_POST['categories_id']);
            $title = htmlspecialchars($_POST['title']);
            $characteristics = htmlspecialchars($_POST['characteristics']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $meta = htmlspecialchars($_POST['meta']);

            $add = new Catalogue();
            $add->add($categories_id, $title, $characteristics, $description, $price, $meta, $images_name);

        }
        else {
            echo "Ошибка: нет загружаемых файлов!";
        }
    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function admin_catalogue_edit() {
    if (!empty($_POST)) {

        $url = $_SERVER['REQUEST_URI'];

        if ($cleanURL = stristr($url, '?', true)) {
            $path = explode('/', $cleanURL);
        }
        else {
            $path = explode('/', $url);
        }

        $id = $path[5];
        $category_id = htmlspecialchars($_POST['categories_id']);
        $title = htmlspecialchars($_POST['title']);
        $characteristics = htmlspecialchars($_POST['characteristics']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);
        $meta = htmlspecialchars($_POST['meta']);

        $edit = new Catalogue();
        $edit->edit($id, $category_id, $title, $characteristics, $description, $price, $meta);
    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function admin_catalogue_delete() {
    $url = $_SERVER['REQUEST_URI'];

    if ($cleanURL = stristr($url, '?', true)) {
        $path = explode('/', $cleanURL);
    }
    else {
        $path = explode('/', $url);
    }

    $id = $path[5];

    $delete = new Catalogue();
    $delete->delete($id);
}

function admin_news_add() {
    if (!empty($_POST)) {
        //var_dump($_POST);

        $files = $_FILES['images'];

        if (!empty($files)) {

            $images = array();
            $news_images = array();

            foreach ($files['error'] as $error) {
                if ($error != 0) {
                    echo 'Ошибка при загрузке файла - загружаемый файл отсутствует!';
                    return false;
                }
            }

            foreach ($files['size'] as $size) {
                if ($size == 0) {
                    echo 'Ошибка при загрузке файла - размер файла равен нулю!';
                    return false;
                }
            }

            foreach ($files as $file) {
                foreach ($file as $f => $val) {
                    $f += 1;
                    $images['$_IMAGE_' . $f][] = $val;
                }
            }

            foreach ($images as $key => $image) {

                $filename = hash('sha256', $image[0]);
                $news_images[] = $filename;
                $img['img'] = getimagesize($image[2]);
                $size = explode('"', $img['img'][3]);
                $width = (int)$size[1];
                $height = (int)$size[3];

                while ($width >= 500) {
                    $width /= 2;
                    $height /= 2;
                }

                move_uploaded_file($image[2], UPLOADS . $filename);
                resize(UPLOADS . $filename, UPLOADS_SMALL . $filename, $width, $height);

                $path = '/uploads/' . $filename;
                $imgtag = '</p><div class=news-img><img src=' . $path . '></div><p>';

                $_POST['content'] = str_replace($key, $imgtag, $_POST['content']);
                $_POST['content'] = '<p>' . $_POST['content'] . '</p>';
            }

        }
        else {
            echo "Ошибка: нет загружаемых файлов!";
        }

        $news_title = htmlspecialchars($_POST['title']);
        $news_content = htmlspecialchars(replace_aps($_POST['content']));
        $news_date = date("Y-m-d", time());
        $news_time = date("H:i");

        $new_post = new News();
        $new_post->add($news_title, $news_content, $news_date, $news_time, $news_images);
    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function admin_news_edit() {
    if (!empty($_POST)) {
        $url = $_SERVER['REQUEST_URI'];

        if ($cleanURL = stristr($url, '?', true)) {
            $path = explode('/', $cleanURL);
        }
        else {
            $path = explode('/', $url);
        }

        $post_id = $path[5];
        $post_title = htmlspecialchars($_POST['title']);
        $post_content = htmlspecialchars(replace_aps($_POST['content']));

        $edit_post = new News();
        $edit_post->edit($post_id, $post_title, $post_content);
    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function admin_news_delete() {
    $url = $_SERVER['REQUEST_URI'];

    if ($cleanURL = stristr($url, '?', true)) {
        $path = explode('/', $cleanURL);
    }
    else {
        $path = explode('/', $url);
    }

    $post_id = $path[5];

    $delete_post = new News();
    $delete_post->delete($post_id);
}

function admin_users_add() {
    if (!empty($_POST)) {
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));
        $name = htmlspecialchars(trim($_POST['name']));
        $surname = htmlspecialchars(trim($_POST['surname']));

        $salt = get_salt();
        $password = md5($password . $salt);

        $new_user = new Users();
        $new_user->add($login, $password, $salt, $name, $surname);
    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function admin_users_edit() {
    if (!empty($_POST)) {
        $url = $_SERVER['REQUEST_URI'];

        if ($cleanURL = stristr($url, '?', true)) {
            $path = explode('/', $cleanURL);
        }
        else {
            $path = explode('/', $url);
        }

        $id = $path[5];
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));
        $name = htmlspecialchars(trim($_POST['name']));
        $surname = htmlspecialchars(trim($_POST['surname']));

        $salt = get_salt();
        $password = md5($password . $salt);

        $new_user = new Users();
        $new_user->edit($id, $login, $password, $salt, $name, $surname);
    }
    else {
        echo "Ошибка: форма была пустая!";
    }
}

function admin_users_delete() {
    $url = $_SERVER['REQUEST_URI'];

    if ($cleanURL = stristr($url, '?', true)) {
        $path = explode('/', $cleanURL);
    }
    else {
        $path = explode('/', $url);
    }

    $id = $path[5];

    $delete_user = new Users();
    $delete_user->delete($id);
}