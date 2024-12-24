<?php

/**
* Funciones de ayuda para generar acciones de ruteo
*/
class Core_Common_Route
{
	function __construct()
	{

	}
	static function getApp()
	{
		$req = new Core_Base_Request();
		return $req->getApplication();
	}
	static function builtLinkController($controllername, $var = null,$app = null)
	{
		$vars= '';
		if(!is_null($app))
		$aplication = $app;

		else
		$aplication = self::getApp();

		if($var)
			$vars= "&".self::array2linkstring($var);

		return 'index.php?a='.$aplication.'&c='.$controllername.''.$vars;
	}
	static function linkController($controllername, $var = null,$app = null)
	{
		$link = Core_Common_Route::builtLinkController($controllername , $var, $app);

		echo $link;
	}
	static function getLinkController($controllername, $var = null,$app = null)
	{
		$link = Core_Common_Route::builtLinkController($controllername , $var, $app);
		return $link;
	}
	static function array2linkstring($arr)
	{
		if(is_array($arr))
		{
			$str="";
			foreach($arr as $var => $value)
			{
				$str.= $var.'='.$value.'&';
			}
		}else{
			return $arr;
		}
		return $str;
	}
}


?>