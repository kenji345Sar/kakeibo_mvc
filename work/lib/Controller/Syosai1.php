<?php

namespace MyApp\Controller;

class Syosai1 extends \MyApp\Controller {

    public function run($id) {

        $aaa = new \MyApp\Model\Detail();

        $this->setValues('details',$aaa->getAll($id));

        $this->setValues('level1',$aaa->getLevel1($id));

        $this->setValues('total',$aaa->total($id));


    }

  //大まかな分類のデータを取得する
    // public function getLevel1($id) {

    //     $aaa = new \MyApp\Model\Detail();
    //     // $sql = sprintf("select * from level1_spending where id=%d", $id);
    //     // $stmt = $this->_db->query($sql);
    //     // return $stmt->fetchAll(\PDO::FETCH_OBJ);
    //     return $aaa->getLevel1($id);
    // }

//該当の大まかな分類のidより合計を取得する
//合計に関しては詳細時の作成、更新時にアップする。
    // public function total($id){

    //   $aaa = new \MyApp\Model\Detail();

    //  // $sql =sprintf("select * from level2_spending where level1_id=%d",$id);
    //  //  $stmt = $this->_db->query($sql);
    //  //  $ress = $stmt->fetchAll(\PDO::FETCH_OBJ);

    //  //  $money = 0;
    //  //  foreach($ress as $res){
    //  //    $money +=  $res->money;
    //  //  }

    //  //  return $money;

    //   $aaa->total($id);

    // }

//詳細の該当データを取得
    // public function getAll($id) {

    //     $aaa = new \MyApp\Model\Detail();
  
    //     // $sql = sprintf("select * from level2_spending where level1_id=%d order by sort", $id);
    //     // $stmt = $this->_db->query($sql);
    //     // return $stmt->fetchAll(\PDO::FETCH_OBJ);
    //     return $aaa->getAll($id);
    // }




}