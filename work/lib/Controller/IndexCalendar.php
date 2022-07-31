<?php

namespace MyApp\Controller;

class IndexCalendar extends \MyApp\Controller {
    // private $_db;
    // public function __construct(){
    //     try {
    //       $this->_db = new \PDO(DSN,DB_USERNAME, DB_PASSWORD);
    //       $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    //     } catch (\PDOException $e) {
    //         echo $e->getMessage();
    //         exit;
    //     }
    // }


    public function run($yy,$mm){

      $aaa = new \MyApp\Model\Sisyutu();

      // $aaa->hyoji_ichiran($yy,$mm);
      $this->setValues('hyojiIchiran',$aaa->hyoji_ichiran($yy,$mm));


    }

    //マスタ取得
    public function tag1Name(){
      $sql = "select * from tag1Name";
      $stmt = $this->_db->query($sql);

      $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

      return $result;

    }



    //日にちごとの登録内容
    public function syusei_komoku($post){


      $sql = "update sisyutu set sisyutu_type=:sisyutu_type,sisyutu_name=:sisyutu_name,kingaku=:kingaku,biko=:biko where yyyy=:yyyy and mm=:mm and dd=:dd and id=:id";

      $stmt = $this->_db->prepare($sql);


      $stmt->execute([
        ':sisyutu_type'=>$post['sisyutu_type'],
        ':sisyutu_name'=>$post['sisyutu_name'],
        ':kingaku'=>$post['kingaku'],
        ':biko'=>$post['biko'],
        ':yyyy'=>$post['yyyy'],
        ':mm'=>$post['mm'],
        ':dd'=>$post['dd'],
        ':id'=>$post['id']
      ]);

    }


    public function hiniti_delete($yyyy,$mm,$dd,$id){

      $sql = "delete from sisyutu where yyyy=:yyyy and mm=:mm and dd=:dd and id=:id";

      $stmt = $this->_db->prepare($sql);

      $stmt->execute([
        ':yyyy'=>$yyyy,
        ':mm'=>$mm,
        ':dd'=>$dd,
        ':id'=>$id
      ]);



    }


    // public function hyoji_komoku($yy,$mm,$dd){

    //   $sql = "select * from sisyutu where yyyy=:yyyy and mm=:mm and dd=:dd";

    //   $stmt=$this->_db->prepare($sql);

    //   $stmt->execute([
    //     ':yyyy'=>$yy,
    //     ':mm'=>$mm,
    //     ':dd'=>$dd
    //   ]);

    //   $ress = $stmt->fetchAll(\PDO::FETCH_OBJ);

    //   return $ress;


    // }

    // //月ごとの明細
    // public function hyoji_ichiran($yy,$mm){
    //  $sql = "select * from sisyutu where yyyy=:yyyy and mm=:mm";

    //   $stmt=$this->_db->prepare($sql);

    //   $stmt->execute([
    //     ':yyyy'=>$yy,
    //     ':mm'=>$mm,
    //   ]);

    //   $ress = $stmt->fetchAll(\PDO::FETCH_OBJ);

    //   return $ress;


    // }


    //その月の合計金額
    public function tuki_gokei($yy,$mm){

      $aaa = new \MyApp\Model\Sisyutu();

      $ichiran = $aaa->hyoji_ichiran($yy,$mm);
      $gokei = 0;
      foreach($ichiran as $kobetu){
        $gokei += $kobetu->kingaku;

      }

      return $gokei;


    }



    //日にちごとの合計金額
    public function hiniti_gokei($yy,$mm,$dd){

      $aaa = new \MyApp\Model\Sisyutu();


      $ress = $aaa->hyoji_komoku($yy,$mm,$dd);
      $total = 0;
      foreach($ress as $res){
        $total += $res->kingaku;
      }
      return $total;
    }

 
   public function create_komoku($post) {

      $sql = "insert into sisyutu (yyyy,mm,dd,sisyutu_type,sisyutu_name,kingaku,biko) values(:yyyy,:mm,:dd,:sisyutu_type,:sisyutu_name,:kingaku,:biko)";

      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
        ':yyyy'=> $post['yy'],
        ':mm'=>  $post['mm'],
        ':dd'=>  $post['dd'],
        ':sisyutu_type' => $post['koumoku1'],
        ':sisyutu_name' => $post['tag_name_2'],
        ':kingaku' => $post['tag_kingaku_2'],
        ':biko' => $post['tag_biko']
      ]);


      return[];

    }

    //カレンダー
    public function getBody($yy,$mm){

       // $Ym=date("Ym");

       //  $y = substr($Ym,0,4);
       //  $m = substr($Ym,5,6);
      $y = $yy;
      $m = $mm;

        $getBody='';
      $wd1= date("w",mktime(0,0,0,$m,1,$y));
      for($i=1;$i<=$wd1;$i++){
          $getBody .= "<td> </td>";
      }

       $d=1;
       while(checkdate($m,$d,$y)){

          $gokei = $this->hiniti_gokei($y,$m,$d);

          $today = date('Y-m-d');
          // var_dump($today);
          $aaa = $y.'-'.$m.'-'.$d;
          $aaa = date("Y-m-d",strtotime($aaa));
          if($aaa == $today){
             $getBody.="<td id=$d width='50px' class='today'><a href='usedFact_hyoji.php?yy=$y&mm=$m&dd=$d'>$d</a><br>{$gokei}円</td>";

          }else{
             $getBody.="<td id=$d width='50px'><a href='usedFact_hyoji.php?yy=$y&mm=$m&dd=$d'>$d</a><br>{$gokei}円</td>";

          }

           //今日が土曜日の場合
           if(date("w",mktime(0,0,0,$m,$d,$y)) == 6){
               $getBody .="</tr>";
               //次の週がある場合、新たな行を準備
               if(checkdate($m,$d + 1,$y)){
                $getBody .="<tr>";
               }

           }

           $d++;


       }

       $wdx = date("w",mktime(0,0,0,$m+1,1,$y));

       for($i=1; $i < $wdx; $i++){
           $getBody .='<td> </td>';
       }


       return $getBody;

  }



}