<?php
/**
* DataType para campos de página, TIPO LINK
*/
class Cms_DataType_Link
{
	protected $data;
	protected $page;
	function __construct(Cms_Model_Data $data)
	{
		$this->data = $data;
		$model = $data->get('foreign_model');
		$value = new $model( Cms_Cms::getDbConnection());
		$value->find($data->get('foreign_id'));
		$this->page = $value;
	}
	
	public function getPage()
	{
		return $this->page;
	}
	public function getData()
	{
		return $this->data;
	}
	public function hasPage()
	{
		if(is_object($this->page) && $this->page->count() > 0)
		{
			return true;
		}
		return false;
	}
	public function getUrl( $site_id = null)
	{
		$link = 'index.php?seccid='.$this->page->get('site_section_id').'&pageid='.$this->page->get('id');
		if($site_id)
		{
			$url_friendly =Cms_Cms::getConfig( $site_id, 'friendly_url');
			$url_base =Cms_Cms::getConfig( $site_id, 'friendly_url_base');
			
			if(!$url_friendly)
			{
				return $url_bas.$link;
			}
			
			/*
			Optener la página
			Si la pagina esta en otro idioma buscar esa página
			Buscar la seccion de la página en otro idioma
			Buscar el padre de la seccion en otro idioma
			
			linkear a la seccion principal con la página padre 
			y agregar el codigo del idioma de la página origina
			*/
			$section = $this->page->getSection();
			$link = Cms_Cms::getConfig( $site_id, 'friendly_url_base');
			
			
			if(FrontCms_Site::instance()->getLanguage())
			{
				// viene un idioma
				$parentpage = new Cms_Model_Page( Cms_Cms::getDbConnection());
				$parentpage->select()->where('id ='.$this->page->get('lang_main_page_id'))->runSelect();
				//$this->page = $parentpage;
				
				$link.= FrontCms_Site::instance()->getLanguage().'/';
				
				$link.= $section->get('code_name').'/';
				if($parentpage->get('name_code'))
				$link.= $parentpage->get('name_code').'/';
				
			}else
			{
				$link.= $section->get('code_name');
				$link.= '/'.$this->page->get('name_code').'/';
			}
			
		}
		
		return $link;
	}
	public function getTitle()
	{
		return $this->data->get('str_value');
	}
}

?>