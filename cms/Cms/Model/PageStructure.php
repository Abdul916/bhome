<?php

/**
* Modelo para acceso a las estructuras "templates" de página
*/
class Cms_Model_PageStructure extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('page_structures');
		$this->setFields( array('id', 'created_at', 'updated_at', 'name', 'description', 'site_id', 'template_html_path', 'public'));
		$this->setUpdateFields( array('name', 'description'));
		
		$this->setHasMany('Cms_Model_StructureField', 'page_structure_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	
	public function getFields()
	{
		$childs = $this->getChilds('Cms_Model_StructureField');
		$childs->orderBy('orden')->runSelect();
		
		return $childs;
	}
}


?>