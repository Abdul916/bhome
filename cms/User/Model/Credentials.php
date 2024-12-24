<?php

/**
* Acceso a credentials
*/
class User_Model_Credentials extends Core_App_Model_Model2
{
	const ACTIVE = 1;
	const UNACTIVE = 2;
	const REJECTED = 3;

	function setUp()
	{
		$this->setFields(array('id', 'user', 'password', 'hash', 'status', 'created_at','updated_at'));	// Todos los campos
		$this->setUpdateFields(array('user', 'status'));	// los campos que puede actualizar el usuario
		$this->setTable ('user_credentials');	// nombre de la tabla
		
		$this->setHasOne('Login_Model_Credentials', 'user_credentials_id');
		$this->setHasOne('User_Model_Profiles', 'user_id');
	}
	public function newSelf(Core_Db_Db $conection)
	{
		return new self($conection);
	}
	public function getProfile()
	{
		
		$child = $this->getChild('User_Model_Profiles');
		$child->runSelect();
		
		return $child;
	}
	public function getCredentialStatus()
	{		
	   	$status_array = array( 
	    
	           User_Model_Credentials::ACTIVE => 'Activo', 
	           User_Model_Credentials::UNACTIVE => 'Inactivo', 
	           User_Model_Credentials::REJECTED => 'Cancelado');

	   	return $status_array[ $this->get('status')];
	}

}
