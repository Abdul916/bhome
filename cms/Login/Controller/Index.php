<?php

/**
* App Controller de la aplicación de Guestbook
*/
class Login_Controller_Index extends LoginApp_Controller_Index
{
	public function getUserModel()
	{
		return new User_Model_User( Login_Login::getDbConnection());
	}
}


?>