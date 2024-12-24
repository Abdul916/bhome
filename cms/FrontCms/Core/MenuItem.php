<?php
/**
* Wrapper sobre Cms_Model_MenuItem
*/
class FrontCms_Core_MenuItem
{
	private $menu;	// contiene
	private $menuitem;
	
	function __construct(Cms_Model_MenuItem $menuItem, Cms_Model_Menu $menu)
	{
		$this->menuitem = $menuItem;
		$this->menu = $menu;
	}
	public function getTitle()
	{
		return $this->menu->get('title');
	}
	function getUrl()
	{
		if(!$this->menu)
		{
			trigger_error("Can't access menu object, object not declared.");
			return false;
		}
		
		/*
		if($this->menu->get('content_type') == $this->menu::NO_PARENT)
		{
			// es una sección
			return $_SERVER['PHP_SELF'].'?seccid=' . $this->menu->get('content_id');
		}
		if($this->menu->get('content_type') == $this->menu::PARENT_SECTION)
		{
			// es una página
			$parent = $this->getParent();
			return $_SERVER['PHP_SELF'].'?seccid=' . $parent->$this->menu->get('content_id');
		}*/
	}
}

?>