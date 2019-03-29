<?php

define('HOME', $_SERVER['DOCUMENT_ROOT'] . '/');
define('ROOT', HOME . '../');
define('CONFIG', ROOT . 'config/');
define('ENGINE', ROOT . 'engine/');
define('MODULES', ROOT . 'modules/');
define('UPLOADS', HOME . 'uploads/');
define('UPLOADS_SMALL', UPLOADS . 'small/');
define('TEMPLATES', ROOT . 'templates/');

require_once 'req.php';

req('components');
req('functions');