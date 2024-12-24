<?php

/**
* Modelo de elementos de menu
*/
class Cms_Model_MenuItem extends Core_App_Model_Model2
{
	const SECTION = 1;
	const PAGE = 2;
	const URL = 3;
	
	const NO_PARENT = 0;
	const PARENT_SECTION = 1;
	const PARENT_PAGE = 2;
	
	const NOT_PUBLISHED = 0;
	const PUBLISHED = 1;
	
	// variables para control de idioma
	private $_itemLanguage = null;
	private $_langSource = null;
	
	function setup()
	{
		$this->setTable('menu_items');
		$this->setFields(array('id', 'site_menu_id', 'title', 'content_id', 'created_at', 'updated_at', 
		'content_type', 'url', 'parent_id', 'orden', 'parent_type', 'publish_status', 'index_status', 'code_name'));
		
		$this->setUpdateFields(array('title'));
		
		$this->setBelongsTo('Cms_Model_Menu', 'site_menu_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	
	public function getMaxOrderForMenu($menu_id)
	{
		$sl = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		$this->setFields(array('maxorden'));
		
 		$sl->select('max(orden) as maxorden')->where('site_menu_id = "'.$this->secureText($menu_id).'"')->runSelect();
		$r = $sl->get('maxorden');
		
		if(!$sl->get('maxorden'))
			$r = 0;
		//error_log(print_r($this, true), 0);
		
		return $r;
	}
	public function getMenuItemForSection(Core_App_Model_Model2 $section)
	{
		if($section->getId() > 0)
		{
			// buscar el menu de la sección
			$this->select()->where('content_type = 1 AND content_id = ' . $section->getId())->runSelect();
		}
	}
	/**
	* return mix( String, Cms_Model_Page)
	*/
	function getLinkedElement()
	{
		// si el menu apunta a una página crear el modelo
		if($this->get('content_type') == Cms_Model_MenuItem::PAGE)
		{
			$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
			$page->find( $this->get('content_id'));
			
			return $page;
		}
		
		// si el menu apunta a una sección, obtener el index de la sección
		if($this->get('content_type') == Cms_Model_MenuItem::SECTION)
		{
			
		}
	}
	public function getParentMenuItem()
	{
		$parent = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		$parent->select()->where('content_type='. $this->get('parent_type').' AND content_id='.$this->get('parent_id'));
		$parent->runSelect();
		
		return $parent;
	}
	public function publishStatusToNoun($publish_status)
	{
		$var = array();
		$var[0] = 'No publicado';
		$var[1] = 'Publicado';
		
		return $var[$publish_status];
	}
	public function setLanguage( $lang)
	{
		$this->_itemLanguage = $lang;
		$this->setLangSource();
	}
	public function getLanguage()
	{
		return $this->_itemLanguage;
	}
	function setLangSource()
	{
		if(!is_object($this->_langSource))
		{
			$page2 = new Cms_Model_Page( Cms_Cms::getDbConnection());
			$page2->select()->where('lang_code = "'.strtoupper($this->_itemLanguage).'" AND lang_main_page_id ='. $this->get('content_id'))->runSelect();
			$this->_langSource = $page2;
			//error_log( print_r($this->_langSource, true), 0);
		}
		return $this->_langSource;
	}
	public function getProp( $prop)
	{
		if(!$this->getLanguage())
		{
			return $this->get($prop);
		}else{
			switch($prop)
			{
				case 'title':
					return $this->_langSource->get('name');
					break;
				case 'site_menu_id':
					return $this->get('site_menu_id');
					break;
				case 'content_id':
					return $this->_langSource->get('id');
					break;
				default:
					return $this->get($prop);
					break;
			}
		}
	}
}