<?php 

class Site_RecoverDecorator extends FrontCms_Core_RouteDecorator
{
	private $_url = '';
	public function setSite( $site)
	{

		$this->_site = $site;
	}

	function validateRoute( $currentRoute)
	{
		$this->_url = $currentRoute;
		preg_match('/\/recover\//', $currentRoute, $matches);

		if(count($matches) > 0)
		{
			return true;
		}

		return false;
	}
	function getTemplate( $req)
	{
		$send = false;
		$message = '';
		$email = '';
		$user = '';
		$password = '';

		if((isset($_POST['email']) && strlen($_POST['email']) > 4)){

			$user_admin = new User_Model_Admin( User_User::getDbConnection());
			$user_admin->select()->where('email = "'.$_POST['email'].'"' )->runSelect();

			$user_credential = new User_Model_Credentials( User_User::getDbConnection());
			$user_credential->select()->where('id = '.$user_admin->get('secure_user_id').' AND status = 1')->runSelect();

			if( $user_credential->get('status') == 1 && $user_credential->count() == 1){
					$email = $user_admin->get('email');
					$user = $user_credential->get('user');
					$password = $user_credential->get('password');
				}

			$mailto = $email;

			require("inc/PHPMailer.php");
			$comentario ='
			<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
			"http://www.w3.org/TR/html4/loose.dtd">
			<html lang="es">
			<head>
			<meta http-equiv="Content-Type" content="text/html; ">
			<title>Mail</title>
			<meta name="author" content="Blue Adventures">
			</head>
			<body>
			<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #CCC">
			 <tr>
			   <td><table width="660" align="center" cellpadding="0" cellspacing="0" style="font-family:\'Lucida Sans Unicode\', Arial, Helvetica, \'Lucida Grande\', sans-serif; font-size: 12px;">
			     <tr>
			       <td align="center">
			       		<img src="http://www.empleosverdes.com/upload/empleos-verdes/media/imagenes/logo-CIEV.jpg" width="176" height="130" />
			            <div style="border-bottom:2px solid #CCCCCC; height:19px"></div>
			            </td>
			          </tr>
				     <tr>
				       <td>
			            <div style="height:10px"></div>
			         <table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
			           <tr>
							<td><h3 style="font-size:14px">SU INFORMACI&Oacute;N DE ACCESO AL CIEV</h3>
							<p>Hemos recibido una solicitud para recuperar el usuario y contrase&ntilde;a,<br> esta es su informaci&oacute;n:</p>
							<table width="650" border="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333">
								<tr>	
									<td>Usuario: '.utf8_decode($user).'</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>	
									<td>Password: '.utf8_decode($password).'</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
							   	<tr><td><div style="padding: 10px 0px; color: #666;">
								<strong>
									Si requieres m&aacute;s informaci&oacute;n, visita la p&aacute;gina del 
									<a href="http://empleosverdes.com/ciev/">Comit&eacute; Intersectorial de Empleos Verdes</a>
									</strong>
							   	</div></td></tr>
							</table>';
						'</td>
					</tr>
					<tr><td><div style="padding: 10px 0px; color: #666;">Empleos Verdes</div></td></tr>
					<tr><td>&nbsp;</td></tr>
					</table></td>
			      	</tr>
				</table>
			</body>
			</html>';

			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "mail.blueadventures.me"; // reemplazar por su dominio
			$mail->SMTPAuth = true;
			$mail->Username = "pruebas@blueadventures.me";  // email de la cuenta que se usara para enviar los mensajes.
			$mail->Password = "pr83b4spass"; // Contraseña de la cuenta de correo.
			$mail->Port = 587; // Puerto a utilizar
			$mail->From = "contacto@empleosverdes.com";
			$mail->FromName = "Empleos Verdes";
			$mail->AddAddress($mailto);


$mail->AddBCC('fernando@blueadventures.me');
// $mail->AddBCC('contacto@empleosverdes.com');


			$mail->WordWrap = 800;
			$mail->IsHTML(true);
			$mail->Subject = "Forma de contacto";
			$mail->Body = $comentario;

			if($mail->Send())
			{
				$send = true;
			}else{
				$send = false;
				$message = 'Error al enviar el correo de recuperación de tu password, por favor intenta denuevo.';
			}			
		}

		return array('template' => 'recover', 'data' => array( 'mail_send' => $send, 'message' => $message));
	}	
}

