<?php

/**
 * 
 */
class Cms_Model_Section extends Core_App_Model_Model2
{
  private $langSection;
  function setup()
  {
    $this->setTable('site_sections');
    $this->setFields(array(
      'id', 'name', 'site_menu', 'section_type', 'publish_status',
      'status', 'publish_date', 'site_section_id', 'created_at', 'updated_at', 'site_id',
      'page_structure_id', 'index_status', 'code_name', 'lang_code', 'lang_main_section_id', 'site_language_id', 'orden'
    ));

    $this->setUpdateFields(array('name', 'page_structure_id'));

    $this->setBelongsTo('Cms_Model_Site', 'site_id');
    $this->setPointerTo('Cms_Model_Site', 'site_id');
    $this->setHasMany('Cms_Model_Page', 'site_section_id');
    $this->setPointerTo('Cms_Model_PageStructure', 'page_structure_id');
    $this->setHasOne('Cms_Model_MenuItem', 'content_id');
  }
  public function newSelf(Core_Db_Db $dbConnection)
  {
    return new self($dbConnection);
  }
  public function getPagesWhitoutIndex()
  {
    $pages = $this->getChilds('Cms_Model_Page')->where(' AND index_status <> 1 ORDER BY orden DESC');
    $pages->runSelect();
    return $pages;
  }
  public function getPages()
  {
    $pages = $this->getChilds('Cms_Model_Page')->orderBy('orden ASC');
    $pages->runSelect();
    return $pages;
  }
  public function getStructure()
  {
    $structure = new Cms_Model_PageStructure(Cms_Cms::getDbConnection());
    $structure->find($this->get('page_structure_id'));

    return $structure;
  }
  public function getParentPages()
  {
    $main_pages = new Cms_Model_Page(Cms_Cms::getDbConnection());
    $lang = '';
    if ($this->get('site_language_id') && is_numeric($this->get('site_language_id')) && $this->get('site_language_id') > 0) {
      $lang = 'AND site_language_id = ' . $this->get('site_language_id');
    } else {
      $lang = 'AND (site_language_id IS NULL OR site_language_id = 0)';
    }
    $main_pages->select()->where('(parent_page_id IS NULL OR parent_page_id = 0) AND (site_id = "' . $this->get('site_id') . '" AND site_section_id = "' . $this->getId() . '" ' . $lang . ') ORDER BY orden ASC')->runSelect();

    return $main_pages;
  }
  public function getMenuItem()
  {
    $menuitem = new Cms_Model_MenuItem(Cms_Cms::getDbConnection());
    $child = $menuitem->select()->where('content_id = ' . $this->get('id') . ' AND content_type = ' . Cms_Model_MenuItem::SECTION);
    $child->runSelect();
    return $child;
  }
  public function getSite()
  {
    $site = $this->getPointed('Cms_Model_Site');
    $site->runSelect();
    return $site;
  }
  public function getIndex($site_id)
  {
		// obtiene la sección index del id de sitio enviado
		//$indexsecc = new Cms_Model_Section( Cms_Cms::getDbConnection());
    $this->select()->where('site_id = "' . $site_id . '" AND index_status ="1" AND (lang_main_section_id IS NULL OR lang_main_section_id=0)')->runSelect();
    return $this;
  }
  public function getIndexPage()
  {
    $page = new Cms_Model_Page(Cms_Cms::getDbConnection());
    $page->select()->where('site_section_id ="' . $this->get('id') . '" AND index_status ="1"')->limit(1)->runSelect();

    return $page;
  }
	/*
	Busca el modelo de la seccion correspondiente a un Idioma
	Si el parametro esta vasio regresa a si mismo como el resutado
   */
  public function getForLanguage($lang)
  {
    if (!$lang) {
      return $this;
    }
    if (!is_object($this->langSection)) {
      $section2 = new Cms_Model_Section(Cms_Cms::getDbConnection());
      $section2->select()->where('lang_code = "' . $lang . '" AND lang_main_section_id =' . $this->get('id'));
      $section2->runSelect();
      $this->langSection = $section2;
    }
    return $this->langSection;
  }
  public function getNextOrden()
  {
    $db = $this->_dbConnection;
    $query = 'SELECT MAX(orden) AS max_orden FROM site_pages WHERE site_section_id = ' . $this->get('id');
    $res = $db->query($query);
    if ($res) {
      $data = $db->fetchObject($res);
      // print_r($data);
      return ($data[0]->max_orden + 1);
    } else {
      return 0;
    }


  }
}

