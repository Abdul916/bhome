<?php
/**
* Modelo de acceso al la tabla de mapas
*/
class Cms_Model_Map extends Core_App_Model_Model2
{
	/* OVERWRITE de select para manejar el campo tipo point */
	public function select( $selection = null)
    {
    	if(!$selection)
    	{
    		$selection = 'id, name, description, AsText(center_point) as center_point, zoom, map_options, created_at, updated_at';
			
    	}
    	$this->_query= 'SELECT ' . $selection;

    	return $this;
    }
	
	function setup()
	{
		$this->setTable('site_maps');
		$this->setFields( array('id', 'name', 'description', 'center_point', 'zoom', 'map_options', 'created_at', 'updated_at'));
		$this->setUpdateFields( array('name', 'description', 'center_point', 'zoom', 'map_options'));
		$this->setNotSecureFields( array('center_point')); // el modelo se hace cargo de la seguridad del campo
		
		$this->setHasMany('Cms_Model_MapMarker', 'map_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	public function saveMarkers($req_array)
	{
		error_log( print_r($req_array, true), 0);
		if(is_array($req_array))
		{
			//error_log('es array');
			foreach($req_array as $point)
			{
				// guardar cada point como MapMarker
				
				$marker = new Cms_Model_MapMarker( Cms_Cms::getDbConnection());
				$marker->set('title', '');
				$point = Cms_Model_Map::PositionToPoint($point);
				$marker->set('location', 'GeomFromText("'.$point.'")');
				//error_log($point);
				$marker->set('map_id', $this->get('id'));
				$marker->set('options', '');
				$marker->set('anotation', '');
				$marker->set('created_at', Core_Base_Date::getDateTime());
				$marker->insert();
			}
		}
	}
	public function updateMarkers($markers_array)
	{
		if(!is_array($markers_array) && count($markers_array) == 0)
		{
			return;
		}
		foreach($markers_array as $id => $position)
		{
			$marker = new Cms_Model_MapMarker( Cms_Cms::getDbConnection());
			$marker->loadId($id);
			$point = Cms_Model_Map::PositionToPoint($position);
			$arr= array('location' => 'GeomFromText("'.$point.'")');
			error_log('updating marker '.$id.' to: ' . $position);
			$marker->updateFields( $arr);
		}
	}
	public function getMarkers()
	{
		$childs = $this->getChilds('Cms_Model_MapMarker');
		$childs->runSelect();
		
		return $childs;
	}
	static function PositionToPoint( $textPoind)
	{
		$textPoind = str_replace(' ', '', $textPoind);
		$var = explode(',', $textPoind);
		
		$str = 'POINT('.$var[0].' '.$var[1].')';
		return $str;
	}
	static function PointToPosition( $point)
	{
		if(strlen($point) < 1)
		{
			return '10.314919,-102.5683589';
		}
		
		$str = trim($point); // elimina espacios en blanco al principio y fin de la cadena
		$el = array('(', ')', 'POINT');
		$str = str_replace($el, '', $str);
		$vals = explode(' ', $str);
		$str = $vals[0].','.$vals[1];
		
		return $str;
	}
}

?>