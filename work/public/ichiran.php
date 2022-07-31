<?php

require_once(__DIR__ .'/../config/config.php');

// require_once(__DIR__ .'/config.php');
// require_once(__DIR__ .'/functions.php');
// require_once(__DIR__ .'/Detail.php');
// require_once(__DIR__ .'/Tags.php');

$app = new \MyApp\Controller\Ichiran();


// $detailApp = new \MyApp\Controller\Detail();
// $tagsApp = new \MyApp\Tags();

$allSyosai = $app->getAllSyosai();

$totalmoney = $app->getTotalMoney2();

$level1Select = $app->getLevel1Select();


 ?>
 <!DOCTYPE html>
 <html lang="ja">
 <head>
     <meta charset="utf-8">
     <title>家計簿</title>
     <style>
     .right{
         display: inline-block;
     }
     </style>
 </head>
 <body>
     <div><a href="index.php">戻る</a></div>
     <p>一覧</p>
     <table border="1" width="100%" cellpadding="3">
        <tr>
         <th>大分類</th><th>詳細</th><th>金額</th><th>処理</th>
        </tr>
        <?php foreach($allSyosai as $syosai): ?>
        <tr>
            <td>
                <select>
                    <?php
                        foreach($level1Select as $key=>$value){
                            if($syosai->id1 == $key){
                                echo('<option value=" '.$key.' " selected>'.$value.'</option>');
                            }else{
                                echo('<option value=" '.$key.' ">'.$value.'</option>');
                            }
                        }
                    ?>
                </select>
                </td>
            <td>
                <select>
                <?php
                    $level2Select = $app->getLevel2Select($syosai->id1);
                    foreach($level2Select as $key=>$value){
                        if($syosai->sort == $key){
                            echo('<option value=" '.$key.' " selected>' .$value.'</option>');
                        }else{
                            echo('<option value=" '.$key.' ">' .$value.'</option>');
                        }
                    }

                 ?>
             </select>
            </td>
            <td><?php echo $syosai->money; ?></td>
            <td>
                <div class="right">
                    <form method="POST"  action="ichiran_delete.php">
                    <input type="submit" name="level1_henko" value="削除">
                    <input type="hidden" name="level1_id" value="<?php echo $detail->id; ?>">
                    </form>
                </div>
                <div class="right">
                    <form method="POST"  action="ichiran_henko.php">
                    <input type="submit" name="level1_henko" value="変更">
                    <input type="hidden" name="id1" value="<?php echo $allSyosai->id1; ?>">
                <input type="hidden" name="level2" value="<?php echo $allSyosai->level1_id; ?>">
                <input type="hidden" name="sort" value="<?php echo $allSyosai->sort; ?>">
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
     </table>
     <div>合計:<?php echo $totalmoney; ?>円</div>
 </body>
 </html>
