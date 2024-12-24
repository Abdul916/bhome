<?php

/**
 * Acceso a base de datos
 */
class Core_Db_Db
{

  protected $_host;
  protected $_database;
  protected $_user;
  protected $_password;
  protected $_conection;

  function __construct($host, $database, $user, $password)
  {
    $this->_host = $host;
    $this->_database = $database;
    $this->_user = $user;
    $this->_password = $password;
    $this->connect();
  }

  public function connection()
  {
    return $this->_conection;
  }

  public function connect()
  {
    if ( Core_Db_DbConstructor::instance()->isConnectionSet())
    {
      $this->_conection =  Core_Db_DbConstructor::instance()->getConnection();
    } else {
      // echo 'set new connection <br>';
      $this->_conection = new PDO("mysql:host={$this->_host};dbname={$this->_database};charset=utf8", $this->_user, $this->_password);
      Core_Db_DbConstructor::instance()->setConnection( $this->_conection);
    }
    return $this->_conection;

    if ($this->_conection) return $this->_conection;
    $this->_conection = Core_Db_DbConstructor::instance()->connect($this->_host, $this->_database, $this->_user, $this->_password);
    return;
    $this->_conection = new PDO("mysql:host={$this->_host};dbname={$this->_database};charset=utf8", $this->_user, $this->_password);
  }

  public function connect_mysql()
  {
    if (!$this->_conection = @mysql_connect($this->_host, $this->_user, $this->_password)) {
      return new Core_Error_DbError(Core_Error_DbError::$ConectionError);
    }

    if (!@mysql_select_db($this->_database, $this->_conection)) {
      return new Core_Error_DbError(Core_Error_DbError::$DatabaseError);
    }

  }

  public function query($query_sentence)
  {
		// var_dump($query_sentence);
		// echo "<br>";
    if($query_sentence)
      $query = $this->_conection->query($query_sentence);
    else return null;

    if (!$query)
    {
      // var_dump( $query_sentence);
      throw new Exception($query_sentence . print_r($this->_conection->errorInfo() . '<hr>', true), 1);
    }

		// $query->execute();

    return $query;
  }
  public function fetchObject($resource)
  {
    return $resource->fetchAll(PDO::FETCH_OBJ);
  }
  public function getLastInsertId()
  {
    return $this->_conection->lastInsertId();
  }

  public function countRows($resource)
  {
    return $resource->rowCount();
  }

  public function query_mysql($query)
  {
    return @mysql_query($query, $this->_conection);
  }

  public function fetchObject_mysql($objRecord)
  {
    return @mysql_fetch_object($objRecord);
  }
  public function countRows_mysql($objRecord)
  {
    return @mysql_num_rows($objRecord);
  }

}


?>
