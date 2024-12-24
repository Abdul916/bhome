<?php

/**
* Objeto para control de variables de configuracion
*/
class Core_Base_Configuration
{
	protected $properties;

	private function __construct()
	{
		$this->properties= array();
	}
	public function add($prop, $var)
	{
		$this->properties[$prop]= $var;
	}
	public function get($prop)
	{
		return isset($this->properties[$prop]) ? $this->properties[$prop] : null;
	}
	public function addSessionPersisted( $prop, $value){
		Core_Base_Session::instance()->set($prop, $value);
	}
	public function getSessionPersisted( $prop){
		return Core_Base_Session::instance()->get($prop);
	}
}


?>