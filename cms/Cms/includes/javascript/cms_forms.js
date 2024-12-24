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
	extended_valid_elements : "hr[class|width|size|noshade]",

	theme_advanced_source_editor_width : 600,
	theme_advanced_source_editor_height : 350,
	theme_advanced_resizing : true,
	file_browser_callback : "ajaxfilemanager",
	document_base_url : "http://ica.in/",
	relative_urls : false,
	remove_script_host : false,
	site_id: 2
});


function ajaxfilemanager(field_name, url, type, win) {
	var ajaxfilemanagerurl = "/fisg/admin/includes/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
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
              url: "/fisg/admin/includes/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
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