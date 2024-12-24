<?php

/**
* Error Db
*/
class Core_Error_DbError extends Core_Error_Error
{

	static $ConectionError = 1001;
	static $DatabaseError = 1002;
	static $WrongData = 1002;

	public function init()
	{
		$_errorsArray[Core_Error_DbError::$ConectionError]= "Error estableciendo conexi—n a servidor de datos";
		$_errorsArray[Core_Error_DbError::$DatabaseError]= "Error abriendo base de datos";
		$_errorsArray[Core_Error_DbError::$WrongData]= "Los datos ingresados no son correctos";
	}



}


?>