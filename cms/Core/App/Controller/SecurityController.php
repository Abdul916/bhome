<?php
/**
 * Se encarga de los procesos de control de accesos a la aplicaci—n
 *
 * Descripci—n larga
 * Created on Feb 2, 2010
 *
 * @category    Core
 * @package    App_Controller
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_App_Controller_SecurityController {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
    private $_user;
    private $user;

    static $instance;
    private function __construct() {
        # code...
    }
    static function instance()
	{
        if(!is_object(Core_App_Controller_SecurityController::$instance)) {
            Core_App_Controller_SecurityController::$instance = new self();
        }
        return Core_App_Controller_SecurityController::$instance;
    }
    public function validateUserCredentials( Core_App_Security_Credentials $credentials,  Core_App_Security_IUser $user)
	{
		//error_log('1. Validation user credentials' , 0);
        if($user->count() > 0) {
            //el usuario existe, validar password
			//error_log('2. User is on db' , 0);
            if($user->getSecurityPassword() ==  $credentials->getPassword()) {
                // el usuario es bueno
				//error_log('3. El password fue correcto' , 0);
                $profile = $user->getProfile();
                //error_log( print_r($profile, true) , 0);
                return $profile ;

            }else{
				//error_log('4. Wrong Password' , 0);
			}
        }else{
			//error_log('5. User doesnt begin' , 0);
		}
        return null;
    }
    public function validateController(Core_App_Controller_Controller $controller)
    {
		if($controller->hasSecurityDomain())
		{
			// El controlador tiene acceso restringido
			if(Core_App_Security_User::instace()->isUserLoged())
			{
				//
				
			}
		}
    }

    public function setUser(Core_Security_IUser $user)
    {
		//
		$this->_user = $user;
    }

    private function userLogued()
    {
    	if(is_object($this->_user))
    	{
    		if($this->_user->hasCredentials())
    		{
    			return true;
    		}
    	}
    	return false;
    }
    private function validateController1( $controller)
    {
		// Core_App_Security_Clearance Contiene la informaci—n donde indica si el usario tiene los
		// permisos apropiados
		return new Core_App_Security_Clearance($controller, $this->_user);
    }
    public function getUserProfile() {
        $session = Core_Base_Session::instance() ;
        $usuario= $session->get('user');
        $pass = $session->get('password');
        if($usuario && $pass) {
            //echo 'Creando Credenciales';
            $credentials = new Core_App_Security_Credentials($usuario, $pass);

			$this->user = $this->getUserModel($credentials);

            $profile = $this->validateUserCredentials($credentials, $this->user);
           // echo 'Validando credenciales';
            return $profile ;
        }
        else {
            return null ;
        }
    }
	private function getUserModel(Core_App_Security_Credentials $credentials) {

        $user = new User_Model_User(User_User::getDbConnection()) ;
        $user->findByLoginField($credentials->getLogin());

        return  $user ;
    }
    public function getSystemUser($model){
        $secureUser = new $model(Login_Login::getDbConnection());
		$class = get_parent_class($secureUser);
		$this->getUserProfile();
		
		if(is_object($this->user))
		{

			if($class == 'Core_App_Model_Model')
				$secureUser->findWhere("secure_user_id=".$this->user->prop('id'));
			else if($class == 'Core_App_Model_Model2')
				$secureUser->select()->where("secure_user_id=".$this->user->get('id'))->runSelect();

		}else
		{
			if($class == 'Core_App_Model_Model')
			$secureUser->markDirty();
			else if($class == 'Core_App_Model_Model2')
			$secureUser->setDirty();
		}


        return $secureUser ;
    }


}

