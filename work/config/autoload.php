<?php

/*
MyApp
index.php controller
MyApp\Controller\Index
-> lib/Controller/Index.php
*/

spl_autoload_register(function($class) {
  // echo('aaa');
  // var_dump($class);
  $prefix = 'MyApp\\';
  if (strpos($class, $prefix) === 0) {
    $className = substr($class, strlen($prefix));
    $classFilePath = __DIR__ . '/../lib/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($classFilePath)) {
      // echo('ok');
      require $classFilePath;
    }
  }
});