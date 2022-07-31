<?php

// session_start();

require_once(__DIR__ .'/../config/config.php');


// require_once(__DIR__ . '/config.php');
// require_once(__DIR__ . '/functions.php');
// require_once(__DIR__ . '/Detail.php');

// $detailApp = new \MyApp\Detail();

$detailApp = new \MyApp\Controller\SyosaiHenko();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $res = $detailApp->post();
    header('Content-Type: application/json');
    echo json_encode($res);
    exit;
  } catch (Exception $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}
