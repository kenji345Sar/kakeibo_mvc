<?php

namespace MyApp\Model;

class Detail extends \MyApp\Model{


    // protected $pdo;

    // public function __construct() {
    //     var_dump($this->getInstance());
    //     $this->pdo = $this->getInstance();
    // }


//大まかな分類のデータを取得する
    public function getLevel1($id) {
        $sql = sprintf("select * from level1_spending where id=%d", $id);
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }


  //大まかな分類を削除する
  public function getLevel1Delete($id){
      $sql = "delete from level1_spending where id= :id";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
          ':id'=>$id
      ]);
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


    //一番最後のsort番号
    public function last_sort_id($id){
         $sql = 'select * from level2_spending where level1_id =' .$id. ' order by sort desc limit 1';

         $stmt = $this->_db->query($sql);
         $result = $stmt->fetch(\PDO::FETCH_OBJ);
         return $result->sort + 1 ;

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




    //大分類を全部とってくる。
    public function getAllTop() {
        

        $stmt = $this->_db->query("select * from level1_spending");
        return $stmt->fetchAll(\PDO::FETCH_OBJ);

    }


    //大分類の合計
    public function getTotalMoney(){

        $details = $this->getAllTop();

        $total = 0;
        foreach($details as $detail){
            $total += $detail->money;
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



//詳細の該当データを取得
    public function getAll($id) {
        $sql = sprintf("select * from level2_spending where level1_id=%d order by sort", $id);
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
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



    //詳細の追加
    public function _create($post,$last_sort_id) {
          // if (!isset($_POST['money_name']) || $_POST['money_name'] === '') {
          //   throw new \Exception('[create] money_name not set!');
          // }

          // if (!isset($_POST['id']) || $_POST['id'] === '') {
          //   throw new \Exception('[create] id not set!');
          // }

          // $aaa = new \MyApp\Model\Detail();


          // //一番最後に1を足したのsort番号
          // $last_sort_id = $aaa->last_sort_id( $_POST['id']);
//       echo('cccccccc');
// var_dump($post);exit;
          //insert
          $sql = "insert into level2_spending (level1_id,sort,money_name,money) values (:level1_id, :sort, :money_name, :money)";
          $stmt = $this->_db->prepare($sql);
          $stmt->execute([
              ':level1_id' => $post['id'],
              ':sort' => $last_sort_id,
              ':money_name' =>$post['money_name'],
              ':money' => $post['money']
          ]);


          return[
            'sort_id' =>  $last_sort_id,
            'money_name' => $post['money_name'],
            'money_kingaku' => $post['money']

          ];


      }//_create


    public function _delete() {

      // var_dump($_POST);exit;
        if (!isset($_POST['id'])) {
            throw new \Exception('[delete] id not set!');
          }

          $aaa = new \MyApp\Model\Detail();

          
          $sql = sprintf("delete from level2_spending where id = %d", $_POST['id']);
          $stmt = $this->_db->prepare($sql);
          $stmt->execute();

          return [];

    }





}
