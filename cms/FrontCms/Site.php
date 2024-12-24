<?php

/**
* Controlador de contenidos
*/
class FrontCms_Site
{
	static private $instance = null;
	private $_site;
	private $_index_section;
	private $_index_page;
	private $_language;

	protected $menuManager;
	protected $currentURL;
	protected $originalLangPage;

	protected $_currentPage;
	protected $_currentSection;

	protected $_decorators;

	private function __construct()
	{
		$this->_language = '';
		$this->_decorators = array();
	}

	static function instance()
	{
		if(!FrontCms_Site::$instance)
		{
			FrontCms_Site::$instance = new self();
		}

		return FrontCms_Site::$instance;
	}

	static function run( $site_identifier = null)
	{
		FrontCms_Site::instance()->setup($site_identifier);
		//$request = FrontCms_Site::instance()->getRequest();
		return FrontCms_Site::instance();
	}
	public function getSite()
	{
		return $this->_site;
	}
	public function setup( $site_identifier = null)
	{
		if( !is_numeric( $site_identifier))
		{
			// si no se indica un identificador obtener el sitio segun el dominio
			$site = new Cms_Model_Site( $this->getDbConnection());
			$site->select()->where('domain ="' . $site->secureText(FrontCms_Library_Domain::getDomain()) . '"')->runSelect();
		}else{
			$site = new Cms_Model_Site( $this->getDbConnection());
			$site->find($site_identifier);
		}

		$this->_site = $site;
		$this->decoratorsSetup();


		if($this->_site->count() == 0)
		{
			trigger_error("Site was not found", E_USER_ERROR);
		}
		$request = FrontCms_Site::instance()->getRequest();

		$this->manageRequest($request);

	}

