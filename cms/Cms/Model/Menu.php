<?php

/**
* Modelo de menus
*/
class Cms_Model_Menu extends Core_App_Model_Model2
{
	const TYPE_DINAMIC = 1;
	const TYPE_MANUAL = 2;
	
	private $typesNouns;
	protected $allMenuChils = null;
	protected $allPublicMenuChils = null;
	protected $parentMenuItems;
	protected $menuarray;
	
	function setup()
	{
		$this->setTable('site_menus');
		$this->setFields(array('id', 'site_id', 'name', 'description', 'owner_type', 'owner_id', 'created_at', 'updated_at', 'type', 'code_name', 'index_status'));
		$this->setUpdateFields(array('name', 'description'));
		
		$this->setHasMany('Cms_Model_MenuItem', 'site_menu_id');
		$this->typesNouns= array();
		$this->typesNouns[1] = 'Menú dinamico';
		$this->typesNouns[2] = 'Menú estatico';
		
		
		$this->menuarray= array();
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function getIndexMenu()
	{
		$this->select()->where("index_status = 1")->runSelect();
	}
	/*
	Obtiene todas las secciones publicas del menu
	*/
	public function getPublicSections( $attributes = null)
	{
		$where = '';
		if( is_array($attributes))
		{
			// se enviaron attributos
			
			// language_code
			if(isset( $attributes['language_code']))
			{
				if($attributes['language_code'] != '')
				$where = ' AND lang_code ="'.$attributes['language_code'].'"';
				else
				$where = ' AND lang_code IS NULL';
			}
		}
		$childs = $this->getChilds('Cms_Model_MenuItem')->where(' AND publish_status =1 AND content_type =1'.$where)->orderBy('orden');
		//error_log(print_r($childs, true) , 0);
		$childs->runSelect();
		$menuItems = $childs;
		$this->builtMenuTree( $menuItems);
		return $menuItems;
	}
	public function getMenuStructure()
	{
		/**
		* 1. Obtener todos los menus relacionados
		* 2. Identar los menus
		* 3. Regresar un modelo de menu organizado jerarquicamente
		* 4. Return $tree un arbol con los objetos
		*/
		
		$menuItems = $this->getMenuItems();
		$this->builtMenuTree( $menuItems);
		
		//$collectionItem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
	}
	public function getPublicMenuStructure()
	{
		$menuItems = $this->getPublicMenuItems();
		$this->builtMenuTree( $menuItems);
		return $menuItems;
	}
	private function builtMenuTree( Cms_Model_MenuItem $menuItems)
	{
		/* Listar todos los menus
		   Identarlos según sus padres
		 */
		
		// crear la primer alista de menus principales
		$menus = $menuItems;
		$this->parentMenuItems = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		$this->parentMenuItems->setDirty();
		
		$this->menuarray = array();
		
		foreach($menus as $menu)
		{
			$this->menuarray[$menu->get('id')] = $menu;
			
			if($menu->get('parent_id') == 0)
			{
				$this->parentMenuItems->addCollection($menu);
			}
		}
	}
	public function getParents()
	{
		if(!is_object($this->parentMenuItems) || $this->parentMenuItems->count() == 0)
		{
			$menuItems = $this->getMenuItems();
			$this->builtMenuTree( $menuItems);
		}
		return $this->parentMenuItems;
	}
	public function getPublicParents()
	{
		return $this->parentMenuItems;
	}
	public function getChildsForMenuItem( Cms_Model_MenuItem $menu_item)
	{
		/*
		Saber si el menu item corresponde a una categoría
		si es una categoria buscar sus hijos inmediatos con un tipo SECTION
		Si es una página buscar sus hijos segun el tipo PAGE
		*/
		if(isset($this->childsByParentList[$menu_item->get('id')]))
		{
			return $this->childsByParentList[$menu_item->get('id')];
		}else
		{
			$this->childsByParentList[$menu_item->get('id')] = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		}
		
		if($menu_item->get('parent_type') == Cms_Model_MenuItem::NO_PARENT)
		{
			// su padre es una sección
			if(!is_array($this->menuarray) || count($this->menuarray) == 0)
			{
				// counstruir el arbol del menu item
				$childs = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
				$childs->select()->where('parent_id ="'.$menu_item->get('content_id').'" AND (parent_type = 1 AND publish_status = 1)')->orderBy('orden DESC')->runSelect();
				
				foreach($childs as $menu)
				{
					$this->menuarray[$menu->get('id')] = $menu;
				}
			}
			foreach( $this->menuarray as $menu)
			{
				if($menu->get('parent_id') == $menu_item->get('content_id') && $menu->get('parent_type') == Cms_Model_MenuItem::PARENT_SECTION)
				{
					//echo " addedParent: ".$menu->get('id');
					$this->childsByParentList[$menu_item->get('id')]->addCollection($menu);
				}
				
			}
		}
		else if($menu_item->get('parent_type') == Cms_Model_MenuItem::PARENT_SECTION)
		{
			// estoy buscando los hijos de una página
			//echo " PP ";
			foreach( $this->menuarray as $menu)
			{
				if($menu->get('content_type') == Cms_Model_MenuItem::PAGE && $menu->get('parent_id') == $menu_item->get('content_id')  && $menu->get('parent_type') == Cms_Model_MenuItem::PARENT_PAGE)
				{
					$this->childsByParentList[$menu_item->get('id')]->addCollection($menu);
				}
			}
		}
		
		return $this->childsByParentList[$menu_item->get('id')];
	}
	public function getMenuItems()
	{
		// recupera todos los menu items del menu
		
		if(!is_object($this->allMenuChils))
		{
			$this->allMenuChils = $this->getChilds('Cms_Model_MenuItem')->orderBy('orden DESC');
			$this->allMenuChils->runSelect();
			
		}
		
		return $this->allMenuChils;
	}
	public function getPublicMenuItems()
	{
		// recupera todos los menu items del menu que esten habilitados
		
		if(!is_object($this->allPublicMenuChils))
		{
			$this->allPublicMenuChils = $this->getChilds('Cms_Model_MenuItem')->where(' AND publish_status =1')->orderBy('orden DESC');
			$this->allPublicMenuChils->runSelect();
		}
		
		return $this->allPublicMenuChils;
	}
	private function getSite( $site_id)
	{
		if(!is_object($this->_mySite))
		{
			$this->_mySite = new Cms_Model_Site( Cms_Cms::getDbConnection());
			$this->_mySite->find($site_id);
		}
		
		return $this->_mySite;
	}
	
	public function buildEmptyMenu( Cms_Model_Site $site)
	{
		/* Crear menu principal e hijos
		*/
		//$site = getSite( $req->post('site_id'));
		
		// 1. Crear el menú principal
		$mainMenu = new Cms_Model_Menu( Cms_Cms::getDbConnection());
		$mainMenu->set('site_id' , $site->get('id'));
		$mainMenu->set('name' , 'Main');
		$mainMenu->set('description' , 'Menú principal del sitio');
		$mainMenu->set('owner_type' , 'Cms_Model_Site');
		$mainMenu->set('owner_id' , $site->get('id'));
		$mainMenu->set('created_at' , Core_Base_Date::getDateTime());
		$mainMenu->set('type' , 1);
		$mainMenu->set('code_name' , 'main_menu_site');
		$mainMenu->set('index_status' , 1);
		
		$mainMenu->insert();
		
		// obtener secciones
		
		$sections = $site->getSections();
		$arrayForMenuSites= array();
		if($sections->count() > 0)
		{
			foreach( $sections as $section)
			{
				$d = array();
				$d['title'] = $section->get('name');
				$d['content_id'] = $section->get('id');
				$d['content_type'] = Cms_Model_MenuItem::SECTION;
				$d['url'] = '';
				$d['parent_id'] = 0;
				$d['parent_type'] = Cms_Model_MenuItem::NO_PARENT;
				$arrayForMenuSites[$section->get('id')] = $mainMenu->createMenuItem( $d);
			}
		}
		
		
		// ahora obtener todas las páginas del sitio y crear los menus correspondientes 
		if($sections->count() > 0)
		{
			foreach( $sections as $section)
			{
				$pages = $section->getPages();
				
				foreach($pages as $page)
				{
					$d = array();
					$d['title'] = $page->get('name');
					$d['content_id'] = $page->get('id');
					$d['content_type'] = Cms_Model_MenuItem::PAGE;
					$d['url'] = '';
					$d['index_status'] = $page->get('index_status');
					if($page->get('parent_page_id') > 0)
					{
						// la página tiene una página padre
						
						$d['parent_id'] = $page->get('parent_page_id');
						$d['parent_type'] = Cms_Model_MenuItem::PARENT_PAGE;
					}
					else
					{
						// la página pertenece a una sección
						$d['parent_id'] = $section->get('id');
						$d['parent_type'] = Cms_Model_MenuItem::PARENT_SECTION;
					}
					$arrayForMenuSites[$section->get('id')] = $mainMenu->createMenuItem( $d);
				}
			}
		}
		$res = new Core_Base_Response( $this);
		$res->addVar( 'menusarray' , $arrayForMenuSites);
		return $res;
	}
	private function buildMergeMenu()
	{
		
	}
	
	function createMenuItem( $data)
	{
		$menuItem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		
		$menuItem->set('site_menu_id' , $this->get('id'));
		$menuItem->set('title' , 		$data['title']);
		$menuItem->set('content_id' , 	$data['content_id']);
		$menuItem->set('created_at' , 	Core_Base_Date::getDateTime());
		$menuItem->set('content_type' , $data['content_type']);
		$menuItem->set('url' , 			$data['url']);
		$menuItem->set('parent_id',		$data['parent_id']);
		$menuItem->set('orden' , 		$this->getMenuItemMaxOrder());
		$menuItem->set('parent_type' , 	$data['parent_type']);
		
		$menuItem->insert();
		return $menuItem;
	}
	
	public function getMenuItemMaxOrder()
	{
		$sl = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		return $sl->getMaxOrderForMenu( $this->get('id'));
	}
	public function typeToNoun( $type)
	{
		return $this->typesNouns[$type];
	}
}


?>