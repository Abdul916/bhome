<?php

/**
* Clase base para controladores
*/
class Core_App_Controller_Controller
{
	protected $_action;
	protected $_request;

	protected $_secureDomain;

	function __construct(Core_Base_Request $req )
	{
		$this->_request= $req;
		$this->_secureDomain = null;
	}

	public function resolve(Core_Base_Request $req)
	{
		$action = $req->getAction();
		$response= $this->$action($req);
		return $response;
	}
	public function process(Core_Base_Request $req)
	{
		$action= $req->getProcessAction();
		$response= $this->$action($req);
		return $response;
	}

	/**
	 * Metodos de declaraci—n de accesos
	 */

	 protected function setSecurityDomain(String $domain)
	 {
		$This->_secureDomain= $domain;
	 }

	 public function getSecurityDomain()
	 {
	 	return $this->_secureDomain;
	 }

	 public function hasSecurityDomain()
	 {
	 	if($this->_secureDomain != null)
	 	{
	 		return true;
	 	}
	 	return false;
	 }

}


?>