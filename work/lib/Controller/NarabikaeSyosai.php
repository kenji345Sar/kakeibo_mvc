<?php

namespace MyApp\Controller;


class NarabikaeSyosai extends \MyApp\Controller {


    public function run($post){

        $detailApp = new \MyApp\Model\Detail();

        if(isset($post['id'])){
            $id = $post['id'];
            $iid = $id;
            //詳細の該当データを取得
            $this->setValues('details',$detailApp->getAll($id));

            $details = $this->getValues()->details;

            // $details = $detailApp->getAll($id);
            $name = array();
            $name2= array();
            $max_cnt = 0;
            foreach($details as $detail){
                $name+=array(
                    $detail->sort => $detail->money_name
                );
                $name2+=array(
                    $detail->sort=>$detail->id
                );

                $max_cnt++;
            }

            $this->setValues('name',$name);
            $this->setValues('name2',$name2);

            $this->setValues('max_cnt',$max_cnt);


            echo('5555555555');
            var_dump($name);
            var_dump($name2);

        }


        if($post['result']){
            //該当箇所の詳細をもう一度だが呼び出す


            //$_POST['result']内にはliのIDが上から順番コンマ区切りの文字列で格納されています。
            //1,2,3,4 だったものを 4,2,1,3　と並び替えれば　$_POST['result']="4,2,1,3"です。

            $result = $post['result'];
            $level_id = $post['level_id'];

        var_dump($_POST);
            //順に処理するために配列に格納
            $result_array = explode(',', $result);
            $nom = 1; //idに対して番号を１からふる
            foreach($result_array as $no){
                //この中で適宜DBに格納する処理
                //"UPDATE テーブル名 SET
                $detailApp->sortChange($nom,$post['idd'.$no],$level_id);
                //  no='$nom' WHERE id='$no'";
                $nom++;//$nomを１つずつ増やしていく
            }

            header("Location:./syosai1.php?id=$level_id");

        }




    }

  //詳細の該当データを取得
    // public function getAll($id) {

    //     $aaa = new \MyApp\Model\Detail();


    //     // $sql = sprintf("select * from level2_spending where level1_id=%d order by sort", $id);
    //     // $stmt = $this->_db->query($sql);
    //     // return $stmt->fetchAll(\PDO::FETCH_OBJ

    //     return $aaa->getAll($id);

    // }


   //sort番号を変える
    // public function sortChange($num,$idd,$lid){

    //     $aaa = new \MyApp\Model\Detail();


    //     // $sql = "update level2_spending set sort = :sort where  id=:id and level1_id=:level_id";

    //     // $stmt= $this->_db->prepare($sql);
    //     // $stmt->execute([
    //     //     ':sort' => $num,
    //     //     ':id' => $idd,
    //     //     ':level_id' => $lid
    //     // ]);

    //     $aaa->sortChange($num,$idd,$lid);

    // }





}