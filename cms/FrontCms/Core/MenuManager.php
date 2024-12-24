<?php
/**
* 
*/
class FrontCms_Core_MenuManager
{
	private $dbConnection;
	
	function __construct($dbConnection)
	{
		$this->dbConnection = $dbConnection;
	}
	public function getMainSiteMenu()
	{
		// Obtener el menú principal del sitio
		/*
		Es un identado de todas las secciones publicas (que se incluan en menú)
		Es un array, 
		*/
		$menu = new Cms_Model_Menu( $this->dbConnection);
		$menu->getIndexMenu();	// menu ahora contiene el menu index
		
		$items = $menu->getPublicMenuStructure();
		//print_r($items);
		$parents = $menu->getParents();
		//print_r($parents);
		$frontMenu = new FrontCms_Core_Menu($menu);
		
		foreach($parents as $parent)
		{
			$frontMenu->addMenuItem( $parent);
		}
		
		return $frontMenu;
	}
	public function getSections($arrgs = null)
	{
		if(!is_array($arrgs))
		{
			$arrgs = array();
		}
		$exclude_index = isset($arrgs['exclude_index']) ? $arrgs['exclude_index'] : false;
		
		$menu = new Cms_Model_Menu( $this->dbConnection);
		$menu->getIndexMenu();	// menu ahora contiene el menu index
		$attributes = array();
		if(FrontCms_Site::instance()->getLanguage())
		{
			$attributes['language_code'] = strtoupper(FrontCms_Site::instance()->getLanguage());
		}else{
			$attributes['language_code'] = '';
		}
		
		//$attributes->
		$items = $menu->getPublicSections( $attributes);
		//print_r($items);
		$frontMenu = new FrontCms_Core_Menu($menu, $arrgs);
		
		foreach($items as $item)
		{
			if($exclude_index)
			{
				// no incluir el index
				if($item->get('index_status') != 1)
				{
					$frontMenu->addMenuItem( $item);
				}
			}else{
				$frontMenu->addMenuItem( $item);
			}
		}
		
		return $frontMenu;
	}
	public function getSiteSections($include_index = false)
	{
		//$section = ;//obtener la seccion index
		$menu = new Cms_Model_Menu( $this->dbConnection);
		$itemmenu = new Cms_Model_MenuItem( $this->dbConnection);
		$itemmenu->select()->where("content_id = ".$section->get('id').' AND (content_type ="1" AND publish_status = 1)');
		$itemmenu->runSelect();
		
		$menuitems = $menu->getChildsForMenuItem( $itemmenu);
		
		$frontMenu = new FrontCms_Core_Menu($menu);
		foreach($menuitems as $menuitem )
		{
			//$frontMenu->addMenuItem( new FrontCms_Core_MenuItem( $menuitem, $menu));
			$frontMenu->addMenuItem( $menuitem);
		}
		return $frontMenu;
	}
	public function getSectionMenu( $section, $arrgs = null)
	{
		if(FrontCms_Site::instance()->getLanguage())
		{
			$lang = FrontCms_Site::instance()->getLanguage();
			$orgsection = $section;
			$section = $orgsection->getForLanguage( $lang);
			
		}
		
		$menu = new Cms_Model_Menu( $this->dbConnection);
		$itemmenu = new Cms_Model_MenuItem( $this->dbConnection);
		$itemmenu->select()->where("content_id = ".$section->get('id').' AND (content_type ="1" AND publish_status = 1)')->orderBy('orden ASC');
		$itemmenu->runSelect();
		//print_r($itemmenu);
		$menuitems = $menu->getChildsForMenuItem( $itemmenu);
		
		$frontMenu = new FrontCms_Core_Menu($menu, $arrgs);
		foreach($menuitems as $menuitem )
		{
			//$frontMenu->addMenuItem( new FrontCms_Core_MenuItem( $menuitem, $menu));
			$frontMenu->addMenuItem( $menuitem);
		}
		return $frontMenu;
	}
	public function getMenu($menu_identifier)
	{
		# code...
	}
	public function printMenu()
	{
		
	}
}

?>