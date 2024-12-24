<?php

/**
* Control de datos sobre una pagina
*/
class Cms_Model_Data extends Core_App_Model_Model2
{
	protected $_arrayModelStructureDone = false;
	protected $_arrayModelStructure;
	function setup()
	{
		$this->setTable('page_datas');
		$this->setFields( array('id', 'data_type', 'str_value', 'int_value', 'text_value', 'date_value', 
						'foreign_id', 'foreign_model', 'created_at', 'updated_at', 'site_page_id', 'structure_field_id'));
		$this->setUpdateFields( array('str_value', 'int_value', 'text_value', 'date_value'));
		
		$this->setPointerTo('Cms_Model_Page', 'site_page_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function getPage()
	{
		if( ! $this->get('site_page_id') > 0) return null;
		$page = $this->getPointed('Cms_Model_Page');
		//error_log( print_r($this, true), 0);
		$page->runSelect();
		return $page;
	}
	public function setType($fieldType)
	{
		$this->set('data_type', $fieldType);
	}
	public function getValue()
	{
		/*if( $this->getModelStatus() != self::NORMAL)
		{
			return null;
		}*/
		$value = '';
		
		switch( $this->get('data_type'))
		{
			case Cms_Model_StructureField::TEXT_FIELD:
				$value = $this->get('str_value');
				break;
			case Cms_Model_StructureField::TEXT_AREA:
				$value = $this->get('text_value');
				break;
			case Cms_Model_StructureField::RICH_TEXT_FIELD:
				$value = $this->get('text_value');
				break;
			case Cms_Model_StructureField::IMAGE_FIELD:
				/*$this->set('data_type', Cms_Model_StructureField::IMAGE_FIELD);
				$this->set('foreign_model', 'Cms_Model_Image');
				$this->set('foreign_id', $fieldValue);*/
				$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
				if(is_numeric($this->get('foreign_id')) && $this->get('foreign_id') > 0)
				$image->find($this->get('foreign_id'));
				
				$value = $image;
				break;
			case Cms_Model_StructureField::IMAGE_COLLECTION_FIELD:
				if( ! is_numeric($this->get('foreign_id'))) {
					// Crear una nueva data collections
					$dataCollection = new Cms_Model_ImageCollection( Cms_Cms::getDbConnection());
					$dataCollection->set('created_at', Core_Base_Date::getDateTime());
					$dataCollection->insert();
					$this->updateFields(['foreign_id' => $dataCollection->get('id'), 'foreign_model' => 'Cms_Model_ImageCollection']);
					$value = $dataCollection;
				}else {
					$imagec = new Cms_Model_ImageCollection( Cms_Cms::getDbConnection());
					$imagec->find($this->get('foreign_id'));
					$value = $imagec;
				}
				
				break;
			case Cms_Model_StructureField::DATA_COLLECTION_FIELD:
				$datacollection = new Cms_Model_DataCollection( Cms_Cms::getDbConnection());
				$datacollection->find($this->get('foreign_id'));
				$value = $datacollection;
				break;
			case Cms_Model_StructureField::CHECKBOX_FIELD:
				$value = $this->get('int_value');
				break;
			case Cms_Model_StructureField::LINK_FIELD:
				$model = $this->get('foreign_model');
				$value = new Cms_DataType_Link( $this);
				break;
			case Cms_Model_StructureField::DROPDOWN_FIELD:
				$value = $this->get('str_value');
				break;
			case Cms_Model_StructureField::GMAP_FIELD:
				$mapc = new Cms_Model_Map( Cms_Cms::getDbConnection());
				if(is_numeric($this->get('foreign_id')))
					$mapc->find($this->get('foreign_id'));
				$value = $mapc;
				break;
			case Cms_Model_StructureField::DATE_FIELD:
				$value = $this->get('date_value');
				break;
			default:
				trigger_error( "El tipo de dato para este modelo no se ha definido : Cms_Model_Data", E_USER_ERROR);
				return;
				break;
		}
		return $value;
	}
	public function setValue($fieldValue)
	{
		switch( $this->get('data_type'))
		{
			case Cms_Model_StructureField::TEXT_FIELD:
				$this->set('data_type', Cms_Model_StructureField::TEXT_FIELD);
				$this->set('str_value', $fieldValue);
				break;
			case Cms_Model_StructureField::TEXT_AREA:
				$this->set('data_type', Cms_Model_StructureField::TEXT_AREA);
				$this->set('text_value', $fieldValue);
				break;
			case Cms_Model_StructureField::RICH_TEXT_FIELD:
				$this->set('data_type', Cms_Model_StructureField::RICH_TEXT_FIELD);
				$str = str_replace('&nbsp;', '', $fieldValue);
				$this->set('text_value', $str);
				break;
			case Cms_Model_StructureField::IMAGE_FIELD:
				$this->set('data_type', Cms_Model_StructureField::IMAGE_FIELD);
				$this->set('foreign_model', 'Cms_Model_Image');
				$this->set('foreign_id', $fieldValue);
				break;
			case Cms_Model_StructureField::IMAGE_COLLECTION_FIELD:
				$this->set('data_type', Cms_Model_StructureField::IMAGE_COLLECTION_FIELD);
				$this->set('foreign_model', 'Cms_Model_ImageCollection');
				$this->set('foreign_id', $fieldValue);
				break;
			case Cms_Model_StructureField::DATA_COLLECTION_FIELD:
				$this->set('data_type', Cms_Model_StructureField::DATA_COLLECTION_FIELD);
				$this->set('foreign_model', 'Cms_Model_DataCollection');
				$this->set('foreign_id', $fieldValue);
				break;
			case Cms_Model_StructureField::CHECKBOX_FIELD:
				$this->set('data_type', Cms_Model_StructureField::CHECKBOX_FIELD);
				$this->set('int_value', $fieldValue);
				break;
			case Cms_Model_StructureField::LINK_FIELD:
				
				$this->setUpdateFields( array('str_value', 'foreign_id', 'foreign_model'));	// forzar actualizar estos campos
				
				$this->set('data_type', Cms_Model_StructureField::LINK_FIELD);
				$this->set('foreign_id', $fieldValue);
				$this->set('foreign_model', 'Cms_Model_Page');
				break;
			case Cms_Model_StructureField::DROPDOWN_FIELD:
				$this->set('data_type', Cms_Model_StructureField::DROPDOWN_FIELD);
				$this->set('str_value', $fieldValue);
				break;
			case Cms_Model_StructureField::GMAP_FIELD:
				$this->set('data_type', Cms_Model_StructureField::GMAP_FIELD);
				$this->set('foreign_model', 'Cms_Model_Map');
				$this->set('foreign_id', $fieldValue);
				break;
			case Cms_Model_StructureField::DATE_FIELD:
				$this->set('data_type', Cms_Model_StructureField::DATE_FIELD);
				
				$this->set('date_value', $fieldValue);
				break;
			default:
				trigger_error( "El tipo de dato para este modelo no se ha definido : Cms_Model_Data", E_USER_ERROR);
				return;
				break;
		}
	}
	
	public function getModelForFieldId( $field_id)
	{
		// obtene el dato correspondiente al Mode_StructureField::ID que se envie
		// genera un array con [structure_field_id => Model_Datas]
		if(!$this->isCollection())
		{
			// NO  se ha generado el query
			return null;
		}
		
		// SI YA SE REALIZO LA ESTRUCTURA DE DATOS EN ARRAY
		if(! $this->_arrayModelStructureDone)
		{
			$this->_arrayModelStructureDone = true;
			foreach($this as $data)
			{
				$this->_arrayModelStructure[$data->get('structure_field_id')] = $data;
			}
		}
		
		if(isset($this->_arrayModelStructure[$field_id]))
		{
			return $this->_arrayModelStructure[$field_id];
		}
		return null;
	}
}


?>
