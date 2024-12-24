<?php
/**
* Implementa la interfase de acceso a un menu
*/
class FrontCms_Core_Menu
{
	private $childs;
	private $menuItems;
	private $menu = null;	// el objeto del modelo menu al que pertenecen este menuItem
	private $parent;	//el padre inmediato del menu
	private $arrguments = null;
	
	function __construct( Cms_Model_Menu $menu, $arrgs = null)
	{
		$this->childs = array();
		$this->menuItems = array();
		$this->menu = $menu;
		if(is_array($arrgs))
		{
			$this->arrguments = $arrgs;
		}
	}
	
	public function getArrgument( $key)
	{
		if($this->arrguments)
		{
			return isset($this->arrguments[$key]) ? $this->arrguments[$key] : '';
		}
	}
	
	function addMenuItem( Cms_Model_MenuItem $item)
	{
		// setear a este menu como padre de el item hijo
		$this->menuItems[] = $item;
	}
	public function loadFromMenuItem( Cms_Model_MenuItem $item)
	{
		if($item->isCollection())
		{
			foreach( $item as $itm)
			{
				$this->addMenuItem( $itm);
			}
		}
		return $this;
	}
	public function printAsHtmlList()
	{
		foreach($this->menuItems as $item)
		{
			$exclude_ids = $this->getArrgument( 'exclude');
			//print_r($exclude_ids);
			if(is_array($exclude_ids))
			{
				// se debe depurar la lista
				if(!in_array($item->get('content_id'), $exclude_ids))
				{
					$this->printElement($item);
				}
			}else
			{
				$this->printElement($item);
			}
			
			
		}
	}
	public function printElement($item)
	{
		$class = null;
		$lang = null;
		if(isset($_GET['lang']))
		{
			//$lang = '&lang='.$_GET['lang'];
			//$lang = $_GET['lang'];
		}
		if($item->get('content_type') == 2)
		{
			// si es una página
			$url ='index.php?seccid='.$item->get('parent_id').'&pageid='.$item->get('content_id').$lang;
			//print_r(FrontCms_Site::instance()->getCurrentSection());
			if(FrontCms_Site::instance()->getCurrentPage()->get('id') == $item->get('content_id'))
			{
				$class = $this->getArrgument( 'current_class');
			}
		}else
		{
			// es una sección
			$url ='index.php?seccid='.$item->get('content_id').$lang;
			if(FrontCms_Site::instance()->getCurrentSection()->get('id') == $item->get('content_id'))
			{
				$class = $this->getArrgument( 'current_class');
			}
		}


		if(FrontCms_Site::instance()->getConfig('friendly_url'))
		{
			$url = FrontCms_Site::instance()->getConfig('friendly_url_base');
			/*if($lang)
				$url.= $lang.'/';
				*/
			//link a seccion
			$parent_item = $item->getParentMenuItem();
			if($parent_item->get('index_status') != 1)
			$url.= $parent_item->get('code_name').'/';

			$url.= $item->get('code_name').'/';
		}
		if($class)
			$class = ' class="'.$class.'"';
		echo '<li><a href="'.$url.'"'.$class.'>'.$item->get('title').'</a>';
		if( $this->menu->getChildsForMenuItem($item)->isCollection())
		{
			$secmenu = $this->menu->getChildsForMenuItem($item);
			$aux = new self( $this->menu);
			$aux->loadFromMenuItem( $secmenu);
			$this->addChildMenu( $aux);
			echo "\n";
			echo '<ul>';
			$aux->printAsHtmlList();
			echo '</ul>';
		}
		echo "</li> \n";
	}
	public function addChildMenu(FrontCms_Core_Menu $menu)
	{
		$menu->setParent( $this);
		$this->childs[] = $menu;
		return $menu;
		
	}
	public function get($value='')
	{
		# code...
	}
	public function setParent( FrontCms_Core_Menu $menu)
	{
		$this->parent = $menu;
	}
	public function getParent()
	{
		return $this->parent;
	}
}

?>