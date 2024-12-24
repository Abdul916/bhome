<?php

/**
* 
*/
class Cms_Model_DynamicData extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('dynamic_datas');
		$this->setFields( array('id', 'name', 'label', 'value', 'site_page_id', 'data_collection_id', 'created_at', 'updated_at'));
		$this->setUpdateFields( array('name', 'label', 'value', 'site_page_id', 'data_collection_id'));
		
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
}


?>