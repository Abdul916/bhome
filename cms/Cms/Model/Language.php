<?php
/**
* 
*/
class Cms_Model_Language extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('site_languages');
		$this->setFields(array('id', 'site_id', 'name', 'code', 'created_at', 'updated_at'));
		
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function getByLangCode( $lang_code)
	{
		$this->select()->where('code ="'.$this->secureText(strtoupper($lang_code)).'"')->runSelect();
	}
}

?>