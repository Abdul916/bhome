<?php

/**
* Acceso a la tabla kos.users
*/
class User_Model_User extends Core_App_Model_Model2 implements Core_App_Security_IUser
{
	protected $_fields;
	protected $_credentials;
	
	function setUp()
	{
		$this->setTable('user_credentials');	// nombre de la tabla
		$this->setFields(array('id', 'user', 'password', 'hash','status','created_at'));	// Todos los campos
		$this->setUpdateFields(array( 'user', 'password', 'hash','status','updated_at'));	// los campos que puede actualizar el usuario
		$this->setHasMany('LoginApp_Model_UserProfiles', 'user_id');
		
	}
	public function newSelf(Core_Db_Db $conection)
	{
		return new self($conection);
	}
	public function findByEmail( $loginField)
	{
		$query = $this->select()->where(" email = '".$loginField."'")->runSelect();
		$this->runSelect( $query);
		if($this->getModelStatus() != User_Model_User::NULL)
		{
			$this->getCredentials();
		}
	}
	
	public function findByLoginField( $loginField)
	{
		$this->select()->where( "user = '".$loginField."'")->runSelect();
	}
	public function getSecurityLogin()
	{
		return $this->get('user');
	}
	public function getSecurityPassword()
	{
		return $this->get('password');
	}

	public function getProfile(){
		$profile = $this->getChilds('LoginApp_Model_UserProfiles');
		$profile->runSelect();
		return $profile;
	}

	public function getSystemUser($model)
	{
		$this->getChild($model)->runSelect();
	}
	

}

?>