<?php
/**
* Controlador para Menu Items
*/
class Cms_Controller_MenuItem extends Core_App_Controller_Controller
{
	function index()
	{
		return new Core_Base_Response( $this);
	}
	public function edit( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->get('site_id'));
		
		$menu = new Cms_Model_Menu( Cms_Cms::getDbConnection());
		$menu->find( $req->get('menu_id'));
		
		$menuitem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		$menuitem->find( $req->get('id'));
		
		$linkedElement = $menuitem->getLinkedElement();
		
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		$res->addVar('menu', $menu);
		$res->addVar('menuitem', $menuitem);
		$res->addVar('linkedElement', $linkedElement);
		return $res;
	}
	public function update($req)
	{
		$menuitem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		$menuitem->find( $req->post('menuitem_id'));
		
		$fields = array();
		$fields['title'] = $req->post('title');
		$fields['publish_status'] = $req->post('publish_status');
		$menuitem->updateFields( $fields);
		
		$res = new Core_Base_Response( $this);
		$res->addVar('menuitem', $menuitem);
		return $res;
	}
}

?>