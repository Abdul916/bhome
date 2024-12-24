<?php
/*
 * Descripcion corta
 *
 * Descripci—n larga
 * Created on Feb 23, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class LoginApp_Model_UserProfiles extends Core_App_Model_Model2 {
    protected $_fields ;

    function setUp() {
        $this->setFields(array('id','user_id','domain','default_path','created_at','updated_at'));	// Todos los campos
        $this->setUpdateFields(array('domain','default_path','created_at','updated_at'));	// los campos que puede actualizar el usuario
        $this->setTable('user_profiles');	// nombre de la tabla

       // $this->setHasOne('Kos_Model_Record', 'client_id');
        $this->setBelongsTo('User_Model_User', 'user_id');

    }
    public function newSelf(Core_Db_Db $conection) {
        return new self($conection);
    }
    public function getDomain(){
        return $this->get('domain');
    }

}


