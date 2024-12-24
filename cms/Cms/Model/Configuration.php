<?php
/**
* 
*/
class Cms_Model_Configuration extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('site_configurations');
		$this->setFields( array('id', 'site_id', 'option_name', 'option_value', 'option_key', 'group', 'order', 'status', 'created_at', 'updated_at'));
		$this->setUpdateFields( array('option_value'));
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
}

?>