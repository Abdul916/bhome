<?php

/**
* Controlador de imagenes
*/
class Cms_Controller_Image extends Core_App_Controller_Controller
{
	function delete($req)
	{
		# code...
	}
	function jxdelete( $req)
	{
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$image->find( $req->post('image_id'));
		$imgtodelete = $image->get('file_path');
		if(@is_file('../'.$imgtodelete))
		{
			@unlink('../'.$imgtodelete);
		}
		$image->delete( $req->post('image_id'));
		
		$res = new Core_Base_Response( $this);
		return $res;
	}
	public function jx_thumb_delete( $req)
	{
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$image->find( $req->post('image_id'));
		$imgtodelete = $image->get('thumbnail');
		
		if(@is_file('../'.$imgtodelete))
		{
			@unlink('../'.$imgtodelete);
		}
		$image->updateFields(array('thumbnail' => ''));
		
		$res = new Core_Base_Response( $this);
		return $res;
	}
	public function popimages( $req)
	{
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$image->select()->runSelect();
		$site_id = $req->get('site_id');
		
		$res = new Core_Base_Response( $this);
		$res->addVar('images', $image);
		$res->addVar('field', $req->get('field'));
		return $res;
	}
	public function popconfigure( $req)
	{
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
    $image->find( $req->get('image_id'));
    // print_r($image);
		$site_id = $req->get('site_id');
		
		$res = new Core_Base_Response( $this);
		$res->addVar('imagen', $image);
		$res->addVar('site_id', $site_id);
		return $res;
	}
	public function updateconfig( $req)
	{
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$image->find($req->post('image_id'));
		
    // $serializedData = $image->get('coded_properties');
    // echo '<p>var:</p>';
    // var_dump($serializedData);
		
		// if(strlen($serializedData) > 10)
		// {
		// 	$imgProperties = json_decode($serializedData);
		// }else{
		// 	$imgProperties = json_encode(array('image_link' => null, 'image_name' => null, 'image_description' => null));
    // }
    // echo '<p>decode:</p>';
    // var_dump($serializedData);
    $imgProperties = array();
		$imgProperties['image_link'] = $req->post('image_url');
		$imgProperties['image_name'] = ($req->post('image_name'));
    $imgProperties['image_description'] = str_replace('"', '&quot;', $req->post('image_description'));
    // print_r($imgProperties);
    
    $json = json_encode($imgProperties, JSON_UNESCAPED_UNICODE);
    // var_dump($json);
		
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$image->loadId($req->post('image_id'));
		$data= array('coded_properties' => $json);
		$image->updateFields($data);
		
		$res = new Core_Base_Response( $this);
		$res->addVar('image', $image);
		return $res;
	}
	public function uploadThumbnail( $req)
	{
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$image->find( $req->post('image_id'));
		$site_id = $req->post('site_id');
		
		$uploadpath = Cms_Cms::getConfig($site_id, 'gallerys_upload_path');
		$newname = basename($_FILES['thumbnail']['name']);
		$justname = Core_Base_File::getFileNameNoExtension($newname);
		$extension = Core_Base_File::getFileExtension($newname);
		$FileCounter = 1;

		// loop until an available filename is found
		while (file_exists( '../'.$uploadpath.$newname ))
		{
			$newname = $justname.'_'.$FileCounter.'.'.$extension;
			//error_log($uploadpath.$newname);
			$FileCounter++;
		}
		
		$newname = Core_Base_File::getFileNameNoExtension($newname);
		$fileupload = Core_Base_File::upload('thumbnail', '../'.$uploadpath, $newname);
		
		error_log('FINAL PATH: '. '../'.$uploadpath.$newname);
		
		if($fileupload)
		{
			$image->updateFields( array('thumbnail' => $uploadpath.$newname.'.'.$extension));
		}
		$image = new Cms_Model_Image( Cms_Cms::getDbConnection());
		$image->find( $req->post('image_id'));
		$res = new Core_Base_Response( $this);
		$res->addVar('image', $image);
		return $res;
	}
}


?>
