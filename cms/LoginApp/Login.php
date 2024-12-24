<?php
/*
 * Aplicacion que se encarga de procesos de Login al sistema
 *
 * Contiene opciones de login y creaci—n de tokens validos para el sistema, tambien se encarga de notificaciones
 * a usuario cuando este no ingresa los datos correctos
 * Created on Feb 10, 2010
 *
 * @category    Core
 * @package    App_LoginApp
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_app_LoginApp_Login extends Core_App_Controller_AppController
{
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */

    function setup()
	{
		$this->setSecurityDomain('ATLAS.ADMIN');
	}
	
	static function getDbConnection()
	{
		return Configuration::instance()->getDbConnection();
	}
}

