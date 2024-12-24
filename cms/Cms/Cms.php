<?php

/**
* App Controller de la aplicación de Guestbook
*/
class Cms_Cms extends Core_App_Controller_AppController
{
	function setup()
	{
		$this->setSecurityDomain('CMS.ADMIN');
	}
	static function getDbConnection()
	{
		return Configuration::instance()->getDbConnection();
	}
	static function getConfig($site_id, $str)
	{
		// echo $site_id;
		// echo $str;
		// exit();
		$conf= array();
		$conf['administrator_url'] = 'admin/';
		
		$conf['images_upload_path'][1] = '../products/images/';
		$conf['images_upload_internal_path'][1] = 'products/images/';
		
		$conf['site_url'][2] = 'http://ica.in/index.php';
		$conf['media_path'][2] = '../media/';
		$conf['media_internal_path'][2] = 'media/';
		$conf['gallerys_upload_path'][2] = '../media/galerias/';
		$conf['gallerys_upload_internal_path'][2] = 'media/galerias/';
		$conf['images_upload_path'][2] = '../media/imagenes/';
		$conf['images_upload_internal_path'][2] = 'media/imagenes/';
		$conf['friendly_url'][2] = false;
		
		$conf['site_url'][3] = 'http://localhost/fisg/index.php';
		$conf['media_path'][3] = '../media/';
		$conf['media_internal_path'][3] = 'media/';
		$conf['gallerys_upload_path'][3] = '../media/galerias/';
		$conf['gallerys_upload_internal_path'][3] = 'media/galerias/';
		$conf['images_upload_path'][3] = '../media/imagenes/';
		$conf['images_upload_internal_path'][3] = 'media/imagenes/';
		$conf['friendly_url'][3] = true;
		$conf['friendly_url_base'][3] = "/fisg/";
		
		$configuration = new Cms_Model_Configuration( Cms_Cms::getDbConnection());
		// echo "<pre>";
		// print_r($configuration);
		// exit;
		$configuration->select()->where('site_id='.$configuration->secureText($site_id).' AND option_key="'.$configuration->secureText($str).'"')->runSelect();
		
		$siteconf = null;
		
		if($configuration->count() == 1)
		{
			$siteconf = $configuration->get('option_value');
		}
		
		if(!$site_id)
			return $conf[$str];
		// echo  $siteconf;
		// exit;
		return $siteconf;
	}
}


?>