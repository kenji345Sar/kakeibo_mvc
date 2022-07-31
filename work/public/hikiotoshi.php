<?php

require_once(__DIR__ .'/../config/config.php');

$komoku = new MyApp\Controller\Hikiotoshi();


//日付を出力する
//本日の日付

try {
    if(!isset($_GET['t'])){
        throw new \Exception();
    }
    $thisMonth = new DateTime($_GET['t']);
}catch(Exception $e){
    $thisMonth = new DateTime('first day of this month');
}


    // echo('aaaa');
    $Ym = $thisMonth->format('Y-m');
    $dt = clone $thisMonth;
    $prev = $dt->modify('-1 month')->format('Y-m');
    $dt = clone $thisMonth;
    $next = $dt->modify('+1 month')->format('Y-m');
// var_dump($aaa);

// $t= '2015-09';
// $thisMonth = new DateTime($t);
// $aaa = $thisMonth->format('Ym');

// $Ym=date("Ym");

$y = substr($Ym,0,4);
$m = substr($Ym,5,6);


$getBody = $komoku->getBody1($y,$m);

$hyouji_ichiran = $komoku->hyoji_ichiran($y,$m);

// var_dump($hyouji_ichiran);

$gokei = $komoku->tuki_gokei($y,$m);



 ?>
 <!DOCTYPE html>
 <html lang="ja">
 <head>
     <meta
      charset="utf-8">
     <title>カレンダー</title>
     <style>
        #container{
            width: 500px;
            margin: 15px auto;
        }
        .today {
            font-weight: bold;
        }

        .aaa {
            padding:0 100px;
        }

     </style>
 </head>
 <body>
 <div id="container">
     <div><a href="/index.php">最初の画面</a></div>

     <table border="1" style="font-size: 12px;">
        <thead>
            <tr>
            <th><a href="/hikiotoshi.php?t=<?php echo $prev; ?>">前月</a></th>
            <th colspan="5"><?php echo($y.'年'.$m.'月');?></th>
            <th><a href="/hikiotoshi.php?t=<?php echo $next; ?>">次月</a></th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
        </tr>
         <tr>
             <?php echo $getBody; ?>
        </tr>
        </tbody>
     </table>
    <br>
    <div class="aaa">
    <div>合計:<?php echo $gokei; ?>円</div>
    <br>
    <?php foreach($hyouji_ichiran as $hyoji){ ?>
    <div>
        <?php echo $hyoji->yyyy; ?>年<?php echo $hyoji->mm; ?>月<?php echo $hyoji->dd; ?>日
    </div>
    <table>
    <tr>
    <td>
    種類:<?php 
$koumoku1 = array(
    '1'=>'食費',
    '2'=>'カフェ',
    '3'=>'お菓子',
    '4'=>'清潔品'
);
    echo $koumoku1[$hyoji->sisyutu_type]; ?>&nbsp;
    金額:<?php echo $hyoji->kingaku; ?>円<br>

    </td>
    </tr>
    </table>
    <br>
    <?php } ?>
    </div><!--aaa-->
  </div><!-- id=container -->
 </body>
 </html>
