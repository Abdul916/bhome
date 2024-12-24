<?php
/*
 * Indica informaci—n sobre cada perfil
 *
 * Indica funciones por default como, Aplicaci—n por Default, Controllador por Default. Indica tiempos de duraci—n de la
 * sesi—n del usuario. Cualquier informaci—n referente al perfil del usuario se almacena en esta clase
 * Created on Feb 2, 2010
 *
 * @category    Core
 * @package    App_Security
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

abstract class Core_App_Security_Profile {
    /**
     * Indica el tipo de usuario, este tipo es libre de uso para el sistema, recomendable:
     * NombreAplicacion.TipoUsuario, Ej. KOS.ADMIN
     * @access private
     * @var string
     */
    private $_user_type;

    private $_applicationDefault;
    private $_controllerDefault;

    function __construct($user_type)
    {
        $this->_user_type= $user_type;
    }

    public function setApplication(String $application)
    {
    	$this->_applicationDefault= $application;
    }
	public function setController(String $controller)
    {
    	$this->_controllerDefault= $controller;
    }
}

