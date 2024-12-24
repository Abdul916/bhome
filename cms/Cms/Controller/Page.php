<?php

/**
* Controlador para pÃ¡ginas
*/
class Cms_Controller_Page extends Core_App_Controller_Controller
{
	public function childs($req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));

		// Mostrar los hijos de una pagina
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		//$page = Cms_Builder::model('Cms_Model_Page');

		$page->find( $req->get('id'));
		$childPages = $page->getPages();

		$section = $page->getSection();

		// nombre de los tipos de template
		$pageStructures = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
		$pageStructures->collection()->runSelect();

		$page_structures_array = array();

		foreach ($pageStructures as $ps) {
			$page_structures_array[$ps->get('id')] = $ps;
		}

		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		$res->addVar('page', $page);
		$res->addVar('pages', $childPages);
		$res->addVar('section', $section);
		$res->addVar('page_structures_array', $page_structures_array);
		return $res;
	}

	function add( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));

		$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$section->find( $req->get('id'));

		$fields_structure = $req->get('fsid');

		if(!$fields_structure)
		{
			$structure = $section->getStructure();
			$fields = $structure->getFields();
		}else{
			$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
			$structure->find( $fields_structure);
			$fields = $structure->getFields();
		}

		$pageStructures = $site->getPageStructures();

		$parentpages = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$parentpages->select()->where(' parent_page_id IS NULL OR parent_page_id = 0 AND site_id = "'.$site->getId().'"')->runSelect();

		// CONTROL DE IDIOMA
		/*
		A tener en cuanta los siguientes datos

		1. si viene informacion obtener la pagina padre y setear la estrucutra definida para el padre
		2. definir la pagina, cuando se guarde se debe enviar la informaciÃ³n del idioma, las pÃ¡ginas con este idioma no deben mostrarce en el menu principal
		*/

		$lang_main = $req->get('lang_main');
		$lang_code = $req->get('lang_code');
		$language = null;
		$langParentPage = null;
		$parent_page_id = 0;
		$parent_page = null;

		if($lang_main && $lang_code)
		{
			// esta pagina es una version de otro idioma

			$language = new Cms_Model_Language( Cms_Cms::getDbConnection());
			$language->find($lang_code);

			$langParentPage = new Cms_Model_Page( Cms_Cms::getDbConnection());
			$langParentPage->find($lang_main);

			$fields_structure = $langParentPage->get('page_structure_id');
			$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
			$structure->find( $fields_structure);
			$fields = $structure->getFields();

			// optener la versi�n en ingles de la p�gina original
			if($langParentPage->get('parent_page_id'))
			{
				//$org_parent_page es el padre de la p�gina en su versi�n original
				$org_parent_page = new Cms_Model_Page( Cms_Cms::getDbConnection());
				$org_parent_page->find($langParentPage->get('parent_page_id'));

				// optener el id de la p�gina en el nuevo idioma

				$lang_parent_page = $org_parent_page->getLanguageVersion( $language);

				$parent_page = $lang_parent_page;
				$parent_page_id = $lang_parent_page->get('id');
			}


		}else{
			// es una p�gina en idioma principal
			$parent_page = null;
			$parent_page_id = $req->get('parent_page');
		}

		// Parent Page

		if(isset($parent_page_id) && is_numeric($parent_page_id))
		{
			$parent_page = new Cms_Model_Page( Cms_Cms::getDbConnection());
			$parent_page->find( $parent_page_id);
		}

		$res = new Core_Base_Response( $this);
		$res->addVar('section', $section);
		$res->addVar('structure', $structure);
		$res->addVar('fields', $fields);
		$res->addVar('parentpages', $parentpages);
		$res->addVar('site', $site);
		$res->addVar('pageStructures', $pageStructures);
		$res->addVar('language', $language);
		$res->addVar('language_parent', $langParentPage);
		$res->addVar('parent_page', $parent_page);

		return $res;
	}
	private function buildPathToPage($page)
	{

	}
	public function poporderpages( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));

		$currentparent = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$currentparent->find($req->get('page_id'));

		$res = new Core_Base_Response( $this);
		$res->addVar('currentparent', $currentparent);
		$res->addVar('site', $site);

		return $res;
	}
	public function orderPagesFrame($req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));

		$currentparent = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$currentparent->find($req->get('page_id'));

		$pages = $currentparent->getPages();
		// print_r($pages);

		$res = new Core_Base_Response( $this);
		$res->addVar('currentparent', $currentparent);
		$res->addVar('pages', $pages);
		$res->addVar('site', $site);

		return $res;
	}
	public function edit( $req)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->find( $req->get('id'));
		//echo '1<br />';
		$frontPage = new FrontCms_Core_Page($page);

		$section = $page->getSection();

		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $section->get('site_id'));
		//echo '2<br />';
		$languages = new Cms_Model_Language( Cms_Cms::getDbConnection());
		$languages->select()->where('site_id = '.$site->get('id'))->runSelect();

		//echo '3<br />';
		$breadcrum = array();
		$breadcrum = $page->getPath();
		$lang_pages_array = null;
		//echo '4<br />';
		$lang_parent = $req->get('lang_parent');
		$language = null;
		$langParentPage = null;

		$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());

		if($lang_parent)
		{
			// esta pagina es una version de otro idioma
			$language = new Cms_Model_Language( Cms_Cms::getDbConnection());
			$language->find($page->get('site_language_id'));

			$langParentPage = new Cms_Model_Page( Cms_Cms::getDbConnection());
			$langParentPage->find($lang_parent);
		}

		if($page->get('page_structure_id') == null)
		{
			$fields = $section->getStructure()->getFields();
		}
		else
		{

			$structure->find($page->get('page_structure_id'));
			$fields = $structure->getFields();
		}

		$data = $page->getData();

		$parentpages = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$parentpages->select()->where(' parent_page_id IS NULL OR parent_page_id = 0')->runSelect();

		// pagina padre
		$parentPage = $page->getParentPage();

		$res = new Core_Base_Response( $this);
		$res->addVar('page', $page);
		$res->addVar('section', $section);
		$res->addVar('fields', $fields);
		$res->addVar('data', $data);
		$res->addVar('site', $site);
		$res->addVar('parentpages', $parentpages);
		$res->addVar('breadcrum', $breadcrum);
		$res->addVar('languages', $languages);
		$res->addVar('language', $language);
		$res->addVar('langparent', $req->get('lang_parent'));
		$res->addVar('language_parent', $langParentPage);
		$res->addVar('frontPage', $frontPage);
		$res->addVar('parentPage', $parentPage);
		$res->addVar("structure", $structure);

		return $res;
	}
	public function jxsetGallery( $req)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->loadId( $req->get('page_id'));

		$data = new Cms_Model_Data( Cms_Cms::getDbConnection());
		$data->select()->where('id="'.$req->post('data_id').'" AND foreign_model = "Cms_Model_ImageCollection"');
		$data->runSelect();

		$new_assigned_gallery_id = $req->post('selectedgalleryid');
		if($req->post('selectedgalleryid') == 0)
		{
			// se selecciono una nueva glera, crearla y asignarla
			$ngal = new Cms_Model_ImageCollection( Cms_Cms::getDbConnection());
			$ngal->set('created_at', Core_Base_Date::getDateTime());
			$ngal->insert();
			$new_assigned_gallery_id = $ngal->getId();
		}

		$dat = array('foreign_id' => $new_assigned_gallery_id);
		$data->updateFields($dat);

		$res = new Core_Base_Response( $this);
		$res->addVar('galleryCollection_id', $req->post('selectedgalleryid'));
		return $res;
	}
	private function setSectionForLanguage($section, $lang_id)
	{
		if($section->count() == 0)
		{
			error_log('La seccion no existe');
			//error_log(print_r($section, true), 0);
			return null;
		}

		$lang_section = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$lang_section->select()->where('site_language_id = "'.$lang_id.'" AND lang_main_section_id ='. $section->get('id'));
		$lang_section->runSelect();

		//$lang_section = $section->getForLanguage( $lang_code);
		error_log('lang_section: ', 0);
		error_log(print_r($lang_section, true), 0);
		error_log('lang_section count: '. $lang_section->count());

		if($lang_section->count() == 0)
		{

			// la seccion en el idioma no existe, crearla
			$language = new Cms_Model_Language( Cms_Cms::getDbConnection());
			$language->getByLangCode($lang_code);

			$newlangSection = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$newlangSection->set('name', $section->get('name').' '.$lang_code);
			$newlangSection->set('publish_status', 0);
			$newlangSection->set('status', 1);
			$newlangSection->set('site_id', $section->get('site_id'));
			$newlangSection->set('page_structure_id', $section->get('page_structure_id'));
			$newlangSection->set('index_status', $section->get('index_status'));
			$newlangSection->set('code_name', Core_Base_String::plainString($section->get('name').' '.$lang_code));
			$newlangSection->set('lang_code', strtoupper($lang_code));
			$newlangSection->set('lang_main_section_id', $section->get('id'));
			$newlangSection->set('site_language_id', $language->get('id'));
			$newlangSection->insert();
			/*
			error_log('newlangSection',0);
			error_log(print_r($newlangSection, true), 0);
			error_log(' - - - -',0);*/
			return $newlangSection;
		}else{
			error_log('ya existe la seccion en idioma');
		}
		return null;
	}
	public function save( $req)
	{
		/**
		* 1. Crear una pagina en la seccion
		* 2. guardar los datos de la pagina en base de datos
		* 3.
		*/
		$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$section->find($req->post('section_id'));
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->loadArray( $req->getPost());

		$page->set('page_structure_id', $req->post('page_structure_id'));
		$page->set('site_section_id', $req->post('section_id'));
		$page->set('publish_status', Core_Base_Form::getCheckbox('publish_status', $req));
		$page->set('status', 1);
		$page->set('parent_page_id', $req->post('parent_page_id'));
		$page->set('name', $req->post('page_name'));
		$page->set('orden', $section->getNextOrden());
		$page->set('created_at', Core_Base_Date::getDateTime());
		$page->set('name_code', Core_Base_String::plainString($req->post('page_name')));
		$page->set('site_id', $req->post('site_id'));

		// idioma
		/*
		1. La seccion donde se esta creando ya tiene men en ingles ?
		2. La pgina actual debe tener un menu_item
		*/
		$page->set('lang_main_page_id', $req->post('lang_main_page_id'));
		$page->set('lang_code', $req->post('lang_code'));
		$page->set('site_language_id', $req->post('site_language_id'));

		// Saber si esta pagina debe ser index

		// si la pgina trae idioma setear la seccion en db
		if($page->get('site_language_id') && $section->count() == 0)
		{
			//error_log('crear seccion en '. $req->post('lang_code'));
			$this->setSectionForLanguage($section, $req->post('site_language_id'));
		}

		$indexpage = $section->getIndexPage();
		if($indexpage->count() == 0)
		{
			// esta pagina es la primera de la seccion
			$page->set('index_status', 1);
		}else{
			$page->set('index_status', 0);
		}
		$page->insert();
		//error_log(print_r($page, true), 0);
		$page->getId();
		$page->saveData( $req);	// Guardar los campos de la pÃ¡gina

		// agregar pagina a menu
		/*
		1. Obtener el menu correspondiente al sitio en curso.
		2. Obtener si la pÃ¡gina esta ligada a una pÃ¡gina o secciÃ³n
		3. Ligar respectivamente
		*/
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());

		$site->find( $section->get('site_id'));
		$menu = $site->getIndexMenu();

		if(is_object($menu) && $menu->count() > 0)
		{
			$menuItem = new Cms_Model_MenuItem( Cms_Cms::getDbConnection());
			$menuItem->set('site_menu_id', $menu->get('id'));
			$menuItem->set('title' , $page->get('name'));
			$menuItem->set('content_id' , $page->getId());
			$menuItem->set('created_at' , Core_Base_Date::getDateTime());
			$menuItem->set('content_type' , Cms_Model_MenuItem::PAGE);
			// TODO: el orden se debe calcular en base al total de elementos menu en el menu actual
			$menuItem->set('orden' , 0);
			$menuItem->set('publish_status' , $page->get('publish_status'));
			$menuItem->set('index_status' , $page->get('index_status'));
			if($page->get('parent_page_id') == 0)
			{
				// la pÃ¡gina es hija directa de la categorÃ­a
				$menuItem->set('parent_id' , $req->post('section_id'));
				$menuItem->set('parent_type' , Cms_Model_MenuItem::PARENT_SECTION);
			}else{
				// su padre es otra pgina
				$menuItem->set('parent_id' , $req->post('parent_page_id'));
				$menuItem->set('parent_type' , Cms_Model_MenuItem::PARENT_PAGE);
			}
			$menuItem->set('code_name' , $page->get('name_code'));
			$menuItem->insert();

		}else{
			//echo "no se encuentra el menu principal";
			// Crear menu principal
		}

		// -- menu

		// Agregar pagina busqueda
		$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
		$structure->find($req->post('page_structure_id'));

		$fields = $structure->getFields();

		$spage = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$spage->find($page->getId());

		$keyword = '';
		$auxPage = new FrontCms_Core_Page($spage);

		$no = array('&aacute;', '&eacute;', '&iacute;','&oacute;', '&uacute;',   '&Aacute;', '&Eacute;', '&Iacute;','&Oacute;', '&Uacute;', '&ntilde;', '&Ntilde;');
		$si = array('á', 'é', 'í','ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');


		foreach($fields as $field)
		{
			//echo $field->get('unique_key'). ' : ' . $field->get('field_type').' <br>';
			if($field->get('field_type') == 3 || $field->get('field_type') == 1)
			{
				//echo '<br><strong>concatena</strong> '.$field->get('unique_key');
				$txt = strip_tags( $auxPage->get( $field->get('unique_key'))).' ';
				$tx = str_replace($no, $si, $txt );
				//$keyword.=  $auxPage->get( $field->get('unique_key'));
				$keyword.=  $tx;
			}

		}
		// guardar index

		$sipage = new Cms_Model_PageSearch( Cms_Cms::getDbConnection());
		$sipage->set('page_id', $spage->get('id'));
		$sipage->set('page_name', $spage->get('name'));
		$sipage->set('descripcion', $spage->get('meta_description'));
		$sipage->set('keywords', $spage->get('name')."\n".$keyword);
		$sipage->set('created_at', Core_Base_Date::getDateTime());
		// $sipage->insert();


		$res = new Core_Base_Response( $this);
		$res->addVar( 'page', $page);
		return $res;
	}
	public function update( $req)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->find( $req->post('page_id')); // pgina a actualizar
		$updt = array();
		// buscar la seccion correspondiente a su idioma y asignarla
		if($page->get('lang_code'))
		{
			//error_log('pgina corresponde a idioma');
			$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$section->loadId($page->get('site_section_id'));
			//$section->set('id', $page->get('site_section_id'));

			$langsection = $section->getForLanguage( $page->get('lang_code'));
			//error_log('Buscando section en :' . $page->get('lang_code'));
			if($langsection->count() > 0)
			{
				//$updt['site_section_id'] = $langsection->get('id');
			}
		}

		$current_name_code = Core_Base_String::plainString($req->post('page_name'));

		$updt['name'] = $req->post('page_name');
		$updt['updated_at'] = Core_Base_Date::getDateTime();
		$updt['name_code'] = $current_name_code;
		$updt['meta_description'] = $req->post('meta_description');
		$updt['meta_keywords'] = $req->post('meta_keywords');

		// Validar el code_name para eviatar repeticiones

		/*
		1. Buscar si existe una p�gina con el mismo nombre (que no sea la p�gina que se esta editando)
		2. Si existe una p�gina con ese nombre adjuntar un contador

		*/
		$find_another_name = true;
		$contador = 1;

		$pagcode = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$pagcode->select()->where('name_code = "'.$current_name_code.'" AND id <> '.$page->get('id'). ' AND site_section_id = ' . $page->get('site_section_id'))->runSelect();

		if($pagcode->count() > 0)
		{

			$find_another_name = true;
		}else{
			$find_another_name = false;
		}


		while($find_another_name)
		{
			$pagcode = new Cms_Model_Page( Cms_Cms::getDbConnection());
			$pagcode->select()->where('name_code = "'.$current_name_code.'" AND id <> '.$page->get('id'). ' AND site_section_id = ' . $page->get('site_section_id'))->runSelect();

			if($pagcode->count() > 0)
			{
				$current_name_code = $current_name_code.'-'.$contador;

				$contador++;

			}else{
				$find_another_name = false;
			}
		}
		$updt['name_code'] = $current_name_code;

		if(! $updt['meta_description'])
			$updt['meta_description'] = '';
		if(! $updt['meta_keywords'])
			$updt['meta_keywords'] = '';
		// var_dump($updt);
		$page->updateFields($updt);

		$menu = $page->getMenuItem();

		if($menu->count() > 0)
		{
			$page->updateMenuItem();
		}

		$page->updateData( $req);

		// Agregar pagina busqueda
		$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
		$structure->find($page->get('page_structure_id'));

		$fields = $structure->getFields();
		$spage = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$spage->find($page->getId());
		$keyword = '';
		$auxPage = new FrontCms_Core_Page($spage);

		$no = array('&aacute;', '&eacute;', '&iacute;','&oacute;', '&uacute;',   '&Aacute;', '&Eacute;', '&Iacute;','&Oacute;', '&Uacute;', '&ntilde;', '&Ntilde;');
		$si = array('á', 'é', 'í','ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');

		foreach($fields as $field)
		{
			//echo $field->get('unique_key'). ' : ' . $field->get('field_type').' <br>';
			if($field->get('field_type') == 3 || $field->get('field_type') == 1)
			{
				//echo '<br><strong>concatena</strong> '.$field->get('unique_key');
				$txt = strip_tags( $auxPage->get( $field->get('unique_key'))).' ';
				$tx = str_replace($no, $si, $txt );
				//$keyword.=  $auxPage->get( $field->get('unique_key'));
				$keyword.=  $tx;
			}
		}
		// guardar página de busquedas

		// $sipage = new Cms_Model_PageSearch( Cms_Cms::getDbConnection());
		// $sipage->select()->where('page_id='.$page->get('id'))->runSelect();
		// $sipage->set('page_name', $page->get('name'));
		// $sipage->set('descripcion', $page->get('meta_description'));
		// $sipage->set('keywords', $page->get('name')."\n".$keyword);

		// if($sipage->count() > 0 && $sipage->get('id') > 0)
		// {
		// 	$sipage->set('updated_at', Core_Base_Date::getDateTime());
		// 	$sipage->update();
		// }else{
		// 	$sipage->set('page_id', $page->get('id'));
		// 	$sipage->set('created_at', Core_Base_Date::getDateTime());

		// 	$sipage->insert();
		// }


		$res = new Core_Base_Response( $this);
		$res->addVar( 'page', $page);
		return $res;
	}
	public function delete( $req)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->loadId( $req->post('page_id'));
		$page->deletepage();

		$res = new Core_Base_Response( $this);
		$res->addVar( 'page', $page);
		return $res;
	}
	public function saveorder( $req)
	{
		/*
		1. Identificar el padre
		*/
		$list = $req->post('pages_list');
		$total = count($list);
		// $list = array_reverse( $list);
		$languages = new Cms_Model_Language( Cms_Cms::getDbConnection());
		$languages->collection()->runSelect();
		Log_Log::save(Cms_Cms::getDbConnection(), 'p�ginas a ordenar '. ($total - 1));
		for($i = 0; $i < ($total); $i++)
		{
			if(is_numeric($list[$i]))
			{
				$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
				$page->loadId($list[$i]);
				$page->updateFields(array('orden' => $i));
				$menuitem = $page->getMenuItem();
				if($menuitem->count() > 0)
				$menuitem->updateFields( array('orden' => $i));

				Log_Log::save(Cms_Cms::getDbConnection(), 'Ordenar página '.$list[$i]. ' nuevo orden '. $i);

				// actualizar en idiomas
				foreach($languages as $lang)
				{
					$page2 = new Cms_Model_Page( Cms_Cms::getDbConnection());
					$page2->select()->where('lang_main_page_id = '.$list[$i])->limit(1)->runSelect();

					//echo '<p>';
					if($page2->count() > 0)
					{
						// var_dump($page2->getId());
						$page2->updateFields( array('orden' => $i));
					}

				}
			}

		}

		$res = new Core_Base_Response( $this);
		return $res;
	}
	public function popupSelector( $req)
	{
		// presentar un arbol de links pÃ¡ginas para el popup de link de tinymce
		$sections= new Cms_Model_Section( Cms_Cms::getDbConnection());
		$sections->select()->where('site_id="'.$sections->secureText($req->get('page_id')).'"')->runSelect();

		$res = new Core_Base_Response( $this);
		$res->addVar('sections', $sections);
		return $res;
	}
	public function parentSelector( $req)
	{
		$currentPage = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$currentPage->find($req->get('page_id'));

		$currentParent = $currentPage->getParentPage();

		$sections= new Cms_Model_Section( Cms_Cms::getDbConnection());
		$sections->select()->where('site_id="'.$sections->secureText($req->get('site_id')).'"')->runSelect();

		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->get('site_id'));

		$languages = new Cms_Model_Language( Cms_Cms::getDbConnection());
		$languages->select()->where('site_id='.$site->get('id'))->runSelect();

		$res = new Core_Base_Response( $this);
		$res->addVar('currentPage', $currentPage);
		$res->addVar('currentParent', $currentParent);
		$res->addVar('sections', $sections);
		$res->addVar('languages', $languages);

		return $res;
	}
	public function assignParentPage($req)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->loadId( $req->post('page_id'));

		$page->updateFields( array('site_section_id' => $req->post('parent_section_id') , 'parent_page_id' => $req->post('parent_page_id')));
		$res = new Core_Base_Response( $this);
		$res->addVar('page', $page);
		return $res;
	}
	public function jxswitchpublicstatus($req)
	{
		/* modificar el estatus de la pgina y del menu correspondiente */
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->find( $req->get('page_id'));

		if($page->get('publish_status') == 0)
		{
			$data['publish_status'] = 1;
		}else
		{
			$data['publish_status'] = 0;
		}

		$data['publish_date'] = Core_Base_Date::getDate();

		$page->updateFields($data);

		$menu = $page->getMenuItem();
		$data = array();
		$data['publish_status'] = 1;

		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->find( $req->get('page_id'));

		$res = new Core_Base_Response( $this);
		$res->addVar('page', $page);
		return $res;
	}
	function js_shorter( $req)
	{
		$url = $req->post('page_id');

		$googl = new Cms_Library_GoogleShorter('http://www.lemonmedia.com.mx');
		echo $googl->result();
	}
	public function jx_updatePublishDate( $req)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->find($req->post('page_id'));
		$page->updateFields( array('publish_date' => $req->post('publish_date')));

		$res = new Core_Base_Response( $this);
		return $res;
	}
}


?>
