<?php

class User_Model_Profiles extends Core_App_Model_Model2
{
	function setUp()
	{
		$this->setTable('user_profiles');
		$this->setFields( array('id', 'user_id','domain','default_path','created_at','updated_at'));
		$this->setUpdateFields( array('user_id','domain','default_path','created_at','updated_at'));
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
}

?>