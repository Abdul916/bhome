<?php
/*
 * Descripcion corta
 *
 * Descripci�n larga
 * Created on Feb 23, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

abstract class LoginApp_Controller_Index extends Core_App_Controller_Controller {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
    public function setup() {
        //
    }
    public function index($req) {
		$_SESSION = array();
        $res = new Core_Base_Response($this);
        $res->addVar('status', 'NULL');
		
		if(Configuration::instance()->get('login_view'))
		{
			$res->setView( Configuration::instance()->get('login_view'));
		}
        return $res;
    }

    abstract public function getUserModel();

    public function login($req) {
        // el usuario ha intentado loguearce
        Core_Base_Session::instance()->set('user',$req->post('user'));
        Core_Base_Session::instance()->set('password',$req->post('password'));
        $profile = Core_App_Controller_SecurityController::instance()->getUserProfile() ;
		//error_log( print_r($profile));
        if($profile && $profile->getObjectAt(0)) {
            //error_log("**** Location:".'index.php?'.$profile->getObjectAt(0)->get('default_path'));
            header("Location:".'index.php?'.$profile->getObjectAt(0)->get('default_path'));
            exit ;
        }
        else {
            header("Location:".'index.php?a=login&error=1');
            exit ;
        }
    }
    public function logout($req) {
        // cerrar session
		$_SESSION = array();
        Core_Base_Session::instance()->sessionClose();

        header("Location:index.php");
		exit;
    }
}