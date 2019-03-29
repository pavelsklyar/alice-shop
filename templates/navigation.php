<?php

$url = $_SERVER['REQUEST_URI'];

if ($cleanURL = stristr($url, '?', true)) {
    $path = explode('/', $cleanURL);
}
else {
    $path = explode('/', $url);
}

?>

<header>
    <div class="headd">
        <div class="logo">
                <div class="al">ALICE</div><br>
            <center>
                <span>интернет-магазин</span>
            </center>
        </div>
        <div class="menu">
            <div class="gl">
                <a href="/">
                    <?php if (!$path[1]) : ?>
                        <strong><font color="#e47fa9">ГЛАВНАЯ</font></strong>
                    <?php else : ?>
                        ГЛАВНАЯ
                    <?php endif; ?>
                </a>
            </div>

            <div class="r">
                <a href="/catalogue/">
                    <?php if ($path[1] == 'catalogue') : ?>
                        <strong><font color="#e47fa9">КАТАЛОГ</font></strong>
                    <?php else : ?>
                        КАТАЛОГ
                    <?php endif; ?>
                </a>
            </div>

            <div class="o">
                <a href="/about/">
                    <?php if ($path[1] == 'about') : ?>
                        <strong><font color="#e47fa9">О НАС</font></strong>
                    <?php else : ?>
                        О НАС
                    <?php endif; ?>
                </a>
            </div>

            <div class="r">
                <a href="/news/">
                    <?php if ($path[1] == 'news') : ?>
                        <strong><font color="#e47fa9">НОВОСТИ</font></strong>
                    <?php else : ?>
                        НОВОСТИ
                    <?php endif; ?>
                </a>
            </div>

            <div >
                <a href="/contacts/">
                    <?php if ($path[1] == 'contacts') : ?>
                        <strong><font color="#e47fa9">КОНТАКТЫ</font></strong>
                    <?php else : ?>
                        КОНТАКТЫ
                    <?php endif; ?>
                </a>
            </div>
            <?php if ($_SESSION['auth']) : ?>
                <a href="/bag/">
            <?php else : ?>
                <a href="/auth/">
            <?php endif; ?>
            <div class="bag" >
                <img style="width:30px; height:35px;" src="/img/bag.png">
            </div>
            </a>
        </div>
    </div>
</header>