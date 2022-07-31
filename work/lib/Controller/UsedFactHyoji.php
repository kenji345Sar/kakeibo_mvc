<?php

namespace MyApp\Controller;

class UsedFactHyoji extends \MyApp\Controller {

    public function run($post,$yy,$mm,$dd){

        $hyoji = new \MyApp\Model\Sisyutu();
        $this->setValues('hyojiKomoku',$hyoji->hyoji_komoku($yy,$mm,$dd));

        $ress = $this->getValues()->hyojiKomoku;

      //日にち毎の合計金額
      $total = 0;
      foreach($ress as $res){
        $total += $res->kingaku;
      }
      $this->setValues('total',$total);


      //追加の場合
      $this->add($post);

      //修正の場合
      if(isset($post['submit1'])){
        // var_dump($yy);
        $yy=$post['yyyy'];
        $mm=$post['mm'];
        $dd=$post['dd'];

// var_dump($yy);
// var_dump($mm);exit;
        $hyoji->syusei_komoku($post);
        header("Location:/usedFact_hyoji.php?yy=$yy&mm=$mm&dd=$dd");
        exit;

      }elseif(isset($post['submit2'])){
        $yy=$post['yyyy'];
        $mm=$post['mm'];
        $dd=$post['dd'];

        $hyoji->hiniti_delete($post['yyyy'],$post['mm'],$post['dd'],$post['id']);
        header("Location:/usedFact_hyoji.php?yy=$yy&mm=$mm&dd=$dd");
        exit;

      }



// echo('cccccc');
// var_dump($_POST);

    }

    //マスタ取得
    public function tag1Name(){


      $tag1name = new \MyApp\Model\Tag1Name();

      return $tag1name->tag1Name();


    }

    public function add($post){
      if(isset($post) && !empty($post) && $post['way'] == 'add'){

        $yy=$post['yy'];
        $mm=$post['mm'];
        $dd=$post['dd'];

        $komokuApp = new \MyApp\Model\Detail();

        $komokuApp->create_komoku($post);

        header("Location:/usedFact_hyoji.php?yy=$yy&mm=$mm&dd=$dd");
        exit;

    }





    }

    public function select_Name(){

       $tag1name = new \MyApp\Model\Tag1Name();

       $koumoku1 = array();
        // $komokuApp = new \MyApp\Komoku();

        $koumokus = $this->tag1Name();


        foreach($koumokus as $koumoku){
          $koumoku1 += array($koumoku->id=>$koumoku->name);

        }

        $komoku_select = '<select name="koumoku1">';
        foreach($koumoku1 as $key=>$val){
            $komoku_select .= '<option value='.$key.'>'.$val.'</option>';
        }
        $komoku_select .='</select>';

        return $komoku_select;



    }

    public function komoku_sel($value){
      // $komokuApp = new MyApp\Controller\UsedFactHyoji();

        $tag1name = new \MyApp\Model\Tag1Name();


        $koumoku1 = array();
        // $komokuApp = new \MyApp\Komoku();

        $koumokus = $this->tag1Name();


        foreach($koumokus as $koumoku){
          $koumoku1 += array($koumoku->id=>$koumoku->name);

        }

        $komoku_select = '<select name="sisyutu_type">';
        foreach($koumoku1 as $key=>$val){
          if($key == $value){
            $komoku_select .= '<option value='.$key.' selected>'.$val.'</option>';
          }else{
            $komoku_select .= '<option value='.$key.'>'.$val.'</option>';
          }
          
        }
        $komoku_select .='</select>';

        return $komoku_select;


    }


    //日にちごとの登録内容
    // public function syusei_komoku($post){

    //   $update = new \MyApp\Model\Sisyutu();

    //   $update->syusei_komoku($post);

    // }


    // public function hiniti_delete($yyyy,$mm,$dd,$id){

    //   // $delete = new \MyApp\Model\Sisyutu();

    //   $delete->hiniti_delete($yyyy,$mm,$dd,$id);


    // }


    // public function hyoji_komoku($yy,$mm,$dd){

    //   $hyoji = new \MyApp\Model\Sisyutu();

    //   return $hyoji->hyoji_komoku($yy,$mm,$dd);

    // }

    //月ごとの明細
    public function hyoji_ichiran($yy,$mm){
     $sql = "select * from sisyutu where yyyy=:yyyy and mm=:mm";

      $stmt=$this->_db->prepare($sql);

      $stmt->execute([
        ':yyyy'=>$yy,
        ':mm'=>$mm,
      ]);

      $ress = $stmt->fetchAll(\PDO::FETCH_OBJ);

      return $ress;


    }


    //その月の合計金額
    public function tuki_gokei($yy,$mm){

      $ichiran = $this->hyoji_ichiran($yy,$mm);
      $gokei = 0;
      foreach($ichiran as $kobetu){
        $gokei += $kobetu->kingaku;

      }

      return $gokei;


    }



    // //日にちごとの合計金額
    // public function hiniti_gokei($yy,$mm,$dd){
    //   $ress = $this->hyoji_komoku($yy,$mm,$dd);
    //   $total = 0;
    //   foreach($ress as $res){
    //     $total += $res->kingaku;
    //   }
    //   return $total;
    // }

 
   public function create_komoku($post) {

      $create = new \MyApp\Model\Sisyutu();

      $create->create_komoku($post);


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