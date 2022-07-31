<?php

namespace MyApp\Model;

class Tag1Name extends \MyApp\Model{


    public function tag1Name(){


      $sql = "select * from tag1Name";
      $stmt = $this->_db->query($sql);

      $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

      return $result;

    }




}
