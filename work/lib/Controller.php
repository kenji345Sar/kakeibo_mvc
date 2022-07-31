<?php

namespace MyApp;

class Controller {
  
  private $_values;

  public function __construct(){
    $this->_values = new \stdClass();
  }


  protected function setValues($key,$value){
// echo('aaaaaa');
// var_dump($key);
// var_dump($value);
// var_dump($this->_values);
    $aaa =$this->_values->$key = $value;
    // var_dump($aaa);

  }


  public function getValues(){
    // var_dump($this->_values);
    return $this->_values;
  }



}