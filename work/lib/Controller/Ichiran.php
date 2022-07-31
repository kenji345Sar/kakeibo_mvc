<?php

namespace MyApp\Controller;


class Ichiran extends \MyApp\Controller {

//詳細を大分類含めて全部取得する
    public function getAllSyosai(){

        $aaa = new \MyApp\Model\Detail();

        $result = $aaa->getAllSyosai();

        // $sql = "select a1.id as id1,a1.money_name as name1, a2.level1_id , a2.sort,a2.money, a2.money_name as name2  from level2_spending  as a2 left join level1_spending  as a1 on a2.level1_id = a1.id";
        // $stmt = $this->_db->query($sql);

        // $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
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

    public function getLevel1Select(){

        //大分類をとってくる
        $detailApp = new \MyApp\Model\Detail();
        $level1s = $detailApp->getAllTop();

        $level1_array = array();
        foreach($level1s as $level1){
            $level1_array += array(
            $level1->id => $level1->money_name
            );
        }

        return $level1_array;

    }


     public function getLevel2Select($id){
        $detailApp = new \MyApp\Model\Detail();
        $level2s = $detailApp->getAll($id);
        $level2_array = array();
        foreach($level2s as $level2){
            $level2_array += array(
                    $level2->sort => $level2->money_name
            );
        }
        return $level2_array;


    }
   


  
}