<?php
class User_User extends Core_App_Controller_AppController
{
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
    private $firstvar = 6;

    function setup()
	{
		
		//
		// $this->setSecurityDomain('ATLAS.ADMIN');
		
		//$this->setSecurityDomain('FISG.ADMIN');
	}

	static function getDbConnection()
	{
		return Configuration::instance()->getDbConnection();
	}
}



?>
