<?php

class Core_Db_DbConstructor  
{
  static $instance;
  private $conected;
  private $counter;
  private $_conection;

  private function __construct()
  {
    $this->conected = false;
    $this->counter = 0;
  }
  public static function instance() {
    if (self::$instance == null) {
      self::$instance = new Core_Db_DbConstructor();
    }

    return self::$instance;
  }

  public function setConnection( $connection)
  {
    $this->_conection = $connection;
    $this->conected = true;
  }
  public function isConnectionSet()
  {
    return $this->conected;
  }
  function getConnection()
  {
    return $this->_conection;
  }

  public function connect($host, $database, $user, $password) {
    if($this->conected) return $this->_conection;

    echo '<br> new db connection ' . $this->counter;
    $this->_conection = null; // new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
    $this->counter = $this->counter  + 1;
    
    $this->conected = true;
    return $this->_conection;
  }

}
