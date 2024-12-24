<?php

class User_Controller_User extends Core_App_Controller_Controller
{
	function create( $req)
	{
		$registros = new User_Model_Admin( User_User::getDbConnection());
		$registros->collection()->runSelect();

		$res = new Core_Base_Response( $this);
		$res->addVar('registros', $registros);
		
		return $res;
	}
	function save( $req)
	{
		$password = '';		

		$status = $req->post('status');
		$email = $req->post('email');
		$name = $req->post('name');
		$path = $req->post('default_path');
		$pass1 = $req->post('password1');
		$pass2 = $req->post('password2');
		$user = $req->post('login');
		$domain = $req->post('domain');
		$fechaactual = date('Y-m-d');
		
		if ($pass1 == $pass2){
			$password = $pass1;
		}
		
		$credentials = new User_Model_Credentials( User_User::getDbConnection());
		$credentials->set('user',$user);
		$credentials->set('password',$password);
		$credentials->set('status', $status);
		$credentials->set('created_at', $fechaactual);
		$credentials->insert();

		$registro = new User_Model_Admin( User_User::getDbConnection());
		$registro->set('name', $name);
		$registro->set('email', $email);
		$registro->set('secure_user_id',$credentials->getId());
		$registro->set('created_at', $fechaactual);
		$registro->set('updated_at', $fechaactual);
		$registro->insert();

		$profiles = new LoginApp_Model_UserProfiles( User_User::getDbConnection());
		$profiles->set('user_id',$credentials->getId());
		$profiles->set('default_path',$path);
		$profiles->set('created_at', $fechaactual);
		$profiles->set('domain',$domain);
		$profiles->insert();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('registro', $registro);
		return $res;
	}
	function edit ($req)
	{
		$registro = new User_Model_Admin( User_User::getDbConnection());
		$registro->find($req->get('id'));
		
		$credencial= new User_Model_Credentials( User_User::getDbConnection());
		$credencial->find($registro->get('secure_user_id'));
		
		$perfil= new LoginApp_Model_UserProfiles( User_User::getDbConnection());
		$perfil->find($registro->get('secure_user_id'));
		
		$res = new Core_Base_Response( $this);
		$res->addVar('registro', $registro);
		$res->addVar('credencial', $credencial);
		$res->addVar('perfil', $perfil);
		return $res;
	}
	
	function update($req)
	{
		$reg= new User_Model_Admin( User_User::getDbConnection());
		$reg->find($req->post('id'));
		
		$registro = new User_Model_Admin( User_User::getDbConnection());
		$credentials = new User_Model_Credentials( User_User::getDbConnection());
		$profiles = new LoginApp_Model_UserProfiles( User_User::getDbConnection());
		
		$registro->loadId($req->post('id'));
		$registro->loadArray($req->getPost());
		
		$status=$req->post('status');
		$login=$req->post('login');
		// $domain=$req->post('domain');
		// $path=$req->post('default_path');
			
		$pass1=$req->post('password1');
		$pass2=$req->post('password2');
		
		$fechaactual = date('Y-m-d');
		$registro->set('updated_at', $fechaactual);
		$registro->update();
		$credentialdata = array();
		$credentials->loadId($reg->get('secure_user_id'));
		$credentialdata['user'] = $login;
		$credentialdata['status'] = $status;
		
		if(strlen($pass1) > 1)
		{
		 	if ($pass1 == $pass2){
				$credentialdata['password'] = $pass1;
			}
		}
		
		$credentialdata['updated_at'] = Core_Base_Date::getDateTime();
		$credentials->updateFields($credentialdata);
		
		$profiles->select()->where('user_id = '.$reg->get('secure_user_id'))->runSelect();
		$profiles->set('user_id', $reg->get('secure_user_id'));
		// $profiles->set('default_path', $path);
		$profiles->set('updated_at', $fechaactual);
		// $profiles->set('domain',$domain);
		$profiles->update();
		
		$res = new Core_Base_Response( $this);
		$res->addVar('registro', $registro);
		return $res;
	}
	
	public function publicupdate( $req)
	{
		$reg= new User_Model_Admin( User_User::getDbConnection());
		$reg->find($req->get('uid'));
		$credentials = $reg->getCredential();
		
		//$credentials = new User_Model_Credentials( User_User::getDbConnection());
		$profiles = new LoginApp_Model_UserProfiles( User_User::getDbConnection());
		
		
		$res = new Core_Base_Response( $this);
		$res->addVar('registro', $reg);
		$res->addVar('credentials', $credentials);
		return $res;
	}
	public function updatecredentials( $req)
	{
		$credentials = new User_Model_Credentials( User_User::getDbConnection());
		$credentialdata = array();
		$credentials->loadId( $req->post('credential_id'));
		
		$login=$req->post('user');
		$pass2 = $pass1 = $req->post('password');
		
		$credentialdata['user'] = $login;
		$credentialdata['password'] = $pass2;
		
		$credentialdata['updated_at'] = Core_Base_Date::getDateTime();
		$credentials->updateFields($credentialdata);
		
		$res = new Core_Base_Response( $this);
		$res->addVar('credentials', $credentials);
		return $res;
	}
	public function updated( $req)
	{
		$reg= new User_Model_Admin( User_User::getDbConnection());
		$reg->find($req->post('user_id'));
		
		$credentials = $reg->getCredential();
		$res = new Core_Base_Response( $this);
		$res->addVar('registro', $reg);
		$res->addVar('credentials', $credentials);
		return $res;
	}
}


?>