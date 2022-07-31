<?php

namespace MyApp\Controller;

class SyosaiDelete extends \MyApp\Controller {


    public function run($id){

        $aaa = new \MyApp\Model\Detail();

        $aaa->getLevel1Delete($id);

        // $this->setValues('total',$aaa->total($id));

        // $this->setValues('level1',$aaa->getLevel1($id));

        // if(isset($post['edit']) && $post['edit'] == 'edit'){
        //   $aaa->change($post);
        //   $aaa->upLevel1Kingaku($id);
        // }


    }

    

}