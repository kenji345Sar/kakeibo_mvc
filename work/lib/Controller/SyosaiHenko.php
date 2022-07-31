<?php

namespace MyApp\Controller;

class SyosaiHenko extends \MyApp\Controller {


    public function run($id,$post){

        $aaa = new \MyApp\Model\Detail();

 
        if(isset($post['edit']) && $post['edit'] == 'edit'){
          $aaa->change($post);
          $aaa->upLevel1Kingaku($id);
        }

       $this->setValues('details',$aaa->getAll($id));

        $this->setValues('total',$aaa->total($id));

        $this->setValues('level1',$aaa->getLevel1($id));



    }

//大まかな分類のデータを取得する
    // public function getLevel1($id) {

    //     $aaa = new \MyApp\Model\Detail();

    //     // $sql = sprintf("select * from level1_spending where id=%d", $id);
    //     // $stmt = $this->_db->query($sql);
    //     // return $stmt->fetchAll(\PDO::FETCH_OBJ);

    //     return $aaa->getLevel1($id);
    // }


//詳細の該当データを取得
    // public function getAll($id) {

    //     $aaa = new \MyApp\Model\Detail();


    //     // $sql = sprintf("select * from level2_spending where level1_id=%d order by sort", $id);
    //     // $stmt = $this->_db->query($sql);
    //     // return $stmt->fetchAll(\PDO::FETCH_OBJ

    //     return $aaa->getAll($id);

    // }


//該当の大まかな分類のidより合計を取得する
//合計に関しては詳細時の作成、更新時にアップする。
    // public function total($id){

    //  $aaa = new \MyApp\Model\Detail();

    //  // $sql =sprintf("select * from level2_spending where level1_id=%d",$id);
    //  //  $stmt = $this->_db->query($sql);
    //  //  $ress = $stmt->fetchAll(\PDO::FETCH_OBJ);

    //  //  $money = 0;
    //  //  foreach($ress as $res){
    //  //    $money +=  $res->money;
    //  //  }

    //  //  return $money;

    //  return $aaa->total($id);

    // }


    // public function change($post) {

    //     $aaa = new \MyApp\Model\Detail();


    //     // $firstId = $this->firstId($_POST['id']);
    //     // var_dump($firstId);
    //     // $j = 0;
    //     // for($i=$firstId; $i <=$firstId + 10; $i++){
    //     //     $j++;
    //     //     var_dump($j);
    //     //     $sql = "update level2_spending set money_name = :money_name, money= :money where level1_id=:level1_id and id=:id";
    //     //     if(isset($post['money_name_'.$j])){
    //     //         $stmt = $this->_db->prepare($sql);
    //     //         $stmt ->execute([
    //     //             ':money_name' => $post['money_name_'.$j],
    //     //             ':money'=>$post['money_kingaku_'.$j],
    //     //             ':level1_id'=>$post['id'],
    //     //             ':id'=>$post['id_key_'.$j]
    //     //         ]);
    //     //     }//if

    //     // }//for

    //     $aaa->change($post);

    // }//change


    //大まかな金額をアップデートする
    // public function upLevel1Kingaku($id){

    //     $aaa = new \MyApp\Model\Detail();

    //     $aaa->upLevel1Kingaku($id);

    //     // //level2に合計金額を取得
    //     // $money_total = $this->total($id);
    //     // //level1にアップデート
    //     // $sql = "update level1_spending set money = :money where id = :level_id";

    //     // $stmt = $this->_db->prepare($sql);
    //     // $stmt -> execute([
    //     //     ':money' =>$money_total,
    //     //     ':level_id' => $id
    //     // ]);



    // }


    public function post() {

        if (!isset($_POST['mode'])) {
          throw new \Exception('mode not set!');
        }

        switch ($_POST['mode']) {
          case 'update':
            return $this->_update();
          case 'create':
            return $this->_create();
          case 'create_level1':
            return $this->_create_level1();
          case 'delete':
            return $this->_delete();
        }
    }//post

    private function _delete() {
        if (!isset($_POST['id'])) {
            throw new \Exception('[delete] id not set!');
          }

          $aaa = new \MyApp\Model\Detail();

          $aaa->_delete();

          // $sql = sprintf("delete from level2_spending where id = %d", $_POST['id']);
          // $stmt = $this->_db->prepare($sql);
          // $stmt->execute();

          $total = $aaa->total($_POST['id']);
echo('aaaa');
var_dump($total);          
          return $total;

    }

    //大分類の追加
    private function _create_level1() {


        $aaa = new \MyApp\Model\Detail();

        if (!isset($_POST['title']) || $_POST['title'] === '') {
          throw new \Exception('[create] name not set!');
        }

        $sql = "insert into level1_spending  (money_name) values(:money_name)";

        $stmt = $aaa->_db->prepare($sql);
        $stmt->execute([
            ':money_name' => $_POST['title']
        ]);

        $id = $aaa->_db->lastInsertId();

        $level1 = $aaa->getLevel1($id);

        return [
            'money_name'=>$_POST['title'],
            'id' => $id
        ];

    }

    //詳細の追加
    private function _create() {
          if (!isset($_POST['money_name']) || $_POST['money_name'] === '') {
            throw new \Exception('[create] money_name not set!');
          }

          if (!isset($_POST['id']) || $_POST['id'] === '') {
            throw new \Exception('[create] id not set!');
          }

          $aaa = new \MyApp\Model\Detail();


          //一番最後に1を足したのsort番号
          $last_sort_id = $aaa->last_sort_id( $_POST['id']);
// echo($last_sort_id);
// var_dump($_POST);exit;
          $bbb = $aaa->_create($_POST,$last_sort_id);

          return $bbb;
          // //insert
          // $sql = "insert into level2_spending (level1_id,sort,money_name,money) values (:level1_id, :sort, :money_name, :money)";
          // $stmt = $this->_db->prepare($sql);
          // $stmt->execute([
          //     ':level1_id' => $_POST['id'],
          //     ':sort' => $last_sort_id,
          //     ':money_name' =>$_POST['money_name'],
          //     ':money' => $_POST['money']
          // ]);


          // return[
          //   'sort_id' =>  $last_sort_id,
          //   'money_name' => $_POST['money_name'],
          //   'money_kingaku' => $_POST['money']

          // ];


      }//_create




}