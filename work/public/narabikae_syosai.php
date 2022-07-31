<?php

require_once(__DIR__ .'/../config/config.php');


// require_once(__DIR__ .'/config.php');
// require_once(__DIR__ .'/functions.php');
// require_once(__DIR__ .'/Detail.php');

$detailApp = new \MyApp\Controller\NarabikaeSyosai();


$detailApp->run($_POST);

$id = $_POST['id'];
$name = $detailApp->getValues()->name;
$name2 = $detailApp->getValues()->name2;

$max_cnt = $detailApp->getValues()->max_cnt;

// $detailApp = new \MyApp\Detail();
// var_dump('aaaaaaa');
// var_dump($_POST);
// if(isset($_POST['id'])){
//     $id = $_POST['id'];
//     $iid = $id;
//     //詳細の該当データを取得
//     $details = $detailApp->getAll($id);
//     $name = array();
//     $name2= array();
//     $max_cnt = 0;
//     foreach($details as $detail){
//         $name+=array(
//             $detail->sort => $detail->money_name
//         );
//         $name2+=array(
//             $detail->sort=>$detail->id
//         );

//         $max_cnt++;
//     }
// echo('5555555555');
//     var_dump($name);
//     var_dump($name2);

// }



// // var_dump($details);
// // var_dump($name);

// if($_POST['result']){
//     //該当箇所の詳細をもう一度だが呼び出す


//     //$_POST['result']内にはliのIDが上から順番コンマ区切りの文字列で格納されています。
//     //1,2,3,4 だったものを 4,2,1,3　と並び替えれば　$_POST['result']="4,2,1,3"です。

//     $result = $_POST['result'];
//     $level_id = $_POST['level_id'];

// var_dump($_POST);
//     //順に処理するために配列に格納
//     $result_array = explode(',', $result);
//     $nom = 1; //idに対して番号を１からふる
//     foreach($result_array as $no){
//         //この中で適宜DBに格納する処理
//         //"UPDATE テーブル名 SET
//         $detailApp->sortChange($nom,$_POST['idd'.$no],$level_id);
//         //  no='$nom' WHERE id='$no'";
//         $nom++;//$nomを１つずつ増やしていく
//     }

//     header("Location:./syosai1.php?id=$level_id");

// }



 ?>
 <!DOCTYPE html>
 <html lang="ja">
 <head>
     <meta charset="utf-8">
     <title>並び替え</title>
     <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
     <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
     <script>
     $(function() {
         $(".sortable").sortable();
         $(".sortable").disableSelection();
         $("#submit").click(function() {
             var result = $(".sortable").sortable("toArray");
             $("#result").val(result);
             $("form").submit();
         });
     });
     </script>
</head>
<body>
<form action="" method="post">
<ul class="sortable">
    <?php for($i=1; $i <= $max_cnt; $i++){ ?>
        <li id="<?= $i?>">
            <?=$name[$i]?>
            <input type="hidden"  name="idd<?=$i?>" value="<?=$name2[$i]?>"
        </li>
    <?php } ?>
</ul>
<input type="hidden" id="result" name="result">
<input type="hidden" id="level_id" name="level_id" value="<?php echo $id; ?>">
<button id="submit">submit</button>
</form>
</body>
</html>
