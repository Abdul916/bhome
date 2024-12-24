<?php

/**
* Controlador principal de la aplicación
*/
class Core_FrontController
{
	static $instance;
	protected $_viewspath = '';

	private function __construct()
	{

	}

	static function instance()
	{
		if ( !is_object(self::$instance))
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
	public function setSubPath( $path)
	{
		$this->_viewspath = $path;
		
		return $this;
	}
	public function run( $defaut_app =  null)
	{
		Core_Base_Session::instance()->sessionStart();
		$request = new Core_Base_Request();

		if( !isset( $_GET['a']) && $defaut_app != null)
		{
			$mainfile = $_SERVER['PHP_SELF'];
			header("Location:$mainfile?a=$defaut_app");
			exit;
		}else{
			$initApp= $request->getApplication();
		}
		$applicationStr = ucfirst($initApp);

		if(!$applicationStr)
			return false;

		$class= $applicationStr."_".$applicationStr;
		$app= new $class();

		if($app->getSecurityDomain()) {
            $profiles = Core_App_Controller_SecurityController::instance()->getUserProfile();
			$enable_access = false;
			
            if($profiles) {
                foreach($profiles as $profile)
				{
					if($app->getSecurityDomain() == $profile->getDomain())
					{
						$enable_access = true;
					}
				}
				if($enable_access){
                    $app->run();
                }
                else{
					$mainfile = $_SERVER['PHP_SELF'];
                    header('Location: '.$mainfile.'?a=login');
                    exit();
                }
            }
            else {
				$mainfile = $_SERVER['PHP_SELF'];
                header('Location:'.$mainfile.'?a=login');
                exit();
            }
        }else
		{
			$app->setViewsPath($this->_viewspath);
            $app->run();
        }
	}
}


?>