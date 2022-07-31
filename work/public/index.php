<?php

require_once(__DIR__ .'/../config/config.php');

// $detailApp = new MyApp\Controller\Detail();


$detailApp = new MyApp\Controller\Index();

$detailApp->run($_POST);


// if(isset($_POST['henko'])){
//     if($_POST['henko'] === 'henko' ){
//         $detailApp->getValues()->upLevel1;
//         // $detailApp->upLevel1($_POST['id'], $_POST['money_name']);
//     }
// }

$details=$detailApp->getValues()->getAllTop;
$totalMoney =$detailApp->getValues()->getTotalMoney;

var_dump('aaa');
var_dump($details);

// $details = $detailApp->getAllTop();
// $totalMoney = $detailApp->getTotalMoney();





?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset='utf-8'>
    <title>家計簿</title>
    <style>
    .right{
        display: inline-block;
    }
    #todo_template{
        display: none;
    }
    .koumoku{
        display:inline-block;
    }
    #container{
        width: 500px;
        margin: 15px auto;
    }


        </style>
</head>
<body>
<div id="container">
    <p>リスト一覧@@@@</p>
    <form action="" id="new_name_form">
        <input type="text" id="new_name">
    </form>

    <p>パターン１</p>
    <ul>
      <?php foreach($details as $detail) : ?>
       <li  style="width: 300px;" id="todo_<?php echo $detail->id; ?>">
           <div class="koumoku">
           <a href="/syosai1.php?id=<?php echo $detail->id; ?>">
           <span><?=  h($detail->money_name); ?></span>
           <span><?= h($detail->money); ?></span>
            </a>
        </div>
            <div class="right">
                <form method="POST"  action="syosai_henko.php">
                <input type="submit" name="level1_henko" value="変更">
                <input type="hidden" name="level1_id" value="<?php echo $detail->id; ?>">
                </form>
            </div>

            <div class="right">
                <form   method="POST" action="syosai_delete.php" >
                <input type="submit" name="level1_delete"　       value="削除" onclick='return confirm("よろしいですか?");'>
                <!-- <span id="level1_delete">削除</span> -->
                <input type="hidden" name="level1_id" value="<?php echo $detail->id; ?>">
                </form>
            </div>


            <!-- <span>変更</span> -->
       </li>
     <?php endforeach; ?>

    </ul>
    <li  id="todo_template" style="width: 300px;">
        <div class="koumoku">
        <a href="">
        <span id="koumoku_name">111</span>
        <span></span>
         </a>
        </div>
         <div class="right">
             <form method="POST"  action="syosai_henko.php">
             <input type="submit" name="level1_henko" value="変更">
             <input type="hidden" name="level1_id" value="<?php echo $detail->id; ?>">
             </form>
         </div>
         <div class="right">
             <form  action="" id="delete_koumoku">
             <input type="submit" id="level1_henko" value="削除">
             <input type="hidden" name="level1_id" value="<?php echo $detail->id; ?>">
             </form>
         </div>

         <!-- <span>変更</span> -->
    </li>
    <div>合計:<?php echo $totalMoney; ?>円</div>
    <br>
    <div><a href="/ichiran.php">一覧</a></div>
    <div><a href="/index_calendar.php">カレンダー</a></div>
    <div><a href="/hikiotoshi.php">引き落とし</a></div>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js">
        </script>
        <script>
        'use strict';

        $('#new_name_form').on('submit',function(){
            var title = $('#new_name').val();
            $.post('_ajax.php',{
                title: title,
                mode: 'create_level1'
            },function(res){
                console.log(res);
                var $li = $('#todo_template').clone();
                $li.attr('id', 'todo_id');
                $li.find('#koumoku_name').text(res.money_name);
                $li.find('a').attr('href','syosai1.php?id='+res.id);

                $('ul').append($li.fadeIn());

            });
            return false;
        });

        $('#level1_delete').click(function(){
            confirm('削除してよろしいですか？');

        });

        </script>
</body>
</html>
