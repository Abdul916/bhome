<?php
/**
* Controlador de marcadores para mapas
*/
class Cms_Controller_MapMark extends Core_App_Controller_Controller
{
	function index()
	{
		
	}
	function jx_delete( $req)
	{
		if(!is_numeric($req->post('mark_id')) )
		{
			$res = new Core_Base_Response( $this);
			$res->addVar('response', 10);
			return $res;
		}
		$mark = new Cms_Model_MapMarker( Cms_Cms::getDbConnection());
		$mark->loadId( $req->post('mark_id'));
		$mark->delete( $req->post('mark_id'));
		
		$res = new Core_Base_Response( $this);
		$res->addVar('response', 1);
		return $res;
	}
}

?>