<?php

/**
*
*/
abstract class Core_App_Controller_AppController
{
	protected $_instace;
	protected $_dbHost;
	protected $_dbDataBase;
	protected $_dbUser;
	protected $_dbPassword;
	// Acceso a request de usuario
	private $request;
	static $_dbConnection= null;
	private $_securityController;
	private $_securityDomain ;
	static $instace =  null;

	// Rutas carpeta de vistas
	protected $_viewsPath = '';

	function __construct()
	{
			$this->request = new Core_Base_Request();
			$this->setup();
	}

	abstract function setup();

	public static function instance()
	{
		if( !is_object( self::$instace) )
		{
			self::$instace = new self();
		}
		return self::$instace;
	}

	public function run()
	{
		$this->resolve();
	}

	public function resolve()
	{
		$applicationStr = ucfirst($this->request->getApplication());
		$controllerStr = ucfirst($this->request->getController());
		$restStr = ucfirst($this->request->getRest());
		$actionStr = $this->request->getAction();
		
		$controllerString = null;
		$restString = null;
		
		if(!$restStr)
		$controllerString= $applicationStr."_Controller_".$controllerStr;
		else
		$restString= $applicationStr."_Rest_".$restStr;
		
		/**
		 * Validar el permiso de acceso al usuario
		 * */

		/* Si existe un proceso a base de datos */
		if($this->request->getProcess())
		{
			$processControllerStr= ucfirst($this->request->getProcessController());
			$processActionStr= $this->request->getProcessAction();
			$procContStr= $applicationStr."_Controller_".$processControllerStr;
			$processController= new $procContStr( $this->request);
			
			$processResponse= $processController->process($this->request, $processController); // Ejecuta la accion dentro del controlador
			
			// Implementar POST/Redirect/GET pattern
			
			$this->redirect('index.php?a='.$this->request->get('a') . '&' . Core_Common_Route::array2linkstring($_GET));
		}
		/*Si la llamada REST para acceso a un resource */
		if($this->request->getRest())
		{
			/* 
			HandleCrud solo se debe ejecutar hasta que el framework utilizara la informaci�n, ya que si se procesa antes, los datos en
			php://input se pierden despues de optenerlos
			*/
			$restResourceStr= ucfirst($this->request->getRest());
			$this->request->handleCrud();
			$controllerStr= $applicationStr."_Rest_".$restResourceStr;
			$controller = new $controllerStr( $this->request);
			$response = $controller->process( $this->request);
			$response->setRest();
		}else{
			$controller= new $controllerString( $this->request);
			$response= $controller->resolve($this->request); // Ejecuta la acci�n dentro del controlador
			
			if( isset($processResponse))
			{
				$response->addResponse( 'process_response', $processResponse);
			}
		}
		
		
		$this->resolveResponse( $response, $controller);

	}

	private function resolveResponse( Core_Base_Response $response, Core_App_Controller_Controller $controller)
	{
		if(!$response->hasErrors())
		{
			$this->loadView($response);
		}else{
			throw new Exception('Unable to resolve response', 1);
			
		}
	}
	public function setViewsPath($value='')
	{
		$this->_viewsPath = $value;
	}
	private function loadView( Core_Base_Response $response)
	{
		if(is_array($response->getData()))
		{
			extract($response->getData());
		}
		//print_r($response);
		$appfolder = ucfirst($this->request->getApplication());

		$view = $response->getView();
		
		if(is_object($response) && $view && !$response->isRest()){

			$view = $response->getView();
			$f= $view.".php";
		}else if(!$response->isRest())
		{
			
			$f=$appfolder."/View/".$this->request->getController()."/".$this->request->getAction().".php";
		}else if($response->isRest())
		{
			$f = $appfolder."/View/Rest/default.php";
		}
		
		//Shop_View_Template::instace()->title= $title;
		
		if(is_file($this->_viewsPath.$f))
		{
			if(is_object($response) && $view= $response->hasHttpHeader()){
				header($response->getHttpHeader());
			}else{
				if($response->isRest())
				{
					header("Content-Type: text/json; charset=utf-8", true);
					header("OK", true, 200);
				}else{
					header("Content-Type: text/html; charset=utf-8");
				}
				
			}

			include $this->_viewsPath."$f";
		}else
		{
			die("<h3>{$this->_viewsPath}$f no existe</h3>");
		}
	}

	private function redirect($location)
	{
		header('Location: '.$location);
		exit;
	}

	// administra la conexión a la base de datos
	static function getDbConnection()
	{
		return self::connectDb();
	}
	/* Asignaci�n y Acceso del dominio de seguridad */
	public function getSecurityDomain()
	{
		if($this->_securityDomain)
                        return $this->_securityDomain ;
                else
                    return null ;

	}

	protected function setSecurityDomain($_securityDomain)
	{
	    $this->_securityDomain = $_securityDomain ;
	}
	static function connectDb(Core_App_Controller_AppController $appObj)
	{
		//TODO que la conexion se extraiga de un lugar parametrizable diferente al codigo de la aplicacion
		if( !is_object( self::$_dbConnection))
		{
			self::$_dbConnection= new Core_Db_Db($appObj->getDbHost(), $appObj->getDbDataBase(), $appObj->getDbUser(), $appObj->getDbPassword());
		}
		return self::$_dbConnection;
	}
	static function starSession()
	{
		Core_Base_Session::sessionStart();
	}
	public function getDbHost()
	{
		return $this->_dbHost;
	}
	public function getDbDataBase()
	{
		return $this->_dbDataBase;
	}
	public function getDbUser()
	{
		return $this->_dbUser;
	}
	public function getDbPassword()
	{
		return $this->_dbPassword;
	}
}


?>