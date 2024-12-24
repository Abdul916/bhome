<?php
/*
 * Se encarga de crear objetos de la clase modelos
 *
 * La clase es un singleton encargado de crear los modelos que se le soliciten,
 * enviando la conexiona base de datos que se indique segun el la aplicacion
 * contexto que se este corriendo
 *
 * Created on May 25, 2010
 *
 * @category    Core
 * @package    App_Model
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

abstract class Core_App_Model_Factory {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
    static public $instance = null;

    private function __construct($argument)
    {}

    static function instance()
    {
    	if(!is_object(self::$instance))
    	{
    		self::$instance = new self();
    	}
    	return self::$instance;
    }

    static function model( $modelstr)
    {
		$dbConnection = null;
		$model = new $modelstr( Core_Db_DbFactory::instance()->getDbConnection());
    }
}

