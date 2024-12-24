<?php
/**
* Domain helper
*/
class FrontCms_Library_Domain
{
	function __construct()
	{
		
	}
	static function getDomain()
	{
		return $_SERVER['SERVER_NAME'];
	}
}


?>