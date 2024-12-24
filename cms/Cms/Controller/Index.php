<?php

/**
* 
*/
class Cms_Controller_Index extends Core_App_Controller_Controller
{
	function index($req)
	{
		/*
		- Agregar una condición donde se calcule la cantidad de sitios existentes
			Si no hay sitios mandar pantalla para alta de sitio site:add*/

		$sites = new Cms_Model_Site( Cms_Cms::getDbConnection());
		$sites->collection()->runSelect();

		if ($sites->count() == 0) 
		{
		    $res = new Core_Base_Response( $this);
			$view = "Cms/View/site/add"; //sin .php
			$res->setView($view);
			return $res;
		} 
		elseif ($sites->count() == 1) 
		{
			$site = $sites->getObjectAt(0);
			//$sections = $site->getSections();

			$sections = new Cms_Model_Section( Cms_Cms::getDbConnection());
			$sections->select()->where('site_id = "'.$site->get('id').'" AND lang_code is NULL')->orderby('id ASC')->runSelect();

		    $res = new Core_Base_Response( $this);
			$view = "Cms/View/site/general"; //sin .php
			$res->setView($view);
			$res->addVar('site', $site);
			$res->addVar('sections', $sections);
			return $res;
		} 
		else 
		{
		    $res = new Core_Base_Response( $this);
			$view = "Cms/View/site/index"; //sin .php
			$res->setView($view);
			$res->addVar('sites' , $sites);
			return $res;
		}


		$res = new Core_Base_Response( $this);
		$res->addVar('sites', $sites);
		$res->addVar('sections' , $sections);
		$res->addVar('site' , $site);
		return $res;
	
	}
}


?>