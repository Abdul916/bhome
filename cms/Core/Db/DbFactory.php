<?php
/*
 * Descripcion corta
 *
 * Descripci—n larga
 * Created on May 25, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_Db_DbFactory {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
	static private $instance = null;
	private $dbServers;

    private function __construct()
    {
        $dbServers = array();
    }
    static function instance()
    {
    	if(!is_object(self::$instance))
    	{
    		self::$instance = new self();
    	}
    	return self::$instance;
    }
    public function getDbConnection($host)
    {
    	if( isset($this->dbServers[$host]))
    	{
    		return new $this->dbServers[$host]();
    	}
    	error_log("La conexion para $host no existe", 0);
    	return null;
    }
    public function addServer( $host, $dbconnection)
    {
    	$this->dbServers[$host] = $dbconnection;
    	return;
    }
    public function getHost()
	{
		return $_SERVER['SERVER_NAME'];
	}
}

