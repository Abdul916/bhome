<?php
/**
* Modelo para marcadores de mapas
*/
class Cms_Model_MapMarker extends Core_App_Model_Model2
{
	/* OVERWRITE de select para manejar el campo tipo point */
	public function select( $selection = null)
    {
    	if(!$selection)
    	{
    		$selection = 'id, title, AsText(location) as location, map_id, options, anotation, created_at, updated_at';
			
    	}
    	$this->_query= 'SELECT ' . $selection;

    	return $this;
    }
	function setup()
	{
		$this->setTable('site_map_markers');
		$this->setFields( array('id', 'title', 'location', 'map_id', 'options', 'anotation', 'created_at', 'updated_at'));
		$this->setUpdateFields( array('title'));
		$this->setNotSecureFields( array('location')); // el modelo se hace cargo de la seguridad del campo
		
		$this->setBelongsto('Cms_Model_Map', 'map_id');
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
}

?>