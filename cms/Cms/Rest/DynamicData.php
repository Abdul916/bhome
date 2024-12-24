<?php

class Cms_Rest_DynamicData extends Core_App_Controller_Rest
{
	public function GET( $req)
	{
		
		//error_log(print_r($model, true));
		$res = new Core_Base_Response( $this);
		//$res->setData($model);
		return $res;
	}
	public function POST( $req)
	{
		$res = new Core_Base_Response( $this);
		$res->setData($model);
		return $res;
	}
	public function PUT( $req)
	{
		
		$res = new Core_Base_Response( $this);
		//$res->setData($model);
		return $res;
	}
	public function DELETE( $req)
	{
		if($req->get('id') && is_numeric($req->get('id')) && $req->get('id') > 0)
		{
			$model_id = $req->get('id') * 1;
			$model = new Cms_Model_DynamicData( Cms_Cms::getDbConnection());
			$model->loadId($model_id);
			$model->delete($model_id);
		}
		$res = new Core_Base_Response( $this);
		$res->setHttpHeader('HTTP/1.0 204 No Content');
		return $res;
	}
}

?>