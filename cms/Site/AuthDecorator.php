<?php 
/**
* Se encarga de autenticar al usuario
*/
class Site_AuthDecorator extends FrontCms_Core_RouteDecorator
{
	private $_url = '';
	public function setSite( $site)
	{
		//error_log('__ set site');
		$this->_site = $site;
	}

	function validateRoute( $currentRoute)
	{
		$this->_url = $currentRoute;
		preg_match('/\/auth\//', $currentRoute, $matches);
		
		if(count($matches) > 0)
		{
			return true;
		}
		//error_log('NOT SHOP');
		return false;
	}
	function getTemplate( $req)
	{
		// Hacer un proceso para validar las credenciales del usuario y loguearlo o mandarlo a loguear de nuevo
        Core_Base_Session::instance()->set('user', $_POST['user']);
        Core_Base_Session::instance()->set('password', $_POST['password']);

		$page_id = $_POST['page_id'];
        $page = new Cms_Model_Page(Cms_Cms::getDbConnection());
        $page->find( $page_id);

        $page_link = new FrontCms_Core_Page($page);
        $page_url = $page_link->getUrl();

        $profile = Core_App_Controller_SecurityController::instance()->getUserProfile();

        if($profile) {

            header("Location:". FrontCms_Site::instance()->getConfig('site_domain').$page_url); // fernando
            exit;
        }
        else {

            header("Location:".FrontCms_Site::instance()->getConfig('site_domain').'/login?error=1');
            exit;
        }

	}

}