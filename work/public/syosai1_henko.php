<?php

//修正変更画面

require_once(__DIR__ .'/../config/config.php');


// require_once(__DIR__ .'/config.php');
// require_once(__DIR__ .'/functions.php');
// require_once(__DIR__ .'/Detail.php');

$id = $_POST['id'];


$detailApp = new \MyApp\Controller\SyosaiHenko();

$detailApp->run($id,$_POST);

//postデータを反映する
//大まかな金額をアップデートする
// if(isset($_POST['edit']) && $_POST['edit'] == 'edit'){
//     $detailApp->change($_POST);
//     $detailApp->upLevel1Kingaku($id);
// }

//詳細の該当データを取得
$details = $detailApp->getValues()->details;
// $details = $detailApp->getAll($id);

//大まかな分類のデータを取得する
$level1 = $detailApp->getValues()->level1;
// $level1 = $detailApp->getLevel1($id);

//該当（大まかな分類）の合計値を取得する
$totalMoney = $detailApp->getValues()->total;
// $totalMoney = $detailApp->total($id);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset='utf-8'>
    <title>家計簿</title>
    <style>
        #money_template{
            display:none;
        }
    </style>
</head>
<body>
    <div><a href="index.php">最初の一覧</a></div>
    <p><?php echo h($level1[0]->money_name); ?></p>
    <div>
        <span>新規登録</span>
        <span><input type="text" name="money_name" value="" id="money_name"></span>
        <span><input type="text" name="money_kingaku" value=""  id="money_kingaku"></span>
        <span id="sinki">登録</span>
    </div>
    <div>
    <form method="POST" action="syosai1_henko.php">

    <ul id="money_list">
       <?php foreach($details as $detail) : ?>
        <li  id="delete_list_<?php echo($detail->id); ?>" data-id="<?php echo($detail->id); ?>">
            <input type="hidden" name="id_key_<?php echo $detail->sort; ?>" value="<?php echo h($detail->id); ?>">
            <span><input type="text" name="money_name_<?php echo $detail->sort; ?>" value="<?=  h($detail->money_name); ?>"></span>
            <span><input type="text" name="money_kingaku_<?php echo $detail->sort; ?>" value="<?=  h($detail->money); ?>"></span>
            <span class="delete_list">×</sapn>
        </li>
      <?php endforeach; ?>
      <li id="money_template" data-id="">
          <span><input type="text" name="" value="" id="moneyName"></span>
          <span><input type="text" name="" value="" id="moneyKingaku"></span>
      </li>

    </ul>
    <span>合計</span><span><?= h($totalMoney) ; ?></span>円
    <p><button id="syusei">登録変更</button></p>
    <input type="hidden" name="edit" value="edit">
    <input type="hidden" name="id" value="<?php echo $id; ?>" id="level_id">
    </form>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
      function kakunin(){
        alert('あああああ');
      }

    </script>
    <script>
    'use strict';

    $('#sinki').click(function(){
        var money_name = $('#money_name').val();
        var id = $('#level_id').val();
        var money = $('#money_kingaku').val();
        $.post('_ajax.php',{
            money_name: money_name,
            id:id,
            money: money,
            mode: 'create'
        },function(res){
            var $li = $('#money_template').clone();
            $li.find('#moneyName').attr('name','money_name_'+res.sort_id).val(res.money_name);
            $li.find('#moneyKingaku').attr('name','money_kingaku_'+res.sort_id).val(res.money_kingaku);

            // $li.find('#mondyKingaku').attr('name','money_kingaku' + res.sort_id).val(res.money_kingaku);
            $('#money_list').append($li.css('display','block'));
        });

    });

    $('#money_list').on('click', '.delete_list',function(){
        var id= $(this).parents('li').data('id');
        console.log(id);
        if(confirm(' are you sure?')){
            $.post('_ajax.php',{
                id: id,
                mode: 'delete'
            },function(res){
                console.log(res);
                $('#delete_list_'+ id).fadeOut(800);
            });
        }
    });

    </script>
</body>
</html>
