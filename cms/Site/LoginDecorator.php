<?php 
/**
* 
*/
class Site_LoginDecorator extends FrontCms_Core_RouteDecorator
{
	private $_url = '';
	public function setSite( $site)
	{
		//error_log('__ set site');
		$this->_site = $site;
	}

	function validateRoute( $currentRoute)
	{
		$this->_url = $currentRoute;
		preg_match('/\/login\//', $currentRoute, $matches);
		
		if(count($matches) > 0)
		{
			return true;
		}
		//error_log('NOT SHOP');
		return false;
	}
	function getTemplate( $currentRoute)
	{

		$url_segments = explode('/', $currentRoute);
		return array('template' => 'login', 'data' => array());

	}
	
}