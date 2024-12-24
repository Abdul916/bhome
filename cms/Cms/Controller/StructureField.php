<?php

/**
* Controlador para campos de contenido
*/
class Cms_Controller_StructureField extends Core_App_Controller_Controller
{
	function save( $req)
	{
		$helperField = new Cms_Model_StructureField( Cms_Cms::getDbConnection());
		
		$sfield = new Cms_Model_StructureField( Cms_Cms::getDbConnection());
		$sfield->loadArray($req->getPost());
		
		$sfield->set('page_structure_id', $req->post('page_structure_id'));
		$sfield->set('status', 1);
		$sfield->set('created_at', Core_Base_Date::getDateTime());
		$sfield->set('orden', $helperField->getLastOrderForPageStructure( $req->post('page_structure_id')));
		$sfield->set('unique_key', Core_Base_String::plainString( $req->post('name')));
		$sfield->insert();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('structureField', $sfield);
		
		$nfield = new Cms_Model_StructureField( Cms_Cms::getDbConnection());
		$nfield->find($sfield->getId());
		
		$this->repairPagesStructure($nfield->get('page_structure_id'), $nfield);
		
		return $res;
	}
	private function repairPagesStructure( $page_structure_id, $new_field)
	{
		$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
		$structure->find($page_structure_id);
		error_log('' . $page_structure_id);
		/*
		1. Localizar todas las páginas que tengan el id de la estructura de datos que se modifico
		2. Crear un nuevo campo vacio que corresponda al tipo de campo que se ha creado
		*/
		if($structure->count() == 0)
		{
			return;
		}
		$pages = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$pages->select()->where('page_structure_id = ' . $structure->get('id'))->runSelect();
		
		$fieldType = $new_field->get('field_type');
		
		foreach($pages as $page)
		{
			// crear el campo
			error_log('Creando corrección para pagina: ' . $page->get('id'));
			error_log('page structure id: ' . $new_field->get('page_structure_id'));
			
			$data = new Cms_Model_Data( Cms_Cms::getDbConnection());
			$data->set('site_page_id', $page->get('id'));
			$data->set('created_at', Core_Base_Date::getDateTime());
			$data->set('structure_field_id', $new_field->get('id'));
			$data->setType($fieldType);
			$reqdata = '';
			
			if($new_field->get('field_type') == Cms_Model_StructureField::IMAGE_COLLECTION_FIELD)
			{
				$imgcoll = new Cms_Model_ImageCollection( Cms_Cms::getDbConnection());
				$imgcoll->set('created_at', Core_Base_Date::getDateTime());
				$imgcoll->insert();
				$reqdata = $imgcoll->getId();
			}
			if($new_field->get('field_type') == Cms_Model_StructureField::IMAGE_FIELD)
			{
				$imagemax = new Cms_Model_Image( Cms_Cms::getDbConnection());
				$maxorder = $imagemax->getMaxOrder();
				
				$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
				$image->set('file_path', '');
				$image->set('file', '');
				$image->set('image_collection_id', null);
				$image->set('orden', $maxorder);
				$image->set('status', 1);
				$image->set('created_at', Core_Base_Date::getDateTime());
				$image->insert();
				
				$reqdata = $image->getId();
			}else if($new_field->get('field_type') == Cms_Model_StructureField::DATA_COLLECTION_FIELD)
			{
				$dcoll = new Cms_Model_DataCollection( Cms_Cms::getDbConnection());
				$dcoll->set('collection_type' , 1);
				$dcoll->set('sites_id' , $page->get('site_id'));
				$dcoll->set('created_at' , Core_Base_Date::getDateTime());
				$dcoll->insert();
				
				$reqdata = $dcoll->getId();
			}else if($new_field->get('field_type') == Cms_Model_StructureField::CHECKBOX_FIELD)
			{
				$reqdata = 0;
				$data->setValue( 0);
			}else if($new_field->get('field_type') == Cms_Model_StructureField::GMAP_FIELD)
			{
				$map = new Cms_Model_Map( Cms_Cms::getDbConnection());
				$map->set('name' , '');
				$map->set('description' , '');
				//$map_center = Cms_Model_Map::PositionToPoint($req->post($field.'-map_center'));
				$map->set('center_point' , 'GeomFromText("20.427,-100.546")');
				$map->set('zoom' , 1);
				$map->set('map_options' , '');
				$map->set('created_at' , Core_Base_Date::getDateTime());
				$map->insert();
				
				$reqdata = $map->get('id'); // valor a guardar: ID del mapa
			}
			$data->setValue( $reqdata);
			$data->insert();
			
			error_log('Campo creado: ' . $data->getId());
		}
		
	}
}

?>