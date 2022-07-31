<?php

namespace MyApp\Model;

class Tag2Name extends \MyApp\Model{


    public function tag2Name(){


      $sql = "select * from tag2Name";
      $stmt = $this->_db->query($sql);

      $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

      return $result;

    }




}
