<?php

/**
* Controlador "Sites"
*/
class Cms_Controller_Site extends Core_App_Controller_Controller
{
	private $cachelist;
	function index($req)
	{
		//
		return $res = new Core_Base_Response( $this);
	}
	function add( $req)
	{
		return $res = new Core_Base_Response( $this);
	}
	public function save( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->loadArray( $req->getPost());
		$site->insert();
		
		// crear configuracion del sitio
		
		/*
		1. Ruta a los medios (img, swf)
		2. administrator_url
		*/
		
		if(!is_dir("cache"))
		mkdir("cache");
		
		if(!is_dir("cache/images"))
		mkdir("cache/images");
		
		
		$plainsitename = Core_Base_String::plainString( $req->post('name'));
		if(!is_dir("../upload/"))
		mkdir("../upload/");
		if(is_dir("../upload/".$plainsitename) || mkdir("../upload/".$plainsitename, 0777))
		{
			// Carpeta principal de media
			if(!is_dir("../upload/".$plainsitename.'/media')) mkdir("../upload/".$plainsitename.'/media', 0777);
			
			$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
			$conf->set('site_id', $site->getId());
			$conf->set('option_key', 'media_upload_path');
			$conf->set('option_name', 'Carpeta para media');
			$conf->set('option_value', "upload/".$plainsitename.'/media/');
			$conf->set('group', 'Información sobre Media');
			$conf->set('status', '1');
			$conf->set('order', '1');
			$conf->set('created_at', Core_Base_Date::getDateTime());
			$conf->insert();
			
			if(is_dir("../upload/".$plainsitename.'/media/galerias') || mkdir("../upload/".$plainsitename.'/media/galerias', 0777))
			{
				$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
				$conf->set('site_id', $site->getId());
				$conf->set('option_key', 'gallerys_upload_path');
				$conf->set('option_name', 'Carpeta para imagenes de galerias');
				$conf->set('option_value', "upload/".$plainsitename.'/media/galerias/');
				$conf->set('group', 'Información sobre Media');
				$conf->set('status', '1');
				$conf->set('order', '1');
				$conf->set('created_at', Core_Base_Date::getDateTime());
				$conf->insert();
			}
			
			if(is_dir("../upload/".$plainsitename.'/media/imagenes') || mkdir("../upload/".$plainsitename.'/media/imagenes', 0777))
			{
				$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
				$conf->set('site_id', $site->getId());
				$conf->set('option_key', 'images_upload_path');
				$conf->set('option_name', 'Carpeta para imagenes');
				$conf->set('option_value', "upload/".$plainsitename.'/media/imagenes/');
				$conf->set('group', 'Información sobre Media');
				$conf->set('status', '1');
				$conf->set('order', '1');
				$conf->set('created_at', Core_Base_Date::getDateTime());
				$conf->insert();
			}
			
			$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
			$conf->set('site_id', $site->getId());
			$conf->set('option_key', 'site_domain');
			$conf->set('option_name', 'Dominio del sitio');
			$conf->set('option_value', $req->post('domain'));
			$conf->set('group', 'Configuración del sitio web');
			$conf->set('status', '1');
			$conf->set('order', '1');
			$conf->set('created_at', Core_Base_Date::getDateTime());
			$conf->insert();
			
			$end = substr($req->post('domain') , -1);
			if($end !== false)
			{
				// viene con /
				$indexurl = $req->post('domain').'index.php';
			}else
			{
				$indexurl = $req->post('domain').'/index.php';
			}
			
			// CONFIGURACIÓN DE URL DEL SITIO
			$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
			$conf->set('site_id', $site->getId());
			$conf->set('option_key', 'site_url');
			$conf->set('option_name', 'Url al index del sitio');
			$conf->set('option_value', $indexurl);
			$conf->set('group', 'Configuración del sitio web');
			$conf->set('status', '1');
			$conf->set('order', '1');
			$conf->set('created_at', Core_Base_Date::getDateTime());
			$conf->insert();
			
			// CONFIGURACIÓN DE URL FRIENDLY
			$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
			$conf->set('site_id', $site->getId());
			$conf->set('option_key', 'friendly_url');
			$conf->set('option_name', 'El sitio utilizará URL Friendly');
			$conf->set('option_value', 0);
			$conf->set('group', 'Configuración del sitio web');
			$conf->set('status', '1');
			$conf->set('order', '1');
			$conf->set('created_at', Core_Base_Date::getDateTime());
			$conf->insert();
			
			$baseurl = '';
			$currentdomain = $_SERVER['SERVER_NAME'];	//host actual
			$currenturl = $_SERVER['PHP_SELF'];	 // ruta al archivo index del administrador

			$domain_pos = strpos($currenturl , $currentdomain);
			$url_minus_domain = substr($currenturl, 0, $domain_pos + strlen($currenturl));
			$file = basename($url_minus_domain);
			$baseurl = str_replace('admin/'.$file, '', $url_minus_domain);
			
			// CONFIGURACIÓN RUTA BASE PARA URL FRIENDLY
			$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
			$conf->set('site_id', $site->getId());
			$conf->set('option_key', 'friendly_url_base');
			$conf->set('option_name', 'El sitio utilizará URL Friendly');
			$conf->set('option_value', $baseurl);
			$conf->set('group', 'Configuración del sitio web');
			$conf->set('status', '1');
			$conf->set('order', '1');
			$conf->set('created_at', Core_Base_Date::getDateTime());
			$conf->insert();
			
			// CONFIGURACIÓN HABILITAR USO DE LIBRERIA GD2
			$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
			$conf->set('site_id', $site->getId());
			$conf->set('option_key', 'enable_gd2');
			$conf->set('option_name', 'Habilitar uso de libreria GD2');
			$conf->set('option_value', 1);
			$conf->set('group', 'Configuración de sistema');
			$conf->set('status', '1');
			$conf->set('order', '10');
			$conf->set('created_at', Core_Base_Date::getDateTime());
			$conf->insert();
			
			// CONFIGURACIÓN HABILITAR VERSION MOVIL
			$conf = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
			$conf->set('site_id', $site->getId());
			$conf->set('option_key', 'enable_mobile');
			$conf->set('option_name', 'Hábilitar ligas moviles');
			$conf->set('option_value', 0);
			$conf->set('group', 'Moviles');
			$conf->set('status', '1');
			$conf->set('order', '11');
			$conf->set('created_at', Core_Base_Date::getDateTime());
			$conf->insert();
		}
		
		// finalmente crear la sección home indicando que no tiene página home
		$indexsecc = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$indexsecc->set('name', 'Sección Index');
		$indexsecc->set('publish_status', '0');
		$indexsecc->set('status', '1');
		$indexsecc->set('created_at', Core_Base_Date::getDateTime());
		$indexsecc->set('site_id', $site->getId());
		$indexsecc->set('page_structure_id', '0');
		$indexsecc->set('index_status', '1');
		$indexsecc->set('code_name', 'index');
		$indexsecc->insert();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('site', $site);
		return $res;
	}
	function general( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->get('id'));
		//$sections = $site->getSections();
		$sections = new Cms_Model_Section( Cms_Cms::getDbConnection());
		$sections->select()->where('site_id = "'.$site->get('id').'" AND lang_code is NULL')->orderby('orden ASC')->runSelect();
		$res = new Core_Base_Response( $this);
		$res->addVar('site' , $site);
		$res->addVar('sections' , $sections);
		return $res;
	}
}

