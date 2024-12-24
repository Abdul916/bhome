<?php

/**
* Conexion a base de datos desde local host
*/
class DbConfig_Colonnier implements Core_Db_IConnection
{
	private $dbConnection;
	private $_host;
	private $_database;
	private $_user;
	private $_password;

	function __construct()
	{
		$this->_host= 'localhost';
		$this->_database= 'bhome';
		$this->_user= 'root';
		$this->_password= '';
		// $this->_host= 'db772840114.hosting-data.io';
		// $this->_database= 'db772840114'; // colonnier_arquitectos_cms
		// $this->_user= 'dbo772840114';
		// $this->_password= '1.#IUD*&(hBIKv';

		$this->dbConnection = new Core_Db_Db($this->_host, $this->_database, $this->_user, $this->_password);
	}
	public function getDbConnection()
	{
		return $this->dbConnection;
	}

}

?>