<?php

require_once(__DIR__ .'/../config/config.php');


// require_once(__DIR__ .'/config.php');
// require_once(__DIR__ .'/functions.php');
// require_once(__DIR__ .'/Detail.php');


$detailApp = new \MyApp\Controller\SyosaiHenko();

// $detailApp = new \MyApp\Detail();

// $level1_naiyo = $detailApp->getLevel1($_POST['level1_id']);



$detailApp->run($_POST['level1_id'],$_POST);

$level1_naiyo = $detailApp->getValues()->level1;


// var_dump($level1_naiyo);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>家計簿</title>
</head>
<body>
<div>
    <form method="post" action="index.php" id="henko">
    <span id="btn">名称変更</span><input type="text" name="money_name" value="<?php echo $level1_naiyo[0]->money_name;?>"><br>
    <input type="hidden" name="id" value="<?=h($level1_naiyo[0]->id);?>">
    <input type="hidden" name="henko" value="henko">
    </form>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
    $('#btn').click(function(){
        $('#henko').submit();
    });
</script>

</body>
</html>
