<?php

/**
* Controlador de colecciones de imagenes
*/
class Cms_Controller_ImageCollection extends Core_App_Controller_Controller
{
	function jximagecollection( $req)
	{
		$icollec = new Cms_Model_ImageCollection( Cms_Cms::getDbConnection());
		$icollec->find( $req->get('id'));
		$images = $icollec->getImages();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('images', $images);
		$res->addVar('icollec', $icollec);
		$res->addVar('site_id', $req->get('site_id'));
		return $res;
	}
	public function popgaleries( $req)
	{
		$imgcoll = new Cms_Model_ImageCollection( Cms_Cms::getDbConnection());
		$imgcoll->select()->runSelect();
		
		$page = new Cms_Model_Page( Cms_Cms::getDbConnection());
		$page->find($req->get('page_id'));
		
		$data_id = $req->get('data_id');
		
		$res = new Core_Base_Response( $this);
		$res->addVar('imagecollections' , $imgcoll);
		$res->addVar('page' , $page);
		$res->addVar('data_id' , $data_id);
		$res->addVar('field' , $req->get('field'));
		return $res;
	}
	public function js_saveOrder( $req)
	{
		$neworder = $req->post('datos_json');
		$neworder = stripslashes($neworder);
		$neworder = json_decode($neworder);
		
		
		foreach($neworder as $index => $id)
		{
			$img = new Cms_Model_Image( Cms_Cms::getDbConnection());
			$img->loadId( $id);
			$arr = array();
			$arr['orden'] = $index;
			echo 'set'. $index. ' for ' . $id . "\n";
			var_dump($arr);
			echo "\n";
			
			$img->updateFields( $arr);
		}
		
		$res = new Core_Base_Response( $this);
		return $res;
	}
}


?>