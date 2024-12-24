<?php

/**
* Información sobre el request del usuario
*/
class Core_Base_Request
{
	private $_application;
	private $_controller;
	private $_action;
	private $_resource;
	private $_PUT;

	function __construct()
	{
		$this->parse();
	}
	public function parse()
	{
		$resource = null;
		$controller = null;
		
		if(isset($_GET['c'])){
			$route= $_GET['c'];
			if(strpos($route, ':') ){
				$r= explode(':',$route);
				$controller= $r[0];
				$action= $r[1];
			}else{
				$controller= $_GET['c'];
				$action= 'index';
			}
		}else if( isset($_GET['r'])){
			$action = null;
			//error_log('handle crud');
			
			$resource = $_GET['r'];
		}else{
			$controller='index';
			$action='index';
		}

		$this->_controller= $controller;
		$this->_action= $action;
		$this->_resource= $resource;

		if(! isset($_GET['a']) ){
			$_app= "index";
		}else{
			$_app=$_GET['a'];
		}
		$this->_application= $_app;
	}
	public function getApplication()
	{
		return $this->_application;
	}
	public function setApplication($app)
	{
		$this->_application= $app;
	}
	public function getController()
	{
		return $this->_controller;
	}
	public function getMethod()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
	public function handleCrud()
	{
		switch( $this->getMethod())
		{
			case 'POST':
				$json_data = file_get_contents("php://input");
				$_POST = json_decode($json_data, true);
				return $_POST;
				break;
			case 'PUT':
				$json_data = file_get_contents("php://input");
				$this->_PUT = json_decode($json_data, true);
				//error_log(print_r($this->_PUT, true));
				return $this->_PUT;
				break;
			case 'DELETE':
				$json_data = file_get_contents("php://input");
				$_DATA = json_decode($json_data, true);
				return $_DATA;
				break;
			default:
				return $_GET;
				break;
		}
	}
	public function getAction()
	{
		return $this->_action;
	}
	public function getRest()
	{
		if(isset($_GET['r']))
		{
			$resource = $_GET['r'];
			if(strpos($_GET['r'], '/') !== false)
			{
				$resource = substr($_GET['r'], 0, strpos($_GET['r'], '/'));
			}
			//error_log($resource);
			return $resource;
		}
			
		else return null;
	}
	public function getProcess()
	{
		if(isset($_POST['process']))
			return $this->post('process');
		else return null;
	}
	public function getProcessController()
	{
		if(!isset($_POST['process']))
			return null;

		$route= $_POST['process'];
		if(strpos($route, ':') ){
			$r= explode(':',$route);
			$controller= $r[0];
			$action= $r[1];
		}else{
			return null;
		}
		return $controller;
	}
	public function getProcessAction()
	{
		if(!isset($_POST['process']))
			return null;

		$route= $_POST['process'];
		if(strpos($route, ':') ){
			$r= explode(':',$route);
			$controller= $r[0];
			$action= $r[1];
		}else{
			return null;
		}
		return $action;
	}
	public function get($key)
	{
		return @$_GET[$key];
	}
	public function post($key)
	{
		return @$_POST[$key];
	}
	public function put($key)
	{
		return @$this->_PUT[$key];
	}
	public function getPost()
	{
		return $_POST;
	}
	public function getPUT()
	{
		error_log('getPUT');
		error_log(print_r($this->_PUT, true)); error_log('---');
		return $this->_PUT;
	}
	public function getGet()
	{
		return $_GET;
	}
}


?>