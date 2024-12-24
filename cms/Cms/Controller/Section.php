<?php

/**
* Controlador de secciones
*/
class Cms_Controller_Section extends Core_App_Controller_Controller
{
	function index( $req)
	{
		// Listado de secciones
	}
	function add( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('id'));
		
		$pageStructures = $site->getPageStructures();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		$res->addVar('pageStructures', $pageStructures);
		
		return $res;
	}
	public function edit( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));
		
		$pageStructures = $site->getPageStructures();
		
		$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$section->find($req->get('id'));
		
		$langs = $site->getLanguages();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		$res->addVar('section', $section);
		$res->addVar('languages', $langs);
		$res->addVar('pageStructures', $pageStructures);
		
		return $res;
	}
	public function jxupdatename( $req)
	{
		$isnew = $req->get('new_section');
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->get('site_id'));
		
		if($isnew)
		{
			
			
			$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$section->find($req->get('parent_section_id'));
			
			$language = new Cms_Model_Language( Cms_Cms::getDbConnection());
			$language->find($req->get('lang_id'));
			
			// crear la seccion del idioma
			$nsecc = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$nsecc->set('name', $req->post('name'));
			$nsecc->set('publish_status', 1);
			$nsecc->set('status', 1);
			$nsecc->set('publish_date', Core_Base_Date::getDateTime());
			$nsecc->set('site_id', $site->get('id'));
			$nsecc->set('page_structure_id', $section->get('page_structure_id'));
			$nsecc->set('index_status', $section->get('index_status'));
			$nsecc->set('code_name', Core_Base_String::plainString($req->post('name')));
			$nsecc->set('lang_code', $language->get('code'));
			$nsecc->set('lang_main_section_id', $section->get('id'));
			$nsecc->set('site_language_id', $language->get('id'));
			$nsecc->set('orden', $section->get('orden'));
			$nsecc->insert();
			
			$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$section->find($nsecc->getId());
			//$section = $nsecc;
		}else
		{
			$language = new Cms_Model_Language( Cms_Cms::getDbConnection());
			$language->find($req->get('lang_id'));
			
			$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$section->find($req->get('section_id'));
			$arr = array();
			$arr['name'] = $req->post('name');
			$arr['code_name'] = Core_Base_String::plainString($req->post('name'));
			$arr['lang_code'] = $language->get('code');
			$arr['site_language_id'] = $language->get('id');
			$arr['publish_status'] = 1;
			
			$section->updateFields( $arr);
			
			$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$section->find($req->get('section_id'));
			
		}
		$menuItem = $section->getMenuItem();
		//error_log(print_r($menuItem, true), 0);
		
		if($menuItem->count() > 0)
		{
			$ar = array();
			$ar['title'] =$arr['name'];
			$ar['code_name'] = $arr['code_name'];
			$ar['lang_code'] = $section->get('lang_code');
			$ar['publish_status'] = $section->get('publish_status');
			//error_log(print_r($ar, true), 0);
			$menuItem->updateFields($ar);
		}else{
			// la seccion no tiene menu item
			$menu = $site->getIndexMenu();
			$language = new Cms_Model_Language( Cms_Cms::getDbConnection());
			$language->find($req->get('lang_id'));
			
			if(is_object($menu) && $menu->count() > 0)
			{
				$menuItem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());

				$menuItem->set('site_menu_id', $menu->get('id'));
				$menuItem->set('title' , $section->get('name'));
				$menuItem->set('content_id' , $section->getId());
				$menuItem->set('created_at' , Core_Base_Date::getDateTime());
				$menuItem->set('content_type' , Cms_Model_MenuItem::SECTION);
				// TODO: el orden se debe calcular en base al total de elementos menu en el menu actual
				$max = $menu->getMenuItemMaxOrder();
				$menuItem->set('orden' , $max);

				$menuItem->set('publish_status' , $section->get('publish_status'));
				$menuItem->set('index_status' , $section->get('index_status'));
				$menuItem->set('parent_id' , 0);
				$menuItem->set('parent_type' , Cms_Model_MenuItem::NO_PARENT);
				$menuItem->set('code_name' , $section->get('code_name'));
				$menuItem->set('lang_code' , $language->get('code'));
				$menuItem->insert();
			}
			
		}
		
		$res = new Core_Base_Response( $this);
		$res->addVar('section',  $section);
		return $res;
	}
	public function save( $req)
	{
		$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$section->loadArray( $req->getPost());
		$section->set('page_structure_id', $req->post('page_structure_id'));
		$section->set('status', 1);
		$section->set('code_name', Core_Base_String::plainString($req->post('name')));
		$section->set('publish_status', Core_Base_Form::getCheckbox('publish_status', $req));
		$section->insert();
		
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->post('site_id'));
		
		$menu = $site->getIndexMenu();

		if(is_object($menu) && $menu->count() > 0)
		{
			$menuItem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
			
			$menuItem->set('site_menu_id', $menu->get('id'));
			$menuItem->set('title' , $section->get('name'));
			$menuItem->set('content_id' , $section->getId());
			$menuItem->set('created_at' , Core_Base_Date::getDateTime());
			$menuItem->set('content_type' , Cms_Model_MenuItem::SECTION);
			// TODO: el orden se debe calcular en base al total de elementos menu en el menu actual
			$max = $menu->getMenuItemMaxOrder();
			$menuItem->set('orden' , $max);
			
			$menuItem->set('publish_status' , $section->get('publish_status'));
			$menuItem->set('index_status' , $section->get('index_status'));
			$menuItem->set('parent_id' , 0);
			$menuItem->set('parent_type' , Cms_Model_MenuItem::NO_PARENT);
			$menuItem->set('code_name' , $section->get('name_code'));
			$menuItem->insert();

		}else{
			//echo "no se encuentra el menu principal";
			// Crear menu principal
		}
		
		$res = new Core_Base_Response( $this);
		$res->addVar('section', $section);
		
		return $res;
	}
	public function update( $req)
	{
		$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$section->loadId( $req->post('section_id'));
		$d['name'] = $req->post('name');
		$d['code_name'] = Core_Base_String::plainString($req->post('name'));
		$d['publish_status'] = Core_Base_Form::getCheckbox('publish_status', $req);
		$d['page_structure_id'] = $req->post('page_structure_id');
		$p_date = '';
		
		if($d['publish_status'] == 1)
		{
			$p_date = Core_Base_Date::getDate();
		}
		$d['publish_date'] = $p_date;
		
		$section->updateFields($d);
		
		$mitem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
		$mitem->getMenuItemForSection($section);
		
		$secc = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$secc->find( $section->getId());
		
		$d = array();
		$d['title'] = $secc->get('name');
		$d['code_name'] = $secc->get('code_name');
		$d['orden'] = $secc->get('orden');
		// $mitem->updateFields($d);
		
		$res = new Core_Base_Response( $this);
		$res->addVar('section', $section);
		
		return $res;
	}
	public function order( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('id'));
		
		$sections = $site->getNonLanguageSections();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('sections', $sections);
		$res->addVar('site', $site);
		
		return $res;
	}
	public function poporderpages( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));
		
		$currentparent = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$currentparent->find($req->get('section_id'));
		
		$res = new Core_Base_Response( $this);
		$res->addVar('currentparent', $currentparent);
		$res->addVar('site', $site);
		
		return $res;
	}
	public function orderPagesFrame( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));
		
		$currentparent = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$currentparent->find($req->get('section_id'));
		
		$pages = $currentparent->getParentPages();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('currentparent', $currentparent);
		$res->addVar('pages', $pages);
		$res->addVar('site', $site);
		
		return $res;
	}
	public function saveorder( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));
		
		$secList = array_reverse($req->post('sections_list'));
		$secList = $req->post('sections_list');
    $total = count($secList);
    print_r( $secList);
		for($i = 1; $i < $total; $i++)
		{
      if( ! intval( $secList[$i]) > 0) continue;
			$sec = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$sec->loadId($secList[$i]);
			$sec->updateFields(array('orden' => $i));
			
			// Incluir orden a version en idiomas
			$langsections = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$langsections->select()->where('lang_main_section_id = '.$langsections->secureText($sec->getId()));
			$langsections->runSelect();
			
			if($langsections->count() > 0)
			{
				foreach($langsections as $lngsec)
				{
					$lngsec->updateFields(array('orden' => $i));
				}
			}
			
			//ordenar menu item
			$mitem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
			$mitem->getMenuItemForSection($sec);
			if($mitem->count() == 1)
			$mitem->updateFields(array('orden' => $i));
    }
    
    // seccion index
    $index = new Cms_Model_Section(Cms_Cms::getDbConnection());
    $index->select()->where( 'index_status = 1')->runSelect();
    $index->updateFields(array('orden' => 0));
		
		$res = new Core_Base_Response( $this);
		
		return $res;
	}
}


?>
