<?php

/**
* Modelo de acceso a tabla SITES
*/
class Cms_Model_Site extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable( 'sites');
		$this->setFields( array('id', 'name', 'url', 'domain', 'path', 'description', 'created_at', 'updated_at', 'theme_path', 'media_path'));
		$this->setUpdateFields( array('name', 'url', 'domain', 'path', 'description'));
		
		$this->setHasMany( 'Cms_Model_Section', 'site_id');
		$this->setHasMany( 'Cms_Model_PageStructure', 'site_id');
		$this->setHasMany( 'Cms_Model_Menu', 'site_id');
		$this->setHasMany( 'Cms_Model_Language', 'site_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function getSections()
	{
		$sections = $this->getChilds('Cms_Model_Section');
		$sections->runSelect();
		return $sections;
	}
	public function getLanguages()
	{
		$childs = $this->getChilds('Cms_Model_Language');
		$childs->runSelect();
		
		return $childs;
	}
	public function getNonLanguageSections()
	{
		$sections = $this->getChilds('Cms_Model_Section')->where(' AND (lang_main_section_id IS NULL OR lang_main_section_id = 0)')->orderBy('orden');
		$sections->runSelect();
		return $sections;
	}
	public function getPageStructures()
	{
		$pstructures = $this->getChilds('Cms_Model_PageStructure');
		$pstructures->runSelect();
		return $pstructures;
	}
	public function getMenus()
	{
		$menus = $this->getChilds('Cms_Model_Menu');
		$menus->runSelect();
		return $menus;
	}
	public function getIndexMenu()
	{
		$menu = new Cms_Model_Menu( Cms_Cms::getDbConnection());
		$menu->select()->where('site_id='.$this->get('id').' AND index_status = 1')->runSelect();
		return $menu;
	}
}

