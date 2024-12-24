<?php
header('Content-type: text/javascript');


function layr_autoload( $class_name)
{
  $path = str_replace("_", "/", $class_name);

	if(!is_file("../../../".$path.".php"))
		$path = 'Vendor/'.$path;
		
    require_once "../../../".$path.".php";
}
spl_autoload_register('layr_autoload');

$site_id = ( isset($_GET['site_id']) && is_numeric($_GET['site_id']) && $_GET['site_id'] > 0) ? $_GET['site_id'] : 0;
$site = new Cms_Model_Site( Cms_Cms::getDbConnection());
$site->find($site_id);

?>
tinyMCE.init({
	mode : "specific_textareas",
	theme : "advanced",
	editor_selector : "tinymce",
	object_resizing : true,
	plugins : "table,advhr,advimage,advlink,media,searchreplace,print,paste,nonbreaking,xhtmlxtras,contextmenu",
	// Theme options
	theme_advanced_buttons1_add_before : "newdocument,separator",
	theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle",
	theme_advanced_buttons2_add_before: "cut,copy,separator,",
	theme_advanced_buttons3_add_before : "tablecontrols",
	theme_advanced_buttons3_add : "media",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	extended_valid_elements : "a[class|width|size|noshade|data|href|target]",

	content_css : "<?php echo Cms_Cms::getConfig($_GET['site_id'], 'admin_url'); ?>cms_includes/tinymce.css",
	
	theme_advanced_source_editor_width : 600,
	theme_advanced_source_editor_height : 350,
	theme_advanced_resizing : true,
	file_browser_callback : "ajaxfilemanager",
	document_base_url : "<?php echo Cms_Cms::getConfig($_GET['site_id'], 'site_domain'); ?>",
	relative_urls : false,
	remove_script_host : false,
	site_id: <?php echo $site->get('id'); ?>
});

function ajaxfilemanager(field_name, url, type, win) {

	var ajaxfilemanagerurl = "<?php echo Cms_Cms::getConfig($_GET['site_id'], 'admin_url'); ?>Cms/includes/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";

	switch (type) {
		case "image":
			break;
		case "media":
			break;
		case "flash": 
			break;
		case "file":
			break;
		default:
			return false;
	}
          tinyMCE.activeEditor.windowManager.open({

              url: "<?php echo Cms_Cms::getConfig($_GET['site_id'], 'admin_url'); ?>Cms/includes/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",

              width: 782,
              height: 440,
              inline : "yes",
              close_previous : "no"
          },{
              window : win,
              input : field_name
          });
          
/*            return false;			
	var fileBrowserWindow = new Array();
	fileBrowserWindow["file"] = ajaxfilemanagerurl;
	fileBrowserWindow["title"] = "Ajax File Manager";
	fileBrowserWindow["width"] = "782";
	fileBrowserWindow["height"] = "440";
	fileBrowserWindow["close_previous"] = "no";
	tinyMCE.openWindow(fileBrowserWindow, {
	  window : win,
	  input : field_name,
	  resizable : "yes",
	  inline : "yes",
	  editor_id : tinyMCE.getWindowArg("editor_id")
	});
	
	return false;*/
}
