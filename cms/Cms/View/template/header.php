<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Administrador de contenido</title>
	<link href="core-includes/css/app.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="Cms/includes/css/cms.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"> <!--<link rel="stylesheet" href="css/style.css"> -->
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">-->
	
	<link rel="stylesheet" href="Cms/includes/css/jquery.fileupload-ui.css"><?php
	echo $this->headerStr;
	echo $this->afterHeader; ?>
	
</head>
<body id="page">
<div id="content">
	<div id="header">
		<h1><a href="index.php">Blue Adventures</a></h1>
		<h2><a href="?a=login&c=index:logout">Logout</a></h2>
		<!--<h2>Preferencias: <a href="?a=user&c=user:preferences">Nafinsa</a></h2>-->
	</div>
	<div id="mainnav">
		<ul class="nav vlist">
			<li><a href="<?php Core_Common_Route::linkController('index'); ?>" class="current">Sitios Web</a></li>
		</ul>
	</div>