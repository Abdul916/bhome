<?php

class User_Controller_Index extends LoginApp_Controller_Index
{
	public function getUserModel()
	{
		return new User_Model_User( User_User::getDbConnection());
		// return Core_Base_Response
	}
	
	public function index($req) {

		$registros = new User_Model_Admin( User_User::getDbConnection());
		$registros->collection()->runSelect();

		$res = new Core_Base_Response( $this);
		$res->addVar('registros', $registros);
		return $res;
    }
	
}

?>