<?php
/**
 * Clase que se encarga controlar llamadas REST. La clase soporta el mapeo de CRUD contra un Modelo especifico
 *
 * @category	Core
 * @package 	App_Controller
 * @author 		Hector Centeno
 * @version 	1.0
 **/
abstract class Core_App_Controller_Rest extends Core_App_Controller_Controller
{
	protected $_method;
	protected $_strModel;
	protected $_model;
	
	//abstract function setup();
	public function index( $req)
	{
		return null;
	}
	public function setModel( $strModel)
	{
		$this->_strModel = $strModel;
	}
	public function getModel()
	{
		if( $this->_strModel)
		{
			return null;
		}else
		{
			trigger_error("No se ha definido el modelo para Rest " . $this->_tableName, E_USER_ERROR);
			return;
		}
	}
	public function process(Core_Base_Request $req)
	{
		$method = $this->_method = $req->getMethod();
		$response= $this->$method($req);
		return $response;
	}
	
} // END abstract class Core_App_Controller_Rest
?>