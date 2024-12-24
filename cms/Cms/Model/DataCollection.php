<?php

/**
* 
*/
class Cms_Model_DataCollection extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('data_collections');
		$this->setFields( array('id', 'name', 'collection_type', 'sites_id', 'created_at'));
		$this->setUpdateFields( array('id', 'name'));
		
		$this->setHasMany('Cms_Model_DynamicData', 'data_collection_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function addData( $req)
	{
		$data= new Cms_Model_DynamicData( Cms_Cms::getDbConnection());
		$data->set($req->post('label'));
	}
	public function getDynamicFields()
	{
		$childs = $this->getChilds('Cms_Model_DynamicData');
		$childs->runSelect();
		
		return $childs;
	}
	public function saveData()
	{
		if(isset($_POST['dcoll']))
		{
			$campos = $_POST['dcoll'];
			$valores = $_POST['dval'];
			
			for($i= 0; $i < count($campos); $i++)
			{
				$ndata = new Cms_Model_DynamicData( Cms_Cms::getDbConnection());
				$ndata->set('label', $campos[$i]);
				$ndata->set('value', $valores[$i]);
				$ndata->set('site_page_id', $this->get('sites_id'));
				$ndata->set('data_collection_id', $this->getId());
				$ndata->set('created_at', Core_Base_Date::getDateTime());
				$ndata->insert();
			}
		}
	}
	public function updateData()
	{
		if(isset($_POST['dfield']))
		{
			$campos = $_POST['dfield'];
			$valores = $_POST['dvalue'];
			
			//for($i= 0; $i < count($campos); $i++)
			foreach($campos as $id => $label)
			{
				$ndata = new Cms_Model_DynamicData( Cms_Cms::getDbConnection());
				$ndata->find($id);
				if($ndata->count() > 0)
				{
					$ndata->set('label', $label);
					$ndata->set('value', $valores[$id]);
					$ndata->set('updated_at', Core_Base_Date::getDateTime());
					$ndata->update();
				}
				
			}
		}
		if(isset($_POST['dcoll']))
		{
			$this->saveData();
		}
	}
}


?>