<?php

/**
*
*/
class Cms_Model_Page extends Core_App_Model_Model2
{
	protected $pathArray;
	function setup()
	{
		$this->setTable('site_pages');
		$this->setFields( array('id', 'page_structure_id', 'site_section_id', 'publish_status', 'status',
		'publish_date', 'created_at', 'updated_at', 'name', 'orden', 'parent_page_id', 'name_code', 'index_status',
		'site_id', 'lang_main_page_id', 'lang_code', 'site_language_id', 'meta_description', 'meta_keywords', 'short_url'));

		$this->setUpdateFields( array('publish_date', 'name', 'parent_page_id', 'name_code', 'meta_description', 'meta_keywords'));

		$this->setPointerTo( 'Cms_Model_Page', 'parent_page_id');
		$this->setBelongsTo( 'Cms_Model_Section', 'site_section_id');
		$this->setPointerTo( 'Cms_Model_Section', 'site_section_id');
		$this->setPointerTo( 'Cms_Model_PageStructure', 'page_structure_id');
		$this->setHasMany('Cms_Model_Data', 'site_page_id');
		$this->setHasMany('Cms_Model_Page', 'parent_page_id');
		$this->setHasOne('Cms_Model_MenuItem' , 'content_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}

	public function updateMenuItem()
	{
		// actualizar el menuItem asignado a esta pagina con la informacion del modelo
		$mitem = $this->getMenuItem();
		$dat = array();
		$dat['code_name'] = $this->get('name_code');
		$dat['title'] = $this->get('name');
		$dat['publish_status'] = $this->get('publish_status');
		if($this->get('parent_page_id') != 0)
		{
			// su padre es una pagina
			//echo 'su padre es una página';
			$dat['parent_id'] = $this->get('parent_page_id');
			$dat['parent_type'] = Cms_Model_MenuItem::PARENT_PAGE;
		}else{
			// su padre es una seccion

			$dat['parent_id'] = $this->get('site_section_id');
			$dat['parent_type'] = Cms_Model_MenuItem::PARENT_SECTION;
		}

		$mitem->updateFields($dat);
		//print_r($mitem);
		return;
	}
	public function getMenuItem()
	{
		$menuitem = $this->getChild('Cms_Model_MenuItem')->where(' AND content_type= "'.Cms_Model_MenuItem::PAGE.'"');
		$menuitem->runSelect();
		return $menuitem;
	}
	public function getData()
	{
		$childs = $this->getChilds('Cms_Model_Data');
    $childs->runSelect();
    // print_r($childs);
		return $childs;
  }
  public function hasParentPage()
  {
    return $this->get('parent_page_id') > 0 ? true : false;
  }
	public function getParentPage()
	{
    if( ! $this->hasParentPage()) return null;
		$parent = $this->getPointed('Cms_Model_Page');
    $parent->runSelect();
		return $parent;
	}
	public function getPagesNoIndex()
	{
		$pages = $this->getChilds('Cms_Model_Page')->where(' AND index_status <> 1')->orderBy('orden ASC');
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
		$structure = $this->getPointed('Cms_Model_PageStructure');
		$structure->runSelect();
		return $structure;
	}
	public function getTotal($total_selection)
	{
		$this->setFields( array('total_records'));
		$this->select($total_selection.' AS total_records');
		return $this;
	}
	public function saveData( $req)
	{
		// Se encarga de guardar los dato de la página en DB
		$section = $this->getParent('Cms_Model_Section');
		$section->runSelect();
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find($req->post('site_id'));

		$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
		$structure->find( $this->get('page_structure_id'));

		$fields = $structure->getFields();

		foreach($fields as $field)
		{
			$fieldType = $field->get('field_type');

			$reqdata = $req->post( $field->get('unique_key'));

			$data = new Cms_Model_Data( Cms_Cms::getDbConnection());
			$data->set('site_page_id', $this->getId());
			$data->set('structure_field_id', $field->get('id'));
			$data->setType($fieldType);

			if($fieldType == Cms_Model_StructureField::IMAGE_COLLECTION_FIELD)
			{
				$imgcoll = new Cms_Model_ImageCollection( Cms_Cms::getDbConnection());
				$imgcoll->set('created_at', Core_Base_Date::getDateTime());
				$imgcoll->insert();
				$reqdata = $imgcoll->getId();
			}
			if($fieldType == Cms_Model_StructureField::IMAGE_FIELD)
			{
				error_log('UPLOADING PHOTO');
				// If image was uploaded
				if( isset($_FILES[$field->get('unique_key')]) 
					&& !empty($_FILES[$field->get('unique_key')]) 
					&& $_FILES[$field->get('unique_key')]['error'] == UPLOAD_ERR_OK)
				{
					$uploadpath = Cms_Cms::getConfig($site->get('id'), 'images_upload_path');

					Log_Log::save(Cms_Cms::getDbConnection(), 'UPLOADING PATH: '.$uploadpath. ' SITE ID: '.$site->get('id'));

					$newname = basename($_FILES[$field->get('unique_key')]['name']);

					$justname = Core_Base_File::getFileNameNoExtension($newname);
					$extension = Core_Base_File::getFileExtension($newname);
					$FileCounter = 1;
					Log_Log::save(Cms_Cms::getDbConnection(), 'UP '. print_r($_FILES[$field->get('unique_key')], true));
					Log_Log::save(Cms_Cms::getDbConnection(), 'UP '. $_FILES[$field->get('unique_key')]['name']. ' jn: ' . $justname . ' ext: '. $extension);

					// loop until an available filename is found
					while (file_exists( '../'.$uploadpath.$newname ))
					{
						$newname = $justname.'_'.$FileCounter.'.'.$extension;
						//error_log($uploadpath.$newname);
						$FileCounter++;
					}

					Log_Log::save(Cms_Cms::getDbConnection(), 'Upload new image '.$field->get('unique_key'). ' '. $newname);

					$newname = Core_Base_File::getFileNameNoExtension($newname);
					$fileupload = Core_Base_File::upload($field->get('unique_key'), '../'.$uploadpath, $newname);
					$image = new Cms_Model_Image(Cms_Cms::getDbConnection());

					if(is_file('../'.$uploadpath.$newname.'.'.$extension))
					{
						if ($extension != 'svg')
						{
						WideImage::load('../' . $uploadpath . $newname . '.' . $extension)->resize(100, 150)->crop('center', 'center', 90, 67)->saveToFile('cache/images/' . $newname . '.' . $extension);
						$image->set('sys_thumbnail', 'cache/images/' . $newname . '.' . $extension);
						}
						
					}
					

					
					$uploadpath2 = str_replace('../', '', $uploadpath);
					$image->set('file_path', $uploadpath.$newname.'.'.$extension);
					$image->set('file', $_FILES[$field->get('unique_key')]['name']);
					$image->set('image_collection_id', null);
					$image->set('orden', 0);
					$image->set('status', 1);
					$image->set('created_at', Core_Base_Date::getDateTime());
					

					$image->insert();
					error_log('Imagen vía upload', 0);
					$reqdata = $image->getId();
				}else{

					if($req->post($field->get('unique_key').'-auto'))
					{
						error_log('Imagen de galeria', 0);
						$reqdata = $req->post($field->get('unique_key').'-auto');
					}else{
						error_log('Imagen vacia', 0);
						$reqdata = 0;
						$uploadpath = '';
						$newname = '';
						$extension = '';
						$imagemax = new Cms_Model_Image( Cms_Cms::getDbConnection());
						$maxorder = $imagemax->getMaxOrder();

						$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
						$uploadpath2 = str_replace('../', '', $uploadpath);
						$image->set('file_path', $uploadpath.$newname.'.'.$extension);
						$image->set('file', '');
						$image->set('image_collection_id', null);
						$image->set('orden', $maxorder);
						$image->set('status', 1);
						$image->set('created_at', Core_Base_Date::getDateTime());
						$image->set('sys_thumbnail', '');

						$image->insert();
						$reqdata = $image->getId();
					}

				}

			}else if($fieldType == Cms_Model_StructureField::DATA_COLLECTION_FIELD)
			{
				$dcoll = $this->newDatacollection( $req);
				$reqdata = $dcoll->getId();
			}else if($fieldType == Cms_Model_StructureField::CHECKBOX_FIELD)
			{
				$val1 = $req->post($field->get('id'));
				$val = 0;

				if($val1)
				{
					$val = 1;
				}
				$data->setValue( $val);
			}else if($fieldType == Cms_Model_StructureField::GMAP_FIELD)
			{
				$map = $this->newMap( $req, $field->get('unique_key'));
				$reqdata = $map->get('id'); // valor a guardar: ID del mapa
			}
			$data->setValue( $reqdata);
			$data->insert();
		}
	}

	public function updateData( $req)
	{
		$section = $this->getPointed('Cms_Model_Section');
		$section->runSelect();

		$site = $section->getSite();

		if($this->get('page_structure_id') == 0)
		{
			$fields = $section->getStructure()->getFields();
		}else
		{
			$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
			$structure->find($this->get('page_structure_id'));
			$fields = $structure->getFields();
		}

		$pageFields = $req->post('field');
		$pageData = $this->getData();

		foreach($fields as $field)
		{
			$dataModel = $pageData->getModelForFieldId($field->get('id'));
			if($dataModel)
			{
				$fieldType = $field->get('field_type');
				if($fieldType == Cms_Model_StructureField::LINK_FIELD)
				{
					// el modelo existe
					/*
					$fieldtitle = 'field-title';

					$titulo = $req->post( $fieldtitle[$field->get('id')]);
					$dataModel->set('str_value', $titulo);
					$dataModel->setValue( $req->post( $field->get('unique_key')));	// include el ID
					$vl = array();
					$vl['str_value'] = $titulo;
					error_log("title value : " .  $titulo);
					$dataModel->update();*/
				}
				if( isset($pageFields[$field->get('id')]) && $fieldType != Cms_Model_StructureField::IMAGE_FIELD)
				{
					//echo "el campo existe, guardarlo";
					$dataModel->setValue($pageFields[$field->get('id')]);
					$dataModel->update();
				}
				if($fieldType == Cms_Model_StructureField::IMAGE_FIELD && $_FILES[$field->get('unique_key')]['error'] == 4)
				{
					
					// si no intenta subir ninguna imagen
					error_log('updating without upload');
					$autoimage = intval( $req->post($field->get('unique_key').'-auto'));
					
					
					if(is_numeric($autoimage) && isset($_POST[$field->get('unique_key').'-auto']))
					{
						
						// viene una imagen seleccionada externamente, ignorar
						if($autoimage != 0)
						{
							$arr = array();
							$arr['foreign_model'] ='Cms_Model_Image';
							$arr['foreign_id'] = $autoimage;
							// var_dump($arr);
							$dataModel->updateFields($arr);
						}else{
							// crear una nueva imagen vacia
							$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
							$image->set('created_at', Core_Base_Date::getDateTime());
							$image->insert();
							$arr = array();
							$arr['foreign_model'] ='Cms_Model_Image';
							$arr['foreign_id'] = $image->getId();
							// var_dump($arr);

							$dataModel->updateFields($arr);
						}

					}else{
						// if($field->get('unique_key') == 'imagen-de-archivo')
						// {var_dump('2'); exit;}
						
					}
				}
				if($fieldType == Cms_Model_StructureField::IMAGE_FIELD && $_FILES[$field->get('unique_key')]['error'] == 0)
				{
					if(!$dataModel->get('foreign_id'))
					{
						//error_log(':: No tiene foreign_id');
						$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
						$image->set('created_at', Core_Base_Date::getDateTime());
						$image->insert();

						$cm = new Cms_Model_Data( Cms_Cms::getDbConnection());
						$cm->loadId($dataModel->get('id'));

						$d= array();
						$d['foreign_model'] = 'Cms_Model_Image';
						$d['foreign_id'] = $image->getId();
						$cm->updateFields($d);

						$dataModel->set('foreign_model', 'Cms_Model_Image');
						$dataModel->set('foreign_id', $d['foreign_id']);
					}
					$uploadpath = Cms_Cms::getConfig( $site->get('id'), 'images_upload_path');
					$newname = Core_Base_String::randomString(10);
					$newname = basename($_FILES[$field->get('unique_key')]['name']);
					$justname = Core_Base_File::getFileNameNoExtension($newname);
					$ext = $extension = Core_Base_File::getFileExtension($newname);
					$filename = $_FILES[$field->get('unique_key')]['name'];

					// rename file if it already exists by prefixing an incrementing number
					$FileCounter = 1;

					// loop until an available filename is found
					//error_log($uploadpath.$newname);
					while (file_exists( '../'.$uploadpath.$newname ))
					{
						$newname = $justname.'_'.$FileCounter.'.'.$extension;
						//error_log($uploadpath.$newname);
						$FileCounter++;
					}

					$newname = Core_Base_File::getFileNameNoExtension( $newname);

					$fileupload = Core_Base_File::upload( $field->get('unique_key'), '../'.$uploadpath, $newname);
					$ext = Core_Base_File::getFileExtension( $_FILES[$field->get('unique_key')]['name']);
					$foreing_id = $dataModel->get('foreign_id');

					$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
					$image->find($foreing_id);
					//echo 'TEST';
					if($image->count() > 0)
					{
						$uploadpath2 = str_replace('../', '', $uploadpath);
						if ($ext != 'svg') {
						WideImage::load('../' . $uploadpath . $newname . '.' . $ext)->resize(100, 150)->crop('center', 'center', 90, 67)->saveToFile('cache/images/' . $newname . '.' . $extension);
						$image->set('sys_thumbnail', 'cache/images/' . $newname . '.' . $extension);
						}else{
							$image->set('sys_thumbnail', '../'.$uploadpath2 . $newname . '.' . $extension);
						}


					
					$image->set('file_path', $uploadpath2 . $newname . '.' . $extension);
					$image->set('file', $_FILES[$field->get('unique_key')]['name']);
					$image->update();
					}else{
						// el modelo de la imagen no existe
						if($_FILES[$field->get('unique_key')]['error'] == 0)
						{
							$uploadpath2 = str_replace('../', '', $uploadpath);
							$newname = Core_Base_String::randomString(10);
							$newname = basename($_FILES[$field->get('unique_key')]['name']);
							$field->get('unique_key');
							$ext = Core_Base_File::getFileExtension( $_FILES[$field->get('unique_key')]['name']);

							$FileCounter = 1;
							//echo '3 ';
							// loop until an available filename is found
							//error_log($uploadpath.$newname);
							$newname = Core_Base_File::getFileNameNoExtension( $newname);
							while (file_exists( '../'.$uploadpath.$newname ))
							{
								$newname = $justname.'_'.$FileCounter.'.'.$extension;
								//error_log($uploadpath.$newname);
								$FileCounter++;
							}
							$newname = Core_Base_File::getFileNameNoExtension( $newname);

							$fileupload = Core_Base_File::upload( $field->get('unique_key'), $uploadpath, $newname);

							if ($ext != 'svg') {
								WideImage::load('../' . $uploadpath . $newname . '.' . $ext)
									->resize(100, 150)
									->crop('center', 'center', 90, 67)
									->saveToFile('cache/images/' . $newname . '.' . $ext);
							}

								$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
								$image->set('file_path', $uploadpath2.$newname);
								$image->set('file', $_FILES[$field->get('unique_key')]['name']);
								$image->set('image_collection_id', null);
								$imagemax = new Cms_Model_Image( Cms_Cms::getDbConnection());
								$maxorder = $imagemax->getMaxOrder();
								$image->set('orden', $maxorder);
								$image->set('status', 1);
								$image->set('created_at', Core_Base_Date::getDateTime());

								$image->insert();

								$reqdata = $image->getId();
								//$dataModel->set('foreign_id', $reqdata);
								$dataModel->updateFields(array('foreign_id' => $reqdata));
						}

					}

				}
				if($fieldType == Cms_Model_StructureField::DATA_COLLECTION_FIELD)
				{
					// obtener el objeto y hacer la actualización
					$dcollection = new Cms_Model_DataCollection( Cms_Cms::getDbConnection());
					$dcollection->find($dataModel->get('foreign_id'));
					$dcollection->updateData();
				}
				if($fieldType == Cms_Model_StructureField::CHECKBOX_FIELD)
				{
					$val1 = isset($pageFields[$field->get('id')]) ? 1 : 0;
					$val = 0;

					$dataModel->setValue( $val1);
					$dataModel->update();
				}
				if($fieldType == Cms_Model_StructureField::LINK_FIELD)
				{
					// el modelo no existe

					$dataModel->set('str_value' , $req->post('field-'.$field->get('id').'-title'));
					$dataModel->setValue( $pageFields[$field->get('id')]);	// include el ID
					$dataModel->update();
				}
				if($fieldType == Cms_Model_StructureField::DROPDOWN_FIELD)
				{
					//error_log('update dropfield: '.$pageFields[$field->get('id')]);
					$dataModel->setValue( $pageFields[$field->get('id')]);
					$dataModel->update();
				}else if($fieldType == Cms_Model_StructureField::GMAP_FIELD)
				{
					// actualización del gmap
					$field = 'field-'.$field->get('id');
					error_log(':::  '.$field);
					$map = new Cms_Model_Map( Cms_Cms::getDbConnection());

					if(is_numeric($dataModel->get('foreign_id')))
					{
						$map->find( $dataModel->get('foreign_id'));
						$map_center = Cms_Model_Map::PositionToPoint($req->post($field.'-map_center'));
						$arr['center_point'] = 'GeomFromText("'.$map_center.'")';
						$arr['zoom'] = $req->post($field.'-map_zoom');
						$arr['updated_at'] = Core_Base_Date::getDateTime();
						$map->updateFields( $arr);
						error_log('guardar markers nuevos');
						error_log( print_r( $req->post($field.'-map-pin'), true));
						error_log('----');
						$map->saveMarkers( $req->post($field.'-map-pin'));		// guardar nuevos markers
						$map->updateMarkers( $req->post($field.'-up-map-pin'));	// actualizar los markers existentes
					}else{
						// Actualizacion del mapa, el mapa no existe crearlo
						$map = $this->newMap( $req, $field->get('unique_key'));
						$reqdata = $map->get('id'); // valor a guardar: ID del mapa

						$data = new Cms_Model_Data( Cms_Cms::getDbConnection());
						$data->set('site_page_id', $this->getId());
						$data->set('structure_field_id', $field->get('id'));
						$data->setType(Cms_Model_StructureField::GMAP_FIELD);
						$data->setValue( $foreing_id);
						$data->insert();
					}


					//$dataModel->update();
					//$this->updateMap( $req, $field->get('unique_key'));
				}
				//error_log("existed" , 0);
			}else{
				// el modelo no existe
				//echo " modelo que no existe: ".$field->get('id')." =  ".$field->get('name').'<br>';
				//print_r($dataModel);
				$foreing_id = null;
				//error_log("el modelo no existe" , 0);
				$fieldType = $field->get('field_type');

				$data = new Cms_Model_Data( Cms_Cms::getDbConnection());
				$data->set('site_page_id', $this->getId());
				$data->set('structure_field_id', $field->get('id'));
				$data->setType($fieldType);

				if( isset($pageFields[$field->get('id')]))
					$data->setValue($pageFields[$field->get('id')]);

				if($fieldType == Cms_Model_StructureField::DATA_COLLECTION_FIELD)
				{
					//error_log("tipo DATA_COLLECTION" , 0);
					$dcoll = $this->newDataCollection( $req);
					$foreing_id = $dcoll->getId();
					$data->setType($fieldType);
					$data->setValue( $foreing_id);
				}
				if($fieldType == Cms_Model_StructureField::IMAGE_FIELD)
				{
					$autoimage = $req->post($field->get('unique_key').'-auto');
					if($autoimage)
					{
						// viene una imagen seleccionada externamente, ignorar
						$imagen_id = $autoimage;
					}else
					{
						$uploadpath = Cms_Cms::getConfig($site->get('id'), 'images_upload_path');
						$newname = Core_Base_String::randomString(10);

						$fileupload = Core_Base_File::upload( $field->get('unique_key'), $uploadpath, null);

						$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
						$uploadpath2 = str_replace('../', '', $uploadpath);
						$image->set('file_path', $uploadpath2.$_FILES[$field->get('unique_key')]['name']);
						$image->set('file', $_FILES[$field->get('unique_key')]['name']);
						$image->set('image_collection_id', null);
						$imagemax = new Cms_Model_Image( Cms_Cms::getDbConnection());
						$maxorder = $imagemax->getMaxOrder();
						$image->set('orden', $maxorder);
						$image->set('status', 1);
						$image->set('created_at', Core_Base_Date::getDateTime());
						$image->insert();
						$imagen_id = $image->getId();
					}


					$data->setType($fieldType);
					$data->setValue( $imagen_id);
				}
				if($fieldType == Cms_Model_StructureField::CHECKBOX_FIELD)
				{
					$val1 = $req->post($field->get('id'));
					$val = 0;

					if($val1)
					{
						$val = 1;
					}
					$data->setValue( $val);
				}
				if($fieldType == Cms_Model_StructureField::LINK_FIELD)
				{
					// el modelo no existe
					$titulo = $req->post( $field->get('unique_key').'-title');
					$data->set('str_value', $titulo);
					$data->setValue( $req->post( $field->get('unique_key')));	// include el ID
				}
				if($fieldType == Cms_Model_StructureField::GMAP_FIELD)
				{
					// insert - nuevo gmap
					$map = $this->newMap( $req, $field->get('unique_key'));
					$foreing_id = $map->get('id'); // valor a guardar: ID del mapa
					$data->setType($fieldType);
					$data->setValue( $foreing_id);
				}
				$data->insert();
			}
		}
		return;
	}
	public function saveDinamicFields( $dataCollectionModel)
	{
		$model = $dataCollectionModel;
		$model->saveData();
	}

	public function getSection()
	{
		$section = $this->getPointed('Cms_Model_Section');
		$section->runSelect();
		return $section;
	}
	public function hasChilds()
	{
		$childs = $this->getChilds('Cms_Model_Page')->orderBy('orden ASC');
		$childs->runSelect();

		if($childs->isCollection() )
		{
			return true;
		}
		return false;
	}
	private function updateMap( $req, $field)
	{
		$map = new Cms_Model_Map( Cms_Cms::getDbConnection());
		error_log('Actualizar: ' . $field);
		$map->loadId($req->post($field));
		$arr = array();

		error_log( print_r($map, true), 0);
		return $map;
	}
	private function newMap( $req, $field)
	{
		$map = new Cms_Model_Map( Cms_Cms::getDbConnection());
		$map->set('name' , '');
		$map->set('description' , '');
		$map_center = Cms_Model_Map::PositionToPoint($req->post($field.'-map_center'));
		$map->set('center_point' , 'GeomFromText("'.$map_center.'")');
		$map->set('zoom' , $req->post($field.'-map_zoom'));
		$map->set('map_options' , '');
		$map->set('created_at' , Core_Base_Date::getDateTime());
		$map->insert();
		//error_log(print_r($map, true), 0);
		error_log(' Mandar a guardar los markers ', 0);
		$map->saveMarkers( $field.'-pin');

		return $map;
	}
	private function newDataCollection( $req)
	{
		$dcoll = new Cms_Model_DataCollection( Cms_Cms::getDbConnection());
		$dcoll->set('collection_type' , 1);
		$dcoll->set('sites_id' , $this->getId());
		$dcoll->set('created_at' , Core_Base_Date::getDateTime());
		$dcoll->insert();

		$dcoll->saveData();

		return $dcoll;
	}
	private function pageModelHasParent( Cms_Model_Page $page)
	{
    if( $this->hasParentPage())
    {
      return $page->getParentPage();
		//echo $parent->count(). " para ". $parent->get('name').' : '.$parent->getCurrentQuery()."<br>";
      if ($parent->count() > 0) {
        return $parent;
      }
    }
		
		return null;
	}
	public function getPath()
	{
		if(!is_array($this->pathArray))
			$this->pathArray = array();

    if( ! $this->hasParentPage())
      return array($this->getSection());

		$parent = $this;
		$i = 0;
		while( $parent)
		{

			$parent = $this->pageModelHasParent( $parent);
			if(!$parent)
			{
				break;
			}

			$this->pathArray[] = $parent;
			$parent = $parent;

			$i++;
		}

		$this->pathArray[]= $this->getSection();
		$this->pathArray = array_reverse($this->pathArray);
		return $this->pathArray;
	}

	// LANGUAGES
	public function getLanguageVersion($language)
	{
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->select()->where('site_language_id='.$language->get('id').' AND lang_main_page_id =' . $this->get('id'))->runSelect();
		return $page;
	}
	public function deletepage()
	{
		/*
		Las relaciones de una página son:
		1. MenuItem
		*/
		$menuItems = $this->getMenuItem();
		if($menuItems->count() > 0)
		{
			foreach($menuItems as $menuItem)
			{
				$menuItem->delete($menuItem->get('id'));
			}
		}
		$this->delete( $this->get('id'));
	}
}


?>
