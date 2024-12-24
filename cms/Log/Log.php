<?php
/**
* Modelo de acceso al log
*/
class Log_Log extends Core_App_Model_Model2
{
	function setup()
	{
		$this->setTable('core_log');
		$this->setFields( array('id', 'log', 'time'));
	}
	public function newSelf( Core_Db_Db $dbConnection)
	{
		return new self( $dbConnection);
	}
	static function save($db, $ov)
	{
		$log = new self($db);
		$tolog = '';
		if(is_object($ov))
		{
			$tolog = print_r($ov, true);
		}else{
			$tolog = $ov;
		}
		$log->set('log', $tolog);
		$log->set('time', Core_Base_Date::getDateTime());
		$log->insert();
	}
}

?>