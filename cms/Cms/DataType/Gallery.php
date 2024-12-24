<?php
/**
* Modelo para manejo de datos
*/
class Cms_DataType_Gallery extends Cms_DataType_Type
{
	private $_dataTypeModel = 'Cms_Model_Gallery';
	private $_isModel = false;
	private $_ownerPage = false;
	
	function __construct( $owner_page)
	{
		$this->_ownerPage = $owner_page;
	}
	public function createData()
	{
		$imgcoll = new Cms_Model_ImageCollection( Cms_Cms::getDbConnection());
		$imgcoll->set('created_at', Core_Base_Date::getDateTime());
		$imgcoll->insert();
		return $imgcoll->getId();
	}
	public function updateData();
	public function getData();
}

?>