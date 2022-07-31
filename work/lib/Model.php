<?php

namespace MyApp;

class Model {

  private static $instance;

  private static $pdo;
  protected $_db;

  // public function __construct()
  // {
  //   $this->_db = $this->getInstance();
  // }

  // public function getInstance()
  public function __construct()
  {
    try {
// var_dump(self::$_db);
var_dump('cccabbb');
          var_dump(DSN);
          var_dump(DB_USER);
          var_dump(DB_PASS);
      // if (!isset(self::$_db)) {
          $this->_db = new \PDO(
          DSN,
          DB_USER,
          DB_PASS,
          [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_EMULATE_PREPARES => false,
          ]
        );
      // }
      var_dump('abbb');
  // var_dump(self::$_db);exit;
      // return self::$_db;
    } catch (\PDOException $e) {
      echo $e->getMessage();
      var_dump('aaaa');
      exit;
    }
  }



  // public static function getInstance()
  // {
  //   try {
  //     if (!isset(self::$instance)) {
  //       self::$instance = new \PDO(
  //         DSN,
  //         DB_USER,
  //         DB_PASS,
  //         [
  //           \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
  //           \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
  //           \PDO::ATTR_EMULATE_PREPARES => false,
  //         ]
  //       );
  //     }
  
  //     return self::$instance;
  //   } catch (\PDOException $e) {
  //     echo $e->getMessage();
  //     exit;
  //   }
  // }

  // protected $db;

    // public function __construct(){
    //     try {
    //       var_dump(DSN);
    //       var_dump(DB_USER);
    //       var_dump(DB_PASS);
    //       $this->_db = new \PDO(DSN,DB_USER, DB_PASS,
    //       [
    //         \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    //         \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
    //         \PDO::ATTR_EMULATE_PREPARES => false,
    //       ]
    //      );
    //       // $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    //     } catch (\PDOException $e) {
    //         echo $e->getMessage();
    //         echo('ここ');
    //         exit;
    //     }
    // }

}