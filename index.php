<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('America/Mexico_City');
// session_start();

if( ! function_exists ('my_autoloader'))
{
	function my_autoloader($class_name)
	{
	    $path = str_replace("_", "/", $class_name);
	    require_once './cms/'.$path.".php";
	}
}

spl_autoload_register('my_autoloader');

// ejecutar el motor de publicación del CMS
FrontCms_Site::instance()->run(2);


