<?php

/**
* Controlador de menus
*/
class Cms_Controller_Menu extends Core_App_Controller_Controller
{
	private $_mySite;
	
	function index( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->get('id'));
		
		$menus = $site->getMenus();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		$res->addVar('menus', $menus);
		return $res;
	}
	public function detail( $req)
	{
		$menu = new Cms_Model_Menu( Cms_Cms::getDbConnection());
		$menu->find($req->get('id'));
		
		$tree = $menu->getMenuStructure();
		
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->get('site_id'));
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		$res->addVar('menu', $menu);
		$res->addVar('parents', $menu->getParents());
		
		return $res;
	}
	function updateMenus( $req)
	{
		/*  
		1. Obtener la estructura del sitio y generar la estructura de base de datos correspondiente
		
		2. Buscar menus actuales en el sistema
		
		3. Ligar los menús con sus correspondientes 
		
		A tener en cuenta:
		Exista ya un menú principal ?
		Cuales son las páginas hijas de cada sección y las páginas hijas de las páginas
		*/
		$menus = new Cms_Model_Menu( Cms_Cms::getDbConnection());
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->post('site_id'));
		
		$menus = $site->getMenus();
		
		if($menus->count() > 0)
		{
			// no existen menus, crearlos de scratch
			error_log("Si existen, solo hacer una actualizacion" , 0);
		}else{
			
			$menus->buildEmptyMenu( $site);
			error_log("Contruir menus" , 0);
		}
		$res = new Core_Base_Response( $this);
		$res->addVar('menus', $menus);
		return $res;
		
	}
	
	
	
	
}


?>