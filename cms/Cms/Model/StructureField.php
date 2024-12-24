<?php
/**
* 
*/
class Cms_Model_StructureField extends Core_App_Model_Model2
{
	const TEXT_FIELD = 1;
	const TEXT_AREA = 2;
	const RICH_TEXT_FIELD = 3;
	const IMAGE_FIELD = 4;
	const IMAGE_COLLECTION_FIELD = 5;
	const DATA_COLLECTION_FIELD = 6;
	const CHECKBOX_FIELD = 7;
	const LINK_FIELD = 8;
	const DROPDOWN_FIELD = 9;
	const GMAP_FIELD = 10;
	const DATE_FIELD = 11;
	
	function setup()
	{
		$this->setTable('structure_fields');
		$this->setFields( array('id', 'page_structure_id', 'field_type', 'status', 'created_at', 'updated_at', 'name', 'orden', 'unique_key', 'description'));
		$this->setUpdateFields( array('page_structure_id', 'field_type', 'name', 'description'));
		
		$this->setBelongsTo('Cms_Model_PageStructure', 'page_structure_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function getLastOrderForPageStructure( $page_structure_id)
	{
		if(!is_numeric($page_structure_id))
			return 0;
		$this->setFields( array('maximo'));
		$this->select('max(orden) as maximo')->where('page_structure_id = "'.$page_structure_id.'"');
    $this->runSelect();
    // print_r( $this);
		return ( intval($this->getObjectAt(0)->get('maximo')) + 1);
	}
	public function getNounsArray()
	{
		$nouns = array();
		$nouns[Cms_Model_StructureField::TEXT_FIELD] = 'Texto';
		$nouns[Cms_Model_StructureField::TEXT_AREA] = 'Texto grande';
		$nouns[Cms_Model_StructureField::RICH_TEXT_FIELD] = 'Texto con formato';
		$nouns[Cms_Model_StructureField::IMAGE_FIELD] = 'Imagen';
		$nouns[Cms_Model_StructureField::IMAGE_COLLECTION_FIELD] = 'Galería de imagenes';
		$nouns[Cms_Model_StructureField::DATA_COLLECTION_FIELD] = 'Campo dinámico con titulo y texto';
		$nouns[Cms_Model_StructureField::CHECKBOX_FIELD] = 'Checkbox';
		$nouns[Cms_Model_StructureField::LINK_FIELD] = 'Link a página';
		$nouns[Cms_Model_StructureField::DROPDOWN_FIELD] = 'Menú';
		$nouns[Cms_Model_StructureField::GMAP_FIELD] = 'Google Map';
		$nouns[Cms_Model_StructureField::DATE_FIELD] = 'Fecha';
		
		return $nouns;
	}
	public function fieldTypeToNoun( $field_type)
	{
		$nouns = $this->getNounsArray();
		
		return $nouns[$field_type];
	}
}


?>