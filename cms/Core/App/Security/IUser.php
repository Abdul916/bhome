<?php
/*
 * Interface de acceso a la informaci—n que el usuario usa para loguarce
 *
 * El objeto que proveer‡ a Core_App_Security_User con la informacion de acceso
 * del usuario debe implementar esta interface, genralmente ser’a un Core_App_Model_Model quien haria la implementaci—n
 * Created on Feb 1, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

interface Core_App_Security_IUser {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */

    // Debe entregar el Login que el usuario intente usar para loguearce
    public function getSecurityLogin();

    // Debe entregar el Password que el usuario intente usar para loguearce
    public function getSecurityPassword();


	// Realiza una busqueda en el modelo para encontrar el usuario correspondiente
	public function findByLoginField( $loginField);
}

