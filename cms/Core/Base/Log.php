<?php
/*
 * Clase para llevar control de logs en los sistemas
 *
 * Descripci—n larga
 * Created on Dec 21, 2010
 *
 * @category    Core
 * @package    Base
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_Base_Log {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access static
     * @var null|Core_Base_Log
     */
    static $instace= null;
	static $logEnabled;

    private function __construct()
    {}

    public static function instance()
	{
		if( !is_object( self::$instace) )
		{
			self::$instace = new self();
		}
		return self::$instace;
	}
	public function logToDb( $ov, $model)
	{
		$tolog = '';
		if(is_object($ov))
		{
			$tolog = print_r($ov, true);
		}else{
			$tolog = $ov;
		}
		$model->set('log', $tolog);
		$model->set('time', Core_Base_Date::getDateTime());
		$model->insert();
	}
    static function log( $string)
    {
    	if(Core_Base_Log::$logEnabled)
			error_log($string);
    }
	static function logObject( $obj)
	{
		if(is_object($obj))
		{
			if(Core_Base_Log::$logEnabled)
				error_log( print_r( $obj, true), 0);
		}
	}

	static function enableLog()
	{
		Core_Base_Log::$logEnabled = true;
	}
	static function disableLog()
	{
		Core_Base_Log::$logEnabled = false;
	}
}

