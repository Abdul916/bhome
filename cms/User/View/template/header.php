<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sitios Web</title>
<link href="core-includes/css/app.css?v=2" media="screen" rel="stylesheet" type="text/css" />
<?php 

echo $this->headerStr;
echo User_View_Template::instace()->getAfterHeader();

?>
</head>
<body id="page">
<div id="content">	
	<div id="header">
		<h1><a href="index.php">Blue Adventures</a></h1>		
		<h2><a href="?a=login&c=index:logout">Logout</a></h2>


		<!--<h2>Preferencias: <a href="/sites/pulporecords/?a=user&c=user:preferences"><?php 
			// $usuario = Core_App_Controller_SecurityController::instance()->getSystemUser('User_Model_Admin');
			// echo $usuario->get('name');
		?></a></h2>-->


	</div>
	<div id="mainnav">
		<ul class="nav vlist">
			<li><a href="<?php Core_Common_Route::linkController('index', 'null', "cms"); ?>" class="current">Sitios Web</a></li>
			<li><a href="<?php Core_Common_Route::linkController('index'); ?>" class="current">Usuarios</a></li>
		</ul>
	</div>