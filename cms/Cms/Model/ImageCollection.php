<?php

/**
* Modelo de acceso a colecciones de imagenes
*/
class Cms_Model_ImageCollection extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('image_collections');
		$this->setFields( array('id', 'name', 'description', 'width', 'height', 'created_at', 'updated_at'));
		$this->setUpdateFields( array('name', 'description', 'width', 'height'));
		
		$this->setPointerTo('Cms_Model_Data', 'foreign_id');
		$this->setHasMany('Cms_Model_Image', 'image_collection_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function getPage()
	{
		$parentData = new Cms_Model_Data( Cms_Cms::getDbConnection());
		// echo 'search for ' . $this->get('id') . '<br>';
		$parentData->select()->where('foreign_id='.$this->get('id').' AND foreign_model="Cms_Model_ImageCollection"');
		$parentData->orderBy('id asc')->limit(1)->runSelect();
    $page = $parentData->getPage();
    // echo "\n:::::\n";
    // var_dump( $page);
		
		return $page;
	}
	public function getImages()
	{
		$images = $this->getChilds('Cms_Model_Image');
		$images->where('AND status = 1')->orderBy('orden')->runSelect();
		return $images;
	}
	public function getFirstImage()
	{
		$images = $this->getChilds('Cms_Model_Image');
		$images->where('AND status = 1')->orderBy('orden')->limit('1')->runSelect();
		return $images;
	}
	public function saveImage( $req)
	{
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$image->set('file_path', $req->post('file_path'));
		$image->set('file', $req->post('file'));
		$image->set('image_collection_id', $this->getId());
		
		$imagemax = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$imagemax->set('image_collection_id', $this->getId());
		$maxorder = $imagemax->getMaxOrder();
		
		$image->set('orden', $maxorder);
		$image->set('status', 1);
		$image->set('created_at', Core_Base_Date::getDateTime());
		$image->set('sys_thumbnail', $req->post('sys_thumbnail'));
		
		$image->insert();
		
		
		return $image;
	}
}


?>
