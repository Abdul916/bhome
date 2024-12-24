<?php

/**
* Mdelo de acceso a datos externos
*/
class Cms_Model_ExternalData extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('external_datas');
		$this->setFields( array('id', 'relation_owner_id', 'relation_owner', 'foreign_id', 'foreign_model', 'action_module', 'created_at', 'updated_at'));
		$this->setUpdateFields( array());
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
}


?>