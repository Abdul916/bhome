<?php
/**
* DataType para campos de página, TIPO LINK
*/
class Cms_DataType_GMap
{
	protected $modelData;
	protected $page;
	protected $data;
	
	function __construct(Cms_Model_Data $data)
	{
		$this->modelData = $data;
		$model = $modelData->get('foreign_model');
		$value = new $model( Cms_Cms::getDbConnection());
		$value->find($data->get('foreign_id'));
		$this->page = $value;
	}
	function getMapData()
	{
		
	}
	
}

?>