<?php

/**
* Conexion a base de datos desde local host
*/
class DbConfig_Cms implements Core_Db_IConnection
{
	private $dbConnection;
	private $_host;
	private $_database;
	private $_user;
	private $_password;

	function __construct()
	{
		// $this->_host= '127.0.0.1';
		// $this->_database= 'layr_cms'; // colonnier_arquitectos_cms
		// $this->_user= 'root';
		// $this->_password= '';

		$this->_host= 'localhost';
		$this->_database= 'bhome';
		$this->_user= 'root';
		$this->_password= '';

		$this->dbConnection = new Core_Db_Db($this->_host, $this->_database, $this->_user, $this->_password);
	}
	public function getDbConnection()
	{
		return $this->dbConnection;
	}

}

?>