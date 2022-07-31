<?php

namespace MyApp;

require_once(__DIR__ .'/config.php');
require_once(__DIR__ .'/functions.php');
require_once(__DIR__ .'/Detail.php');



class Tags {

    public function getLevel1Select(){

        //大分類をとってくる
        $detailApp = new \MyApp\Detail();
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
        $detailApp = new \MyApp\Detail();
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
