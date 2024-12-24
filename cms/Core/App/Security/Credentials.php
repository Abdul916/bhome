<?php
/*
 * Contiene la que el usuario entrega para accesar al sistema
 *
 * ...
 * Created on Feb 1, 2010
 *
 * @category    Core
 * @package    Core_Security
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_App_Security_Credentials {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
    private $_user;
	private $_password;
	private $_token;
	private $_expeditionTime;


    function __construct( $userLogin , $passLogin )
    {
		$this->_user= $userLogin;
		$this->_password= $passLogin;
		$this->_token= $this->getUniqueCode();
		$this->_expeditionTime= microtime();
    }
    public function getLogin()
    {
    	return $this->_user;
    }
    public function getPassword()
    {
    	return $this->_password;
    }
	private function getUniqueCode($length = false)
	{
	    $code = md5(uniqid(rand(), true));
	    $code = (strlen($code));
		if($length != "")
		{
			return substr($code, 0, $length);
		}
		else return $code;
	}
	public function getToken()
	{
		return $this->_token;
	}
}

