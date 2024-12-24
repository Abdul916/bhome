<?php

/**
* Modelo de usuarios
*/
class Cms_Model_User extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTableName( 'users');
		$this->setFields( array('id', 'name', 'email', 'password', 'valid', 'created_at', 'updated_at'));
		$this->setUpdateFields( array('name', 'email', 'password', 'valid'));
	}
}

?>