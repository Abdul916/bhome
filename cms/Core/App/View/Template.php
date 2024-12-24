<?php

/**
*
*/
class Core_App_View_Template
{
	static $_instace;
	private $_viewSrc= null;
	public $title;
	private $headerStr;
	protected $afterHeader;

	private function __construct()
	{
		$this->headerStr = '';
		$this->afterHeader = '';
	}
	static function instace()
	{
		if(!is_object(self::$_instace))
		{
			self::$_instace = new self;
		}

		return self::$_instace;
	}
	public function setTitle()
	{

	}
	public function setView($src)
	{
		$this->_viewSrc= $src;
	}
	private function loadFileContent($path)
	{
		$filename = $path;
		$handle = fopen($filename, "rb");
		$content = fread($handle, filesize($filename));
		fclose($handle);
		return $content;
	}
	public function getHeader($appication = null, $headerVars = null)
	{
		if( is_array($headerVars))
		{
			extract($headerVars);
		}
		$path='';
		$req= new Core_Base_Request();

		if( ! is_null($appication) )
		$app = $appication;

		else
		$app = $req->getApplication();

		//$headerContent = $this->loadFileContent($path.ucfirst($app)."/View/template/header.php");
		$headerIncludes = $this->headerStr;
		include $path.ucfirst($app)."/View/template/header.php";
	}
	public function printAfterHeader($string)
	{
		$this->afterHeader .= $string;
		$this->afterHeader .= "\n";
	}
	public function getAfterHeader()
	{
		return $this->afterHeader;
	}
	public function getFooter()
	{
		$path='';
		$req= new Core_Base_Request();
		$app= $req->getApplication();
		include $path.ucfirst($app)."/View/template/footer.php";
	}
	public function addJavaSript($path)
	{
		$this->headerStr.= '<script type="text/javascript" src="'.$path.'"></script>';
		$this->headerStr.= "\n";
		return $this;
	}
	public function addJavaScript($path)
	{
		$this->addJavaSript($path);
		return $this;
	}
	public function addCss($path)
	{
		$this->headerStr.= '<link href="'.$path.'" media="screen" rel="stylesheet" type="text/css" />';
		$this->headerStr.= "\n";
		return $this;
	}

}


?>