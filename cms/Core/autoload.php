<?php

function autoload($class_name)
{
    $path = str_replace("_", "/", $class_name);
	if(!is_file($path.'.php'))
		$path = 'Vendor/'.$path;
    require_once $path.".php";
}
spl_autoload_register('autoload');
?>