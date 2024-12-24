<?php

/**
* App Controller de la aplicación de Guestbook
*/
class Login_Login extends Core_App_Controller_AppController
{
	function setup()
	{
		
	}
	
	static function getDbConnection()
	{
		return Configuration::instance()->getDbConnection();
	}
}


?>