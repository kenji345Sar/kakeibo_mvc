<?php

echo('vvvv');
require_once(__DIR__ .'/../config/config.php');

// require_once(__DIR__ .'/config.php');
// require_once(__DIR__ .'/functions.php');
// require_once(__DIR__ .'/Detail.php');
//

$detailApp = new \MyApp\Controller\SyosaiDelete();

$detailApp->run($_POST['level1_id']);

// var_dump($_POST['level1_id']);
// echo('aaaa');
// $detailApp = new \MyApp\Detail();
// var_dump($detailApp);
// $detailApp->getLevel1Delete($_POST['level1_id']);
var_dump(SITE_URL);
header('Location:' .SITE_URL);
exit;

?>
