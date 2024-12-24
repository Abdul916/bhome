<?php
/**
* Interfase para modificador de rutas en FrontCms_Site
*/
abstract class FrontCms_Core_RouteDecorator
{
	private $_site;
	
	// debe validar que la ruta del usuario 
	abstract function validateRoute( $currentRoute);
	
	abstract function getTemplate( $currentRoute);
	
	abstract function setSite( $site);
	
}

?>