	public function manageRequest($req)
	{
		if(Cms_Cms::getConfig( $this->_site->get('id'), 'friendly_url') && !isset($_GET['seccid']))
		{
			// el sitio tiene estructura URLS_USER_FRIENDLY
			list($section_str_id, $page_str_id) = $this->getHumanUrl();
			// echo 'path, secc: '. $section_str_id. ' , page: ' . $page_str_id;
			// exit;

			if($section_str_id == 'indexcode' && $page_str_id == 'indexcode')
			{
				// el usuario va al index
				$this->getIndexStructure();
				$section = $this->_index_section;
				$this->originalLangPage = $page = $this->_index_page;

				if($this->getLanguage())
				{
					$page2 = new Cms_Model_Page( $this->getDbConnection());
					$page2->select()->where('lang_code = "'.strtoupper($this->getLanguage()).'" AND lang_main_page_id ='. $page->get('id'))->runSelect();
					$page = $page2;
				}
			}
			else
			{
				// buscar la sección que corresponda a $section_str_id
				$section = $this->getSection( $section_str_id);

				// echo ' 1 ';
				if($section && $page_str_id == 'indexcode')
				{
					// obtener el index de la sección
					// echo ' 2 ';
					$page = new Cms_Model_Page( $this->getDbConnection());
					$page->select()->where('(index_status = 1 AND site_section_id ='. $section->get('id'). ') AND (site_language_id = 0 or site_language_id is null) ')->runSelect();
					$this->originalLangPage = $page;

					$this->setCurrentURL($section, $this->originalLangPage);

					if($this->getLanguage())
					{
						// print_r($section);
						$page2 = new Cms_Model_Page( $this->getDbConnection());
						$page2->select()->where('lang_code = "'.strtoupper($this->getLanguage()).'" AND index_status = 1 AND site_section_id ='. $section->get('id'))->runSelect();
						$page = $page2;
						error_log( print_r($page2, true), 0);
					}
				}else{
					// echo ' 4 ';
					// echo 'section '.$section;
					// exit;
					$indexsection = null;

					if(!$section)
					{
						$section = $this->getSiteIndexSection();

						$page = $this->getPageBySection($section, $section_str_id);

						// echo "<pre>";
						// print_r($page);
						// exit;
						$indexsection = $section;

						if($page->count() > 0)
							$this->loadPage($section, $page);
						else
							$this->error_404('402');
						return;
					}

					$page = $this->getPage($section, $page_str_id);

					if(!$page || $page->count() == 0)
					{
						$page = $this->getPageBySection($section);
					}

					if(!$page)
					{
						// la seccion no existe
						echo '5 ';
						$page = $this->getPage(null, $section_str_id);
						$section = $indexsection;

						//print_r($page);
					}
					$this->setCurrentURL($section, $this->originalLangPage);
				}

				if(!$section)
				{
					$this->error_404('121');
				}
				if(!$page)
					$this->error_404('122');
			}

		}else{
			// buscar por id
			$secc_id = $req->get('seccid');
			if(isset($secc_id) && is_numeric($secc_id))
			{
				// se pidio una seccion
				$section = $this->getSection( $req->get('seccid'));
				$page = new Cms_Model_Page( $this->getDbConnection());
				$page->select()->where('index_status = 1 AND site_section_id ='. $section->get('id'))->runSelect();


			}else{
				// si no viene la seccion mandar a index
				$this->getIndexStructure();
				$section = $this->_index_section;
				$page = $this->_index_page;
			}

			$page_id = $req->get('pageid');
			if(isset($page_id) && is_numeric($page_id))
			{
				$page = new Cms_Model_Page( $this->getDbConnection());
				$page->find($page_id);
			}
			$this->setCurrentURL($section, $page);
		}

		if(isset($_GET['lang']) && strlen($_GET['lang']) == 2)
		{
			$language = new Cms_Model_Language( $this->getDbConnection());
			$language->select()->where('site_id='.$section->get('site_id').' AND code="'.strtoupper($_GET['lang']).'"')->runSelect();
			$this->setLanguage( strtolower($language->get('code')));
			$langpage = $page->getLanguageVersion($language);

			if($langpage->count() > 0)
			{
				$page = $langpage;
			}
		}

		//error_log( "load secc: " . print_r($section, true));
		//error_log( "load page: " . print_r($page, true));

		$this->loadPage($section , $page);
	}
	public function setCurrentURL($section, $page)
	{
		if($section)
			$this->currentURL = $section->get('code_name');
		/*
		if($page->get('index_status') != 1)
			$this->currentURL.= '/'.$page->get('name_code');
			*/
		}
		public function getCurrentURL()
		{
			return $this->currentURL;
		}
		public function isMobile()
		{
			$query = $_SERVER['REQUEST_URI'];
			if( strpos($query, '/m/') !== false)
			{
				return true;
			}
			return false;
		}
		public function getHumanUrl()
		{
		// debe regresar un array con las capas de acceso de la url
			$query = $_SERVER['REQUEST_URI'];

			if(!Cms_Cms::getConfig( $this->_site->get('id'), 'friendly_url'))
				return null;

			if( strpos($query, '?') !== false)
			{
				$query = substr( $query, 0, strpos($query, '?'));
			}

			if(Cms_Cms::getConfig( $this->_site->get('id'), 'friendly_url_base') == '/')
			{
			// si la dirección termina en diagonal eliminarla
				$query = $query = substr($query, 1);
			}
			else
			{
			// eliminar las carpetas de la url
				$query = str_replace( Cms_Cms::getConfig( $this->_site->get('id'), 'friendly_url_base'), '', $query);

			}

		// eliminar variables


		// eliminar la carpeta mobile
			if( $this->isMobile())
			{
				$query = substr( $query, 2, strlen($query));
			}

			$lang = false;
			$langs = $this->getLanguages();

			if( substr($query, -1, 1) == '/')
			{
				$query = substr($query, 0, -1);
			}
			$array = explode('/', $query);
		//error_log('1. RUTA '. $query);
			if(count($array) > 0 && in_array($array[0] , $langs))
			{
				$lang = $array[0];
				$this->setLanguage( $lang);
			}

			if(strlen($query) == 0 || ( strlen($query) == 2 && in_array( $query , $this->getLanguages()) ))
			{
			//usuario va a index
				$this->setLanguage( $lang);
				return array('indexcode', 'indexcode', $lang);
			}
			else
			{
			//error_log('2. RUTA '. $query);
				if(count($array) == 1)
				{
				// solo viene la sección o el idioma
					$secc = $array[0];
				//error_log ('secc == '.$array[0], 0);

					if( $lang && $array[0] == $lang)
					{
						$secc = 'indexcode';
					}
				//echo '3';
					return array($secc, 'indexcode' , $lang);
				}else{
					if($lang)
					{
						if(count($array) == 2)
						{
						// viene idioma y seccion
							return array($array[1], 'indexcode', $lang);
						}else{
						// vienen los tres elementos
							return array($array[1], $array[2], $lang);
						}
					}
					if(strpos($array[1], '?') !== false)
					{
						$array[1] = 'indexcode';
					}
				//echo '4' . $lang;
				//print_r($array);
				// no viene el idioma
				//error_log('3. RUTA '. $query);
					return explode('/', $query);
				}
			}
		//$array = explode();
		}
		function setLanguage( $lang)
		{
			if($lang)
				$this->_language = $lang;
		}
		function getLanguageTemp()
		{
			$ln = $this->getLanguage();
			if( $ln)
			{
				$ln  = '_'.$this->_language;
			}

			return $ln;
		}
		function getLanguage()
		{
			$ln = '';
			if( $this->_language)
			{
				$ln  = $this->_language;
			}

			return $ln;
		}
		public function getRequest()
		{
			$request = new Core_Base_Request();
			return $request;
		}

