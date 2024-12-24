<?php

/**
* Modelo de imagenes
*/
class Cms_Model_Image extends Core_App_Model_Model2
{
  function setup()
  {
    $this->setTable('images');
    $this->setFields(array('id', 'file_path', 'file', 'orden', 'status', 'created_at', 'updated_at', 'image_collection_id', 'coded_properties', 'thumbnail', 'sys_thumbnail'));
    $this->setUpdateFields(array('file_path', 'file', 'orden', 'status', 'sys_thumbnail'));

    $this->setBelongsTo('Cms_Model_ImageCollection', 'image_collection_id');
  }
  public function newSelf(Core_Db_Db $dbConnection)
  {
    return new self($dbConnection);
  }
  function getMaxOrder()
  {
    if ( ! $this->get('image_collection_id') > 0) return 0;
    $this->setFields(array('file_path', 'file', 'orden', 'status', 'created_at', 'updated_at', 'image_collection_id', 'maxorden'));
    $this->select('max( orden ) as maxorden')->where('image_collection_id=' . $this->get('image_collection_id'))->runSelect();
    $max = $this->get('maxorden') + 1;
    return $max;
  }
  function serialized($key)
  {
    $serializedData = $this->get('coded_properties');
    if (strlen($serializedData) > 1) {
      $imgProperties = json_decode($serializedData);
    } else {
      $imgProperties = array();
    }

    return isset($imgProperties->$key) ? $imgProperties->$key : null;
  }
  public function createSystemImage()
  {
    $ruta = '../../' . $this->get('file_path');

    $filename = Core_Base_File::getFilename($ruta);
    $folder = '';

    if ($this->get('image_collection_id') == 0) {
      $folder = 'images/';
    } else {
      $folder = 'galerias/';
    }

    $rutasave = '../../../cache/' . $folder . $filename;
    $rutasavedb = 'cache/' . $folder . $filename;
    error_log('cargar imagen: ' . $ruta);
    echo $ruta;
    WideImage::load($ruta)->resize(100, 150)->crop('center', 'center', 90, 68)->saveToFile($rutasave);

    $this->updateFields(array('sys_thumbnail' => $rutasavedb));
  }
}
 