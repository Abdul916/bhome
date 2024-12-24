<?php

/**
* Error Generico
*/
abstract class Core_Error_Error
{
	protected $_errorCode;
	protected $_errorMessage;

	static $FATAL_ERROR= 1;
	static $WARNING_ERROR= 2;
	static $USER_ERROR= 3;

	private $_errorsArray=array();


	function __construct($errorCode)
	{
		$this->_errorCode= $errorCode;
	}

	function setError($errorCode){

	}
	abstract function init();
}


?>