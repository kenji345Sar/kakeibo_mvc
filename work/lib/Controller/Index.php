<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller{

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


   public function run($post){

      $aaa = new \MyApp\Model\Detail();

      // $aaa->hyoji_ichiran($yy,$mm);

      if(isset($post['henko'])){
        if($post['henko'] === 'henko' ){

            $this->setValues('upLevel1',$aaa->upLevel1($post['id'], $post['money_name']));

            // $aaa->getValues()->upLevel1;
            // $detailApp->upLevel1($_POST['id'], $_POST['money_name']);
        }
      }

var_dump($aaa->getAllTop());

      $this->setValues('getAllTop',$aaa->getAllTop());


      $this->setValues('getTotalMoney',$aaa->getTotalMoney());


    }



// //大まかな分類をアップデート
//     public function upLevel1($id,$name){

//         $detail = new \MyApp\Model\Detail();

//         return $detail->upLevel1($id,$name);

//     }


//     //大分類を全部とってくる。
//     public function getAllTop() {
        
//         $detail = new \MyApp\Model\Detail();

//         return $detail->getAllTop();


//     }


//     //大分類の合計
//     public function getTotalMoney(){

//         $details = $this->getAllTop();

//         $total = 0;
//         foreach($details as $detail){
//             $total += $detail->money;
//         }
//         return $total;
//     }







}