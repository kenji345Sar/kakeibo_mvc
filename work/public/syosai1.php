<?php

require_once(__DIR__ .'/../config/config.php');

// require_once(__DIR__ .'/config.php');
// require_once(__DIR__ .'/functions.php');
// require_once(__DIR__ .'/Detail.php');

$id = $_GET['id'];


$detailApp = new \MyApp\Controller\Syosai1();

$detailApp->run($id);

//詳細の該当データを取得
$details = $detailApp->getValues()->details;

//大まかな分類のデータを取得する
$level1 = $detailApp->getValues()->level1;

//該当（大まかな分類）の合計値を取得する
$totalMoney = $detailApp->getValues()->total;


// $detailApp = new \MyApp\Detail();

//詳細の該当データを取得
// $details = $detailApp->getAll($id);

//大まかな分類のデータを取得する
// $level1 = $detailApp->getLevel1($id);

//該当（大まかな分類）の合計値を取得する
// $totalMoney = $detailApp->total($id);
// mb_internal_encoding("UTF-8");
// echo('ddd');
// var_dump($level1);
// // $new = htmlspecialchars("<a href='test'>\"Test</a>", ENT_QUOTES);
// // $new ="<a href='test'>Test</a>";
//
// echo $new; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset='utf-8'>
    <title>家計簿</title>
</head>
<body>
    <div><a href="/index.php">最初の一覧</a></div>
    <p><?php echo h($level1[0]->money_name); ?></p>
    <ul>
       <?php foreach($details as $detail) : ?>
        <li>
            <span><?=  h($detail->money_name); ?></span>
            <span><?=  h($detail->money); ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
    <span>合計</span><span><?= h($totalMoney) ; ?></span>円
    <form method="POST" action="syosai1_henko.php">
    <p><button id="syusei">修正</button></p>
    <input type="hidden" name="id" value="<?php echo $level1[0]->id; ?>">
    </form>
    <form method="POST" action="narabikae_syosai.php">
    <p><button id="syusei">並び替え</button></p>
    <input type="hidden" name="id" value="<?php echo $level1[0]->id; ?>">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
      function kakunin(){
        alert('あああああ');
      }

    </script>
</body>
</html>
