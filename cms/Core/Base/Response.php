<?php

/**
* Respuesta desde un controlador
*/
class Core_Base_Response
{
	// Inidica cuanto esta respuesta contiene errores.
	private $_hasErrors;

	protected $_responsesArray;
	protected $_thisView;
	protected $_errorsArray;
	protected $_dataArray;
	protected $_isRest;
	private $_httpHeader = null;
	// indica si el view puede fue alterado por el usuario, si es 1 o 0 si se debe obtener automaticamente
	protected $_viewByUser;

	function __construct(Core_App_Controller_Controller $controller)
	{
		$this->_dataArray= array();
		$this->_errorsArray= array();
		$this->_responsesArray= array();
		$this->_isRest = false;
	}
	public function setRest()
	{
		$this->_isRest = true;
	}
	public function setData( $obj)
	{
		$this->addVar('rest', $obj);
	}
	public function isRest()
	{
		return $this->_isRest;
	}
	public function setView($view)
	{
		$this->_thisView= $view;
	}

	public function getView()
	{
		return $this->_thisView;
	}

	public function getErrors()
	{
		reset($this->_errorsArray);

		return $this->_errorsArray;
	}

	public function setError(Core_Error_Error $error)
	{
		$this->_errorsArray[]= $error;
	}

	public function hasErrors()
	{
		return $this->_hasErrors;
	}
	public function addVar($key, $value)
	{
		$this->_dataArray[$key] = $value;
	}
	public function getVar( $key)
	{
		return $this->_dataArray[$key];
	}
	public function getData()
	{
		return $this->_dataArray;
	}

	public function addResponse( $response_identifier, Core_Base_Response $response)
	{
		$dat = $response->getData();
		$err = $response->getErrors();
		$this->_responsesArray[$response_identifier] = $response;
		
		$this->addVar($response_identifier, $response->getData());
	}
	public function getResponse( $response_identifier)
	{
		if( isset( $this->_responsesArray[$response_identifier]))
		{
			return $this->_responsesArray[$response_identifier];
		}
		
		return null;
	}
	// Control de HTTP headers
	public function setHttpHeader($header)
	{
		$this->_httpHeader = $header;
	}
	public function getHttpHeader()
	{
		return $this->_httpHeader;
	}
	public function hasHttpHeader()
	{
		if(!$this->_httpHeader)
			return false;

		return true;
	}
	/* HTTP CODES */
}


?>