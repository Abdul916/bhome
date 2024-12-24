<?php
/**
* Clase para vista de páginas
*/
class FrontCms_Core_Page
{
	private $_page;
	private $_data;
	private $_pageData;
	public $_error;
	private $_interfaseSeted = false;
	function __construct(Cms_Model_Page $page = null)
	{
		// Setear el array de contenido de la página
		$this->_data = array();
		$this->_interfaseSeted = false;
		// si se envia una página setearla como el modelo del objeto
		if($page)
		{
			$this->setThisPage($page);
		}
	}
	function load( $page_identifier)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		
		if(is_numeric($page_identifier))
		{
			$page->find($page_identifier);
		}else{
			$page->select()->where(' name_code ="'.$section->secureText($page_identifier).'"')->runSelect();
		}
		
		if($page->count() == 0)
		{
			$this->_error = 404;
			return;
		}
		$this->setThisPage($page);
	}
	public function model()
	{
		return $this->getThisPage();
	}
	private function setThisPage(Cms_Model_Page $page)
	{
		$this->_page = $page;
		//$this->setInterfase();
	}
	private function getThisPage()
	{
		return $this->_page;
	}
	private function setInterfase()
	{
		/* Generar el codigo necesario para acceder a la informacion de la página
		   con una interfase sencilla de usar
		   1. Obtener la estructura de contenido
		   2. Generar un array con los datos
		   3. generar objetos para casos especiales
		*/
		
		$data_field = $this->getPageData();
		$page_structure = $this->_page->getStructure();
		$this->setData( 'page-name', $this->_page->get('name'));
		if($page_structure->count() > 0)
		{
			$structure_fields = $page_structure->getFields();
			// hacer un loop sobre la estrucutra de contenido
			foreach( $structure_fields as $structure_field)
			{
				$dataModel = $data_field->getModelForFieldId( $structure_field->get('id'));
				

				if(is_object($dataModel))
				{
					$this->setData( $structure_field->get('unique_key'), $dataModel->getValue());
				}
				
			}
		}
		$this->setData( 'meta_description', $this->_page->get('meta_description'));
		$this->setData( 'meta_keywords', $this->_page->get('meta_keywords'));
		
		$this->_interfaseSeted = true;
	}
	protected function getPageData()
	{
		if(!is_object( $this->_page))
			return null;
		if(!is_object( $this->_pageData))
			$this->_pageData = $this->_page->getData();

		return $this->_pageData;
	}
	protected function setData( $field, $value)
	{
		$this->_data[$field] = $value;
	}
	function get( $field_name)
	{
		if(!$this->_interfaseSeted) $this->setInterfase();
		
		return $this->_data[$field_name];
	}
	public function eco($field)
	{
		if(!$this->_interfaseSeted) $this->setInterfase();
		
		echo stripslashes($this->get( $field));
	}
	public function getImage($field)
	{
		if(!$this->_interfaseSeted) $this->setInterfase();
		
		return $this->get( $field);
	}
	public function getLink($field)
	{
		if(!$this->_interfaseSeted) $this->setInterfase();
		
		return $this->get( $field);
	}
	public function getMainLanguagePage()
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->find( $this->model()->get('lang_main_page_id'));
		return new FrontCms_Core_Page( $page);
	}
	public function getLanguagePage( $language_code)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->select()->where( 'lang_main_page_id='.$this->model()->get('id').' AND lang_code = "'.strtoupper($language_code).'" AND publish_status = 1');
		$page->runSelect();
		
		if($page->count() == 1)
		return new FrontCms_Core_Page( $page);
		else
			return null;
	}
	public function getUrl( $vars = array())
	{
		$lang = '';
		$urlvars = '';
		$lang = array();
		if(isset($_GET['lang']))
		{
			$lang = '&lang='.$_GET['lang'];
			$lang = array('lang' => $_GET['lang']);
		}
		// var_dump($this->model()->count());
		// if($this->model()->count() == 0)
		// {
		// 	return '';
		// }
		// var_dump($this->model());
		// echo "\n";
		if( $this->model()->get('site_id') == null )
		{
			throw new Exception("La pagina con el ID " . $this->model()->get('id') . ' no tiene site_id', 1);
			
		}
		if(Cms_Cms::getConfig($this->model()->get('site_id'), 'friendly_url'))
		{
			$section = $this->model()->getSection();
			$url = Cms_Cms::getConfig($this->model()->get('site_id'), 'friendly_url_base');
			$urlvars = $this->createUrlVars($lang, $vars);

			$url.= $section->get('code_name').'/';

			if($this->model()->get('index_status') == 0)
			{
				$url.= $this->model()->get('name_code').'/';
			}
			if($urlvars)
				$url.='?'.$urlvars;
		}else{
			$nav_ids = array('seccid' => $this->_page->get('site_section_id'), 'pageid' => $this->_page->get('id'));
			$urlvars = $this->createUrlVars($nav_ids, $lang, $vars);
			$url  = Cms_Cms::getConfig($this->model()->get('site_id'), 'friendly_url_base') . 'index.php?'.$urlvars;
		}
		return $url;
	}
	public function createUrlVars( $arr, $arr2, $arr3 = array(), $arr4 = array())
	{
		$arr = array_merge($arr, $arr2, $arr3, $arr4);
		$v = Core_Base_String::arrayImplode( '=', '&', $arr, true );
		return $v;
	}
	public function getTitle()
	{
		return $this->_page->get('name');
	}
	public function indexStatus()
	{
		return $this->_page->get('index_status');
	}
}

?>
