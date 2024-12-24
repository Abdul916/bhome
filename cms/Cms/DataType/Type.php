<?php
/**
* 
*/
abstract class Cms_DataType_Type 
{
	private $_dataTypeModel;
	private $_isModel;
	private $_ownerPage;
	private $_model;
	
	public function createData();
	public function updateData();
	public function getData();
}

?>