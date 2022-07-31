<?php

namespace MyApp\Controller;

class Detail {
    private $_db;
    public function __construct(){
        try {
          $this->_db = new \PDO(DSN,DB_USERNAME, DB_PASSWORD);
          $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    //マスタ取得
    public function tag1Name(){
      $sql = "select * from tag1Name";
      $stmt = $this->_db->query($sql);

      $result = $stmt->fetch(\PDO::FETCH_OBJ);

      return $result;



    }



    //sort番号を変える
    public function sortChange($num,$idd,$lid){
        $sql = "update level2_spending set sort = :sort where  id=:id and level1_id=:level_id";

        $stmt= $this->_db->prepare($sql);
        $stmt->execute([
            ':sort' => $num,
            ':id' => $idd,
            ':level_id' => $lid
        ]);

    }

//詳細を大分類含めて全部取得する
    public function getAllSyosai(){
        $sql = "select a1.id as id1,a1.money_name as name1, a2.level1_id , a2.sort,a2.money, a2.money_name as name2  from level2_spending  as a2 left join level1_spending  as a1 on a2.level1_id = a1.id";
        $stmt = $this->_db->query($sql);

        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        // return $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;

    }

    //詳細の合計
    public function getTotalMoney2(){
        $stmts = $this->getAllSyosai();
        $money = 0;
        foreach($stmts as $stmt){
          $money +=  $stmt->money;
        }
        return $money;
    }

//詳細の該当データを取得
    public function getAll($id) {
        $sql = sprintf("select * from level2_spending where level1_id=%d order by sort", $id);
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

//大まかな分類のデータを取得する
    public function getLevel1($id) {
        $sql = sprintf("select * from level1_spending where id=%d", $id);
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

//大まかな分類をアップデート
    public function upLevel1($id,$name){
        $sql = "update level1_spending set money_name = :money_name where id = :id";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([
            ':money_name' =>$name,
            ':id' =>$id
        ]);
    }

    //大まかな分類を削除する
    public function getLevel1Delete($id){
        $sql = "delete from level1_spending where id= :id";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([
            ':id'=>$id
        ]);
    }

    //大まかな金額をアップデートする
    public function upLevel1Kingaku($id){

        //level2に合計金額を取得
        $money_total = $this->total($id);
        //level1にアップデート
        $sql = "update level1_spending set money = :money where id = :level_id";

        $stmt = $this->_db->prepare($sql);
        $stmt -> execute([
            ':money' =>$money_total,
            ':level_id' => $id
        ]);

    }


    //一番最後のsort番号
    public function last_sort_id($id){
         $sql = 'select * from level2_spending where level1_id =' .$id. ' order by sort desc limit 1';

         $stmt = $this->_db->query($sql);
         $result = $stmt->fetch(\PDO::FETCH_OBJ);
         return $result->sort + 1 ;

    }


    //大分類を全部とってくる。
    public function getAllTop() {
        $stmt = $this->_db->query("select * from level1_spending");
        return $stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    //大分類の合計
    public function getTotalMoney(){
        $details = $this->getAllTop();
        echo('dddcc');
        var_dump($details);
        $total = 0;
        foreach($details as $detail){
            $total += $detail->money;
        }
        return $total;
    }

//該当の大まかな分類のidより合計を取得する
//合計に関しては詳細時の作成、更新時にアップする。
    public function total($id){
     $sql =sprintf("select * from level2_spending where level1_id=%d",$id);
      $stmt = $this->_db->query($sql);
      $ress = $stmt->fetchAll(\PDO::FETCH_OBJ);

      $money = 0;
      foreach($ress as $res){
        $money +=  $res->money;
      }

      return $money;

    }

    public function firstId($id){
        $sql = sprintf("select * from level2_spending where level1_id=%d order by id", $id);
        $stmt = $this->_db->query($sql);
        $aaa = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $aaa[0]->id;
    }

    public function change($post) {
        $firstId = $this->firstId($_POST['id']);
        var_dump($firstId);
        $j = 0;
        for($i=$firstId; $i <=$firstId + 10; $i++){
            $j++;
            var_dump($j);
            $sql = "update level2_spending set money_name = :money_name, money= :money where level1_id=:level1_id and id=:id";
            if(isset($post['money_name_'.$j])){
                $stmt = $this->_db->prepare($sql);
                $stmt ->execute([
                    ':money_name' => $post['money_name_'.$j],
                    ':money'=>$post['money_kingaku_'.$j],
                    ':level1_id'=>$post['id'],
                    ':id'=>$post['id_key_'.$j]
                ]);
            }//if

        }//for
    }//change

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

          $sql = sprintf("delete from level2_spending where id = %d", $_POST['id']);
          $stmt = $this->_db->prepare($sql);
          $stmt->execute();

          return [];

    }

    //大分類の追加
    private function _create_level1() {
        if (!isset($_POST['title']) || $_POST['title'] === '') {
          throw new \Exception('[create] name not set!');
        }

        $sql = "insert into level1_spending  (money_name) values(:money_name)";

        $stmt = $this->_db->prepare($sql);
        $stmt->execute([
            ':money_name' => $_POST['title']
        ]);

        $id = $this->_db->lastInsertId();
        $level1 = $this->getLevel1($id);

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


          //一番最後に1を足したのsort番号
          $last_sort_id = $this->last_sort_id( $_POST['id']);

          //insert
          $sql = "insert into level2_spending (level1_id,sort,money_name,money) values (:level1_id, :sort, :money_name, :money)";
          $stmt = $this->_db->prepare($sql);
          $stmt->execute([
              ':level1_id' => $_POST['id'],
              ':sort' => $last_sort_id,
              ':money_name' =>$_POST['money_name'],
              ':money' => $_POST['money']
          ]);


          return[
            'sort_id' =>  $last_sort_id,
            'money_name' => $_POST['money_name'],
            'money_kingaku' => $_POST['money']

          ];


      }//_create


}
