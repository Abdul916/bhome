<?php
/**
* Configuración general de la aplicacion
*/
class Configuration extends Core_Base_Configuration
{
	static $instance; // para guardar la instancia del objecto

	private function __construct()
	{
		$this->properties= array();
		$this->add('application_name', 'Administrador de contenidos Pnamerican Travel');
	}
	static function instance()
	{
		if(!is_object(self::$instance))
		{
			self::$instance = new self();
		}

		return self::$instance;
	}
	static function getDbConnection()
	{
		$dbFactory = Core_Db_DbFactory::instance();

		$dbFactory->addServer('localhost', 'DbConfig_Cms');
		$dbFactory->addServer('localhost', 'DbConfig_BHome');
		$dbFactory->addServer('localhost', 'DbConfig_BHome');

		// $dbFactory->addServer('cms.test', 'DbConfig_Cms');
		// $dbFactory->addServer('www.bhomeenterprise.ca', 'DbConfig_BHome');
		// $dbFactory->addServer('bhomeenterprise.ca', 'DbConfig_BHome');


		return Core_Db_DbFactory::instance()->getDbConnection( Core_Db_DbFactory::instance()->getHost())->getDbConnection();
	}
}

?>