		public function getSection( $section_identifier)
		{
			$section = new Cms_Model_Section( $this->getDbConnection());

			if(is_numeric($section_identifier))
			{
				$section->find($section_identifier);
			}
			else
			{
				$lng = '';

			//$where = ' AND (site_language_id IS NULL OR site_language_id = 0)';
				$where = '';
				$section->select()->where(' code_name ="'.$section->secureText($section_identifier).'"'.$where)->runSelect();
			}

			if($section->count() > 0)
			{
			//error_log(' section found: ' . print_r($section , true));
				if($section->get('lang_code'))
					$this->setLanguage(strtolower($section->get('lang_code')));
				return $section;
			}
			else
			{
				error_log(' not section found for: ' . $section_identifier);
				return null;
			}

		}
		public function getPage($section, $page_identifier)
		{
			$page = new Cms_Model_Page( $this->getDbConnection());

			if(is_numeric( $page_identifier))
			{
				$page->find( $page_identifier);
			}else
			{
				$lng = '';
				if($section)
					$page->select()->where(' name_code ="'.$page->secureText($page_identifier).'" AND site_language_id = 0 AND site_section_id = ' . $section->get('id'))->runSelect();
				else
					$page->select()->where(' name_code ="'.$page->secureText($page_identifier).'" AND site_language_id = 0')->runSelect();

				$this->originalLangPage = $page;
				if($this->getLanguage())
				{
					$lng = ' AND lang_code ="'.$this->getLanguage().'"';
					$page_id = $page->get('id');
					if( !is_array($page_id) && $page_id > 0)
					{
						$page2 = new Cms_Model_Page( $this->getDbConnection());
						$page2->select()->where('lang_code = "'.strtoupper($this->getLanguage()).'" AND lang_main_page_id ='. $page_id)
						->runSelect();
						$page = $page2;
					}else {
						$page = new Cms_Model_Page( $this->getDbConnection());
					}

				}
			}

			if($page->count() > 0)
				return $page;

			return null;
		}
		public function getIndexStructure()
		{
			$this->_index_section = $this->getSiteIndexSection();

			$this->_index_page = $this->_index_section->getIndexPage();
		}
		public function getSiteIndexSection()
		{
			$index_section = new Cms_Model_Section( $this->getDbConnection());
		$index_section->getIndex( $this->_site->get('id'));	// obtener la sección index del sitio
		return $index_section;
	}

	public function getLanguages()
	{
		$langs = new Cms_Model_Language( Cms_Cms::getDbConnection());
		$langs->collection()->runSelect();
		$langslist = array();
		foreach($langs as $lang)
		{
			$langslist[] = strtolower($lang->get('code'));
		}
		return $langslist;
	}
	function setCurrentPage( $section, $page)
	{
		$this->_currentPage = $page;
		$this->_currentSection = $section;
	}
	function getCurrentPage()
	{
		return $this->_currentPage;
	}
	function getCurrentSection()
	{
		return $this->_currentSection;
	}

	function getPageBySection($section, $page_code = null)
	{
		list($section_str_id, $page_str_id) = $this->getHumanUrl();

		if($page_str_id != 'indexcode' || $page_code)
		{

			if(!$page_code)
			{
				$page_code = $page_str_id;
			}


			$page = new Cms_Model_Page( $this->getDbConnection());

			if($section->get('index_status') == 1)
			{
				$page->select()->where(' name_code ="'.$page->secureText($page_code).'" AND (site_section_id = '.$section->get('id').' OR site_section_id = 14)')->runSelect();

				if($page->get('lang_code') != '')
				{
					$this->setLanguage( strtolower($page->get('lang_code')));
				}

			}else{
				$page->select()->where(' name_code ="'.$page->secureText($page_code).'" AND site_section_id = '.$section->get('id'))->runSelect();
			}


		}else{
			if(!is_object($section))
			{
				if($section_str_id == 'indexcode')
				{
					$section = new Cms_Model_Section( Cms_Cms::getDbConnection());
					$section->find(3);
				}else{
					$section = $this->getSection($section_str_id);
					$section->runSelect();
				}
			}

			$page = $section->getIndexPage();

		}

		return $page;
	}
	public function loadByDecorator( $decorators)
	{
		$url = '/'.implode("/", $this->getHumanUrl());
		foreach($decorators as $decorator)
		{
			//error_log( print_r( $url, true));
			if($decorator->validateRoute( $url))
			{
				return $decorator;
				break;
			}
		}
		return null;
	}
	function loadPage($section , $pagecms)
	{
		if( ! $pagecms->count() > 0) {

			$this->error_404(401);
			return;
		}

		if(count($this->_decorators) > 0)
		{
			$decorator = $this->loadByDecorator($this->_decorators);

			if( $decorator){

				$url = implode("/", $this->getHumanUrl());
				//error_log('human URL ' . print_r($this->getHumanUrl(), true));
				//error_log('Decorator URL ' . $url);
				$response = $decorator->getTemplate( $url);

				$theme_path = $this->getConfig( 'administrator_url') . $this->_site->get('theme_path').$response['template'].'.php';

				if( !is_file( $theme_path))
				{
					error_log('El template '. $theme_path.' no se ha encontrado', 0);
					//echo 'El template '. $theme_path.$template.'.php no se ha encontrado';
					//print_r($page_structure);
					//print('Template include: ' . $theme_path.$template.'.php');
					//print_r($pagecms);
					$query = $_SERVER['REQUEST_URI'];
					$this->error_404('290');
					return;
				}else{
					//error_log(print_r($response, true));
					// print_r($response);
					extract($response['data']);
					// echo $theme_path;
					include($theme_path);
				}

				return;
			};

		}

		$this->setCurrentPage( $section, $pagecms);

		$page = null;
		$theme_path = $this->getConfig( 'administrator_url') . $this->_site->get('theme_path');

		if($this->isMobile())
		{
			$theme_path = Cms_Cms::getConfig(false, 'administrator_url') . Cms_Cms::getConfig( $this->_site->get('id'), 'mobile_theme_path');
		}

		$page_structure = $pagecms->getStructure();

		$template = $page_structure->get('template_html_path');

		// setear la página a traves de una interfase
		$page = new FrontCms_Core_Page( $pagecms);

		if(is_file($theme_path.'page-'.$pagecms->get('id').$this->getLanguageTemp().'.php'))
		{
			include($theme_path.'page-'.$pagecms->get('id').$this->getLanguageTemp().'.php');
			return;
		}
		else{
			if( !is_file( $theme_path.$template.'.php'))
			{
				print('El template '. $theme_path.$template .'.php no se ha encontrado');
				echo 'El template '. $theme_path.$template.'.php no se ha encontrado';
				// print_r($page_structure);
				// print('Template include: ' . $theme_path.$template.'.php');
				var_dump($pagecms);
				$query = $_SERVER['REQUEST_URI'];
				$this->error_404('120');
				return;
			}

			//echo 'LP 4 <br /> ' . $theme_path.$template.$this->getLanguageTemp().'.php';
			include($theme_path.$template.$this->getLanguageTemp().'.php');
			return;
		}
		//echo 'LP 5 <br />';
		return;
	}
	public function getConfig($config_name)
	{
		return Cms_Cms::getConfig( $this->_site->get('id'), $config_name);
	}
	static function getDbConnection()
	{
		return Cms_Cms::getDbConnection();
	}
	public function menuManager()
	{
		if(!is_object($this->menuManager))
		{
			$this->menuManager = new FrontCms_Core_MenuManager( $this->getDbConnection());
		}
		return $this->menuManager;
	}

	public function error_404($error_code)
	{

		header("HTTP/1.0 404 Not Found");
		$erro = '';
		if($error_code)
			$erro = ', error: '.$error_code;
		die('<h1>Content not found ' . $erro . '</h1>');
		error_log('404 ERROR');
		/*$section = $this->getSection('proximamente');

		$page = $this->getPage('proximamente');
		$this->setCurrentURL($section, $page);

		$this->loadPage($section,  $page);
		exit;*/
	}
	public function addUrlModifier( $decorator)
	{
		array_push($this->_decorators, $decorator);
	}
	public function decoratorsSetup()
	{
		foreach( $this->_decorators as $decorator)
		{
			$decorator->setSite( $this->_site);
		}
	}

	public function factory($object)
	{
		switch ($object) {
			case 'page':
			return new Cms_Model_Page( Cms_Cms::getDbConnection());
			
			default:
				# code...
			break;
		}
	}
}


?>
