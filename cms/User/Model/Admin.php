<?php

class User_Model_Admin extends Core_App_Model_Model2
{
	function setUp()
	{
		$this->setTable('admin_users');
		$this->setFields( array('id', 'name','email','secure_user_id','created_at','updated_at'));
		$this->setUpdateFields( array('name','email','secure_user_id','updated_at'));
		$this->setPointerTo('User_Model_Credentials', 'secure_user_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function getCredential()
	{
		
		$child = $this->getPointed('User_Model_Credentials');
		$child->runSelect();
		
		return $child;
	}
}

?>