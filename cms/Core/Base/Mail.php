<?php
/*
 * Control basico de env’o de correos
 *
 * Descripci—n larga
 * Created on Mar 30, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

abstract class Core_Base_Mail {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
    protected $mailmanager = null;
	protected $mailserver = null;
	protected $isSMTP = null;
	protected $isHTML = null;
	protected $SMTPAuth= null;
	protected $username= null;
	protected $password= null;
	protected $port= null;
	protected $from= null;
	protected $fromName= null;
	protected $fileTemplate;
	protected $vErrors;
	protected $keys = array();
	protected $values = array();

    function __construct()
    {
		$this->vErrors = '';
    }
	protected function setUp()
	{
		$this->mailmanager= new PHPMailer();

		if($this->isSMTP)
		{
			$this->mailmanager->IsSMTP();
		}
		$this->mailmanager->IsHTML($this->isHTML);
	    $this->mailmanager->SMTPAuth = $this->SMTPAuth;
	    $this->mailmanager->Host = $this->mailserver;
	    $this->mailmanager->Username = $this->username;
	    $this->mailmanager->Password = $this->password;
	    $this->mailmanager->Port = $this->port;
	    $this->mailmanager->From = $this->from; // Desde donde enviamos (Para mostrar)
	    $this->mailmanager->FromName = $this->fromName;
	}
	public function mailTo( $email)
	{
		$res =$this->validEmail($email);
		/*if(!$res){
			error_log("The $email mail is not a valid account");
			return false;
		}*/
		error_log("The $email mail was added to queu");
		$this->mailmanager->AddAddress( $email);
		return true;
	}
	public function mailBcc( $email)
	{
		$res =$this->validEmail($email);
		/*if(!$res){
			error_log("The $email mail is not a valid account");
			return false;
		}*/
		error_log("The $email mail was added to queu");
		$this->mailmanager->AddBCC( $email);
		return true;
	}
	public function addAttachment( $filepath)
	{
		if(is_file($filepath))
		{
			$this->mailmanager->AddAttachment($filepath);
		}else{
			trigger_error('El archivo no se encuentra', E_WARNING);
		}
	}
	
	public function subject( $subject)
	{
		$this->mailmanager->Subject = $subject;
	}
	public function send()
	{
		// Se prepara el contenido para lectura y se env’a el mail
		if( !$this->fileTemplate)
		{
			trigger_error( "No se ha asignado el contenido del mail - Core_Base_Mail", E_USER_ERROR);
		}
		$this->prepareTemplate();
		$this->mailmanager->Body= $this->fileTemplate;
		$mailstatus = $this->mailmanager->Send();
		if(!$mailstatus)
			echo $this->mailmanager->ErrorInfo;
		return $mailstatus;
	}
	public function body( $path)
	{
		$this->fileTemplate = $this->getFileContent( $path);

	}
	public function textReplace( $key , $value)
	{
		$this->keys[] =  $key;
		$this->values[] =  $value;
	}
	protected function encode( $mailcontent)
	{
		return utf8_decode($mailcontent);
	}
	private function prepareTemplate()
	{
		$this->fileTemplate = $this->encode(str_replace($this->keys, $this->values, $this->fileTemplate));
	}
	public function setContent( $textContent)
	{
		$this->manualtext = true;
		$this->fileTemplate = $textContent;
	}
	private function getFileContent( $path)
	{
		if(!is_file($path))
		{
			trigger_error( "El archivo no existe - Core_Base_Mail", E_USER_ERROR);
		}
		$file = file_get_contents( $path , FILE_USE_INCLUDE_PATH);
		return $file;
	}
	public function getErrors()
	{
		return $this->mailmanager->ErrorInfo;
	}
	public function getValidationErrors()
	{
		return $this->vErrors;
	}
    public function validEmail($email)
	{
	   $isValid = true;
	   $atIndex = strrpos($email, "@");
	   if (is_bool($atIndex) && !$atIndex)
	   {
	   		$this->vErrors.= 'No contiene Arroba';
	      $isValid = false;
	   }
	   else
	   {
	      $domain = substr($email, $atIndex+1);
	      $local = substr($email, 0, $atIndex);
	      $localLen = strlen($local);
	      $domainLen = strlen($domain);
	      if ($localLen < 1 || $localLen > 64)
	      {
	         // local part length exceeded
	         $this->vErrors.= "local part length exceeded\n";
	         $isValid = false;
	      }
	      else if ($domainLen < 1 || $domainLen > 255)
	      {
	         // domain part length exceeded
	         $this->vErrors.= "domain part length exceeded\n";
	         $isValid = false;
	      }
	      else if ($local[0] == '.' || $local[$localLen-1] == '.')
	      {
	         // local part starts or ends with '.'
	         $this->vErrors.= "local part starts or ends with '.'\n";
	         $isValid = false;
	      }
	      else if (preg_match('/\\.\\./', $local))
	      {
	         // local part has two consecutive dots
	         $this->vErrors.= "local part has two consecutive dots \n";
	         $isValid = false;
	      }
	      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
	      {
	         //character not valid in domain part
	         $this->vErrors.= "character not valid in domain part: $domain \n";
	         $isValid = false;
	      }
	      else if (preg_match('/\\.\\./', $domain))
	      {
	         // domain part has two consecutive dots
	         $this->vErrors.= "domain part has two consecutive dots \n";
	         $isValid = false;
	      }
	      else if
	(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
	                 str_replace("\\\\","",$local)))
	      {
	         // character not valid in local part unless
	         // local part is quoted
	         $this->vErrors.= "character not valid in local part unless local part is quoted \n";
	         if (!preg_match('/^"(\\\\"|[^"])+"$/',
	             str_replace("\\\\","",$local)))
	         {
	            $isValid = false;
	         }
	      }
	      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
	      {
	         // domain not found in DNS
	         $this->vErrors.= "domain not found in DNS \n";
	         $isValid = false;
	      }
	   }
	   return $isValid;
	}
}

