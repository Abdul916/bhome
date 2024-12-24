<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login</title>
<link href="core-includes/css/app.css?a=2" media="screen" rel="stylesheet" type="text/css" />

</head>

<body id="page">
	
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
	       chromium.org/developers/how-tos/chrome-frame-getting-started -->
	  <!--[if lt IE 7]><p class=chromeframe>Tu navegador no es una versión soportada por este sistema 
	<a href="http://browsehappy.com/">Porfavor actualiza tu navegador</a> </p><![endif]-->
	
<div id="header" class="login">
	<h1><a href="index.php">Blue Adventures</a></h1>
	<h2></h2>
</div>
<div id="app">
	<div class="form login">
		<div class="nav">
			<ul>
				<li><a href="#signin" class="tab selected">Acceso al sistema</a></li>
			</ul>
		</div>
		<form action="<?php Core_Common_Route::linkController('index:login') ?>" id="login" method="post" accept-charset="utf-8" autocomplete="off"> 
			<fieldset>
				<legend>Tus datos de acceso</legend>
                                
                                    <?php
                                         if(isset($_GET['error']) && $_GET['error']==1)
                                             echo '<h3 class="alert">Tu nombre de usuario y/o contraseña son incorrectos</h3>' ;
                                    ?>
                                
				<ul>
					<li><label for="user">Usuario: </label><input type="text" name="user" id="user" autofocus />
					</li>
					<li><label for="password">Contraseña: </label><input type="password" name="password" id="password" /></li>
				</ul>
			</fieldset>
			<fieldset class="options">
				<ul>
					<li><label for=""></label><input type="submit" name="login" value="Enviar" /></li>
				</ul>
			</fieldset>
		</form>
		
	</div>
</div>

</body>
</html>
