<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<title>Brief Online | Login</title>

<link rel="stylesheet" type="text/css" media="screen" href="includes_vp/css/reset.css" />
<link rel="stylesheet" type="text/css" media="screen" href="includes_vp/css/base.css" />
<link rel="stylesheet" type="text/css" media="screen" href="includes_vp/css/elastic.css" />
<script type="text/javascript" src="includes_vp/scripts/jquery-1.6.1.min.js"></script>
</head>

<body>

	<div id="wrap">
	
		<div id="header">
			<img id="logo" src="includes_vp/img/lemonmedia-logo.jpg" alt="lemonmedia design for life" />
		</div>

		<div id="main-menu">
		
			<div id="nav">	
				<div id="brief-button"></div>
			
				<div id="vp-button"></div>
			
				<div id="menu-bar"></div>
				
				<div class="clear"></div>
			</div>
		</div>

		<div id="main-content">
			<div class="container">
				<div id="login-window" class="window">
					<div class="header"><h1><?php echo $registro->get('name'); ?> crea tu password</h1></div>
					<?php
                         if(isset($_GET['error']) && $_GET['error']==1)
                             echo '<p>Tu nombre de usuario y/o contraseña son incorrectos</p>' ;
                    ?>
					<form id="login" action="<?php Core_Common_Route::linkController('index:login') ?>" method="post" accept-charset="utf-8">
						<label for="user">usuario</label>
						<input id="user" type="text" name="user" value="<?php echo $credentials->get('user'); ?>" />
	
						<label for="password">nuevo password</label>
						<input id="password" type="password" name="password" />
				
						<a id="accept-btn" style="display:block; float:none !important; position:relative; left:180px;" href="#" class="sprite">Guardar</a>
						
						<input type="submit" name="some_name" value="Enviar" id="submit_btn">
						<input type="hidden" name="process" value="user:updatecredentials" id="process">
						<input type="hidden" name="credential_id" value="<?php echo $credentials->get('id'); ?>" id="credential_id">
					</form>	
					<!-- 
					<div class="inner">
						<a href="#" class="txt-btn">Olvidé mi contraseña &gt;&gt;</a>
					</div>-->
				</div>

			</div>			
		</div>

		<div id="footer">
			<p id="credits">Desarrollado por Lemon Media<br /><span>Todos los derechos reservados 2011 &reg;</span></p>
			
			<ul id="bottom-menu">
				<li><a href="#">Ayuda</a> &nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="#">Sugerencias y contacto</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li><a href="#">Términos de uso</a></li>
			</ul>
		</div>
		
	</div>
	<script type="text/javascript" charset="utf-8">
		$('#sign-in').click( function(){
			$('#login').submit();
			
			return false;
		});
	</script>
</body>
</html>