<?php

namespace MyApp\Model;

class BankInOut extends \MyApp\Model{


    // public function add($post){
    //   if(isset($post) && !empty($post) && $post['way'] == 'add'){

    //     $yy=$post['yy'];
    //     $mm=$post['mm'];
    //     $dd=$post['dd'];

    //     $komokuApp = new \MyApp\Model\Detail();

    //     $komokuApp->create_komoku($post);

    //     header("Location:/usedHikiotoshi_hyoji.php?yy=$yy&mm=$mm&dd=$dd");
    //     exit;
    //   }

    // }

   public function create_komoku($post) {

      $sql = "insert into bankInOut (yyyy,mm,dd,sisyutu_type,sisyutu_name,kingaku,biko) values(:yyyy,:mm,:dd,:sisyutu_type,:sisyutu_name,:kingaku,:biko)";

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


    //日にちごとの登録内容
    public function syusei_komoku($post){


      $sql = "update bankInOut set sisyutu_type=:sisyutu_type,sisyutu_name=:sisyutu_name,kingaku=:kingaku,biko=:biko where yyyy=:yyyy and mm=:mm and dd=:dd and id=:id";

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



    //大分類を全部とってくる。
    public function hiniti_delete($yyyy,$mm,$dd,$id) {
        

      $sql = "delete from bankInOut where yyyy=:yyyy and mm=:mm and dd=:dd and id=:id";

      $stmt = $this->_db->prepare($sql);

      $stmt->execute([
        ':yyyy'=>$yyyy,
        ':mm'=>$mm,
        ':dd'=>$dd,
        ':id'=>$id
      ]);


    }


    public function hyoji_komoku($yy,$mm,$dd){

      $sql = "select * from bankInOut where yyyy=:yyyy and mm=:mm and dd=:dd";

      $stmt=$this->_db->prepare($sql);

      $stmt->execute([
        ':yyyy'=>$yy,
        ':mm'=>$mm,
        ':dd'=>$dd
      ]);

      $ress = $stmt->fetchAll(\PDO::FETCH_OBJ);

      return $ress;


    }




}
