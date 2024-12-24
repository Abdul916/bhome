<?php
/*
 * Descripcion corta
 *
 * Descripci—n larga
 * Created on Feb 3, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_Base_Session {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
    static $_instance;
	private $_sessionStarted = null;
    private function __construct()
    {
    	if($this->_sessionStarted == 0)
    	{
    		$this->sessionStart();
    	}
    }

    static function instance()
    {
    	if(!is_object(Core_Base_Session::$_instance))
    	{
    		Core_Base_Session::$_instance = new self();
    	}
    	return Core_Base_Session::$_instance;
    }

    public function sessionStart()
    {
    	if($this->_sessionStarted == 0)
    		session_start();

    	$this->_sessionStarted = 1;
    }
	public function sessionClose()
	{
		setcookie(session_name() ,"",0,"/");
		unset($_COOKIE[session_name()]);
		session_unset();
		$successid=@session_destroy();
		$_SESSION = array();
	}
	public function sessionStarted()
	{
		return $this->_sessionStarted;
	}
	public function set($var, $value)
	{
		$_SESSION[$var]=$value;
	}
	public function get($var)
	{
	    return @$_SESSION[$var] ;
	}
}

