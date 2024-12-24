<?php
/**
* 
*/
class Cms_Model_PageSearch extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('site_pages_search');
		$this->setFields( array('id', 'page_id', 'page_name', 'descripcion', 'keywords', 'created_at', 'updated_at'));
		
		$this->setUpdateFields( array('keywords', 'page_name'));
		
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	
	public function search( $phrase)
	{
		$this->setFields( array('id', 'page_id', 'page_name', 'descripcion', 'keywords', 'created_at', 'updated_at', 'score'));
		$this->select('*, MATCH(keywords) AGAINST("'.$phrase.'") as score')->where('MATCH(keywords) AGAINST("'.$phrase.'")');
		$this->orderBy('score DESC');
		$this->runSelect();
	}
}

?>