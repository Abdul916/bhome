<?php

/**
* 
*/
class Cms_Controller_PageStructure extends Core_App_Controller_Controller
{
	function index( $req)
	{
		$res = new Core_Base_Response( $this);
		return $res;
	}
	public function save( $req)
	{
		$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
		$structure->loadArray( $req->getPost());
		$structure->set('created_at', Core_Base_Date::getDateTime());
		$structure->set('site_id', $req->post('site_id'));
		$structure->insert();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('structure', $structure);
		return $res;
	}
	function detail( $req)
	{
		$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$site->find( $req->get('site_id'));
		
		$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
		$structure->find($req->get('id'));
		
		$fields = $structure->getFields();
		
		$field = new Cms_Model_StructureField( Cms_Cms::getDbConnection());
		$field->setDirty();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('structure', $structure);
		$res->addVar('fields', $fields);
		$res->addVar('site', $site);
		$res->addVar('fieldtemplate', $field);
		return $res;
	}
	public function updateTemplate( $req)
	{
		$structure = new Cms_Model_PageStructure( Cms_Cms::getDbConnection());
		$structure->find($req->post('page_structure_id'));
		$structure->updateFields( array('template_html_path' => $req->post('template_html_path')));
		
		$res = new Core_Base_Response( $this);
		return $res;
	}
	
	public function saveorder( $req)
	{
		/*
		1. Identificar el padre
		*/
		$list = $req->post('field_list');
		
		
		$total = count($list);
		//$list = array_reverse( $list);
		
		
		for($i = 0; $i < ($total - 1); $i++)
		{
			if(is_numeric($list[$i]))
			{
				$page = new Cms_Model_StructureField( Cms_Cms::getDbConnection());
				$page->loadId($list[$i]);
				
				$page->updateFields(array('orden' => $i));
			}
		}
		
		$res = new Core_Base_Response( $this);
		return $res;
	}
}


?>