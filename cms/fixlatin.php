<?php
// print_r($_POST);
// exit;
date_default_timezone_set('America/Mexico_City');
include 'Core/autoload.php';

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set('log_errors', true);
ini_set('html_errors', false);
ini_set('error_log', 'error_log.log');

$pages = new Cms_Model_Page (Cms_Cms::getDbConnection ());
$pages->select('*')->runSelect();

$acentos = [ 'é',  'ó',  'ú',  'í', 'ñ',  'á', '²' ,  'ñ',  '°',  '–',  '“', '´', ''];
$encoded = [ 'Ã©', 'Ã³', 'Ãº', 'Ã', 'Ã±', 'í¡', 'Â²', 'í±', 'Â°', 'â€“','â€', 'Â´','œ' ];

foreach( $pages as $page)
{
    echo $page->get('name');
    echo ' - ';
    $replace = str_replace($encoded, $acentos, $page->get('name'));
    echo $replace . ' <br/>';
    $page->updateFields(['name' => $replace]);
}

$datas = new Cms_Model_Data (Cms_Cms::getDbConnection ());
$datas->select('*')->runSelect();

foreach ($datas as $page) {
    echo $page->get('str_value');
    echo ' - ';
    $replace = str_replace($encoded, $acentos, $page->get('str_value'));
    $txtreplace = str_replace($encoded, $acentos, $page->get('text_value'));
    echo $replace . ' <br/>';
    $page->updateFields(['str_value' => $replace, 'text_value' => $txtreplace]);
}

$datas = new Cms_Model_StructureField (Cms_Cms::getDbConnection ());
$datas->select('*')->runSelect();

foreach ($datas as $page) {
    echo $page->get('name');
    echo ' - ';
    $replace = str_replace($encoded, $acentos, $page->get('name'));
    echo $replace . ' <br/>';
    $page->updateFields(['name' => $replace]);
}
