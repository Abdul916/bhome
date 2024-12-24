<?php
/*
 * Implementaci—n de ReCaptcha
 *
 * Descripci—n larga
 * Created on May 26, 2010
 *
 * @category   Core
 * @package    Library
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

include("Core/Vendor/ReCaptcha/recaptchalib.php");

abstract class Core_Library_ReCaptcha {
    /**
     * API KEY de conexion a recaptcha
     * option
     * @access private
     * @var integer|string
     */
    private $_publicKey = 0;
    private $_privateKey = 0;
    private $currentError;

    function __construct($argument)
    {
        # code...
    }
    public function setPublicKey( $key)
    {
    	$this->_publicKey = $key;
    }
    public function getPublicKey()
    {
    	return $this->_publicKey;
    }
    public function setPrivateKey( $key)
    {
    	$this->_privateKey = $key;
    }
    public function getPrivateKey()
    {
    	return $this->_privateKey;
    }
    public function getCaptchaHTML()
    {
    	$t= recaptcha_get_html($this->getPublicKey());
    	return $t;
    }
    public function checkAnswer()
    {
    	$resp = recaptcha_check_answer ($this->getPrivateKey(),
										$_SERVER["REMOTE_ADDR"],
										$_POST["recaptcha_challenge_field"],
										$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid) {
			$this->currentError = $resp->error;
			return false;
		}

		return true;
    }
    public function getError()
    {
    	return $this->currentError;
    }
}

