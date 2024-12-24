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

$projects = new Cms_Model_Page (Cms_Cms::getDbConnection ());
$projects->select();
$projects->where( ' lang_main_page_id != 0');
$projects->runSelect();
// print_r( $projects);
foreach( $projects as $pr)
{
  echo "<h3>Pagina {$pr->get('name')} | ID: {$pr->get('id')}</h3>";
  // datos de campos tipo pagina en español
  $data = new Cms_Model_Data(Cms_Cms::getDbConnection());
  $data->select()->where( ' site_page_id =' . $pr->get('id') . ' and foreign_model = "Cms_Model_Image"')->runSelect();

  // pagina en español
  $page_es = new Cms_Model_Page(Cms_Cms::getDbConnection());
  $page_es->find($pr->get('lang_main_page_id'));
    
  echo "<h4>Pagina ES: {$page_es->get('name')} | id: {$page_es->get('id')}</h4>";
  foreach( $data as $d_en)
  {
    // iterar sobre los datos buscando el mismo dato de la página en ingles

    // buscamos el dato en español
    $data_es = new Cms_Model_Data(Cms_Cms::getDbConnection());
    $data_es->select()->where(' site_page_id =' . $page_es->get('id') .' and foreign_model = "Cms_Model_Image" and structure_field_id =' . $d_en->get('structure_field_id'))->runSelect();

    echo "<p> set data {$d_en->get('id')} with data from {$data_es->get('id')} <p>";
    $d_en->updateFields(['foreign_id' => $data_es->get( 'foreign_id')]);

  }

  // Ahora hacer lo mismo con las galerias
  $data = new Cms_Model_Data(Cms_Cms::getDbConnection());
  $data->select()->where(' site_page_id =' . $pr->get('id') . ' and foreign_model = "Cms_Model_ImageCollection"')->runSelect();
  foreach($data as $d_en) {
      // iterar sobre los datos buscando el mismo dato de la página en ingles

      // buscamos el dato en español
      $data_es = new Cms_Model_Data(Cms_Cms::getDbConnection());
      $data_es->select()->where(' site_page_id =' . $page_es->get('id') . ' and foreign_model = "Cms_Model_ImageCollection" and structure_field_id =' . $d_en->get('structure_field_id'))->runSelect();

      echo "<p> set data {$d_en->get('id')} with data from {$data_es->get('id')} <p>";
      $d_en->updateFields(['foreign_id' => $data_es->get('foreign_id')]);

      
  }
  // publicar la página

  $pr->updateFields(['publish_status' => 1, 'publish_date' => date('Y-m-d H:i:s')]);



  // Ahora la galeria 
  // $data = new Cms_Model_Data(Cms_Cms::getDbConnection());
  // $data->select()->where(' site_page_id =' . $pr->get('id') . ' and foreign_model = "Cms_Model_ImageCollection" and structure_field_id = 14')->runSelect();
  // $data_es = new Cms_Model_Data(Cms_Cms::getDbConnection());
  // $data_es->select()->where(' site_page_id =' . $page_es->get('id') . ' and foreign_model = "Cms_Model_ImageCollection" and structure_field_id = 14')->runSelect();
  // echo "<p> set data {$data->get('id')} with data from {$data_es->get('id')} <p>";
  // $data->updateFields(['foreign_id' => $data_es->get('foreign_id')]);
}
