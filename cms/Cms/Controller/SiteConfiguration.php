<?php

/**
* Controlador para realizar configuraciones sobre un sitio web
*/
class Cms_Controller_SiteConfiguration extends Core_App_Controller_Controller
{
	function index( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->get('id'));
		$structures = $site->getPageStructures();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		$res->addVar('structures', $structures);
		return $res;
	}
	public function siteStructure($req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->get('id'));
		$structures = $site->getPageStructures();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		$res->addVar('structures', $structures);
		return $res;
	}
	public function updateSiteConfig( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->loadId( $req->post('site_id'));
		
		$data= array();
		$data['path'] = $req->post('media_path');
		$data['domain'] = $req->post('domain');
		$data['description'] = $req->post('description');
		
		$site->updateFields($data);
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		return $res;
	}
}


?>