<?php

ini_set('display_errors', 1);

// define('DSN','mysql:host=localhost;dbname=myapp;charset=utf8mb4');
// define('DB_USER','myappuser');
// define('DB_PASS', 'myapppass');
define('DSN', 'mysql:host=db;dbname=myapp;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');

define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');

session_start();