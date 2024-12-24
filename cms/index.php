<?php
// print_r($_POST);
// exit;
date_default_timezone_set('America/Mexico_City');
include './Core/autoload.php';

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set('log_errors',TRUE);
ini_set('html_errors',FALSE);
ini_set('error_log', 'error_log.log');


Core_FrontController::instance()->run( 'cms');

?>