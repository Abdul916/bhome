<?php

/**
*
*/
class Cms_Library_FieldsHelper
{

	static function textField( $name, $value, $attributes)
	{
		$tag= Cms_Library_FieldsHelper::closeTag('input', $attributes);
		$val = '';
		if($value && !is_object($value))
		{
			$val = ' value ="'.$value.'" ';
		}
		return $tag.' name ="'.$name.'" '.$val.' />';
	}
	static function textAreaField( $name, $value, $attributes)
	{
		$tag= Cms_Library_FieldsHelper::closeTag('textarea', $attributes);
		$val = '';

		if($value)
		{
			$val = stripslashes($value);
		}
		return $tag.' name ="'.$name.'" >'.$val.'</textarea>';
	}
	static function closeTag($name, $attributes = null)
	{
		$attr = '';
		if(!$attributes || !is_array($attributes))
			return '<'.$name;

		foreach( $attributes as $attribute => $valor)
		{
			$attr.= $attribute.'= "'.$valor.'" ';
		}
		return "<$name $attr";
	}
	static function getField( $type, $name, $value, $site_id, $page = null, $field = null, $attributes = null)
	{
		$tag = '';

		switch($type){
			case 1:
				// campo de texto
				$tag = Cms_Library_FieldsHelper::textField( $name, $value, $attributes);
				break;
			case 2:
				$tag = Cms_Library_FieldsHelper::textAreaField( $name, $value, $attributes);
				break;
			case Cms_Model_StructureField::DATE_FIELD:
				$attributes = (is_array($attributes)) ? array_merge($attributes, array('class' => 'datepicker')) : array('class' => 'datepicker');
				$tag = '<label class="date">'.Cms_Library_FieldsHelper::textField( $name, $value, $attributes).'</label> <a';
				break;
			case Cms_Model_StructureField::RICH_TEXT_FIELD:
				$attributes['class'] = isset($attributes['class']) ? $attributes['class'].' tinymce' : ' tinymce';
				$style = '';
				if(isset($attributes['style']))
					$style = $attributes['style'];
				$attributes['style'] = $style.' width:100%; height:400px;';
				$value = stripslashes($value);
				$tag = Cms_Library_FieldsHelper::textAreaField( $name, $value, $attributes);
				break;
			case Cms_Model_StructureField::IMAGE_FIELD:
				$attributes['type'] = 'file';
				$vars = array('field' => $name);
				if($page && is_object($page))
				{
					$vars['page_id'] = $page->get('id');
				}
				$attributes['id'] = $name;
				$tag = Cms_Library_FieldsHelper::textField( $name, $value, $attributes);
				$tag.= '<div id="'.$name.'image"></div>';
				$tag.= '<p>Seleccione una imagen de su disco o <a href="#" rel="'.$name.'" class="imgsel-'.$name.'">busque una en la galería</a></p>';
				$tag.= '<div class="jqmWindow" id="img'.$name.'"> Espere... <img src="images/loading.gif" alt="loading" /> </div>';
				$tag.= '<script type="text/javascript">
				$("#img'.$name.'").jqm({ajax: "'.Core_Common_Route::getLinkController('image:popimages', $vars).'", trigger: "a.imgsel-'.$name.'"});
				</script>';
				break;
      case Cms_Model_StructureField::IMAGE_COLLECTION_FIELD:
        if (!is_array($attributes))
          $attributes = array();

        $attributes['type'] = 'file';
        $attributes['multiple'] = 'multiple';
				// $attributes['name'] = $attributes['name'] . '[]';
        $attributes['id'] = 'uploadify' . $name;
				//print_r($field);
        $tag = Cms_Library_FieldsHelper::textField($attributes['id'], null, $attributes);
        $tag = '<input data_id= "' . $attributes['data_id'] . '" type= "file"  
							data-url="Cms/upload/uploadify.php?id_siteid=' . $value . '-' . $site_id . '"
							data-galery_id = "' . $value . '"
							id= "' . $attributes['id'] . '"  name ="' . $attributes['id'] . '[]"  multiple /> 
							<span id="mess_' . $attributes['id'] . '"></span>';
        $tag .= "\n";
        $tag .= '<p id="galloptions" style="display:none"><a href="javascript:jQuery(\'#' . $attributes['id'] . '\').uploadifyUpload();" class="button">Subir Archivos</a> <a href="javascript:jQuery(\'#' . $attributes['id'] . '\').uploadifyClearQueue()" class="button">Borrar archivos</a></p>';
        $tag .= '<div id="' . $attributes['id'] . 'external"></div>';
        $tag .= '<p>Para subir imágenes a la galería de clic en el botón Subir imágenes o <a href="#" rel="' . $attributes['id'] . '" class="galsel-' . $attributes['id'] . '">busque una galería</a>.</p>';
        $tag .= "\n";
        $tag .= '<div class="jqmWindow" id="gal' . $attributes['id'] . '"> Espere... <img src="images/loading.gif" alt="loading" /> </div>';
        $tag .= '<div id="' . $attributes['id'] . 'list">listado de imagenes</div>';

        $tag .= '<script type="text/javascript">
					setGallery("' . $attributes['id'] . '");
				// 	$("#' . 'uploadify' . $name . '").uploadify({
				// 	\'uploader\'       : \'Cms/includes/javascript/uploadify2.1.4/uploadify.swf\',
				// 	\'script\'         : \'Cms/upload/uploadify.php?id_siteid=' . $value . '-' . $site_id . '\',
				// 	\'cancelImg\'      : \'Cms/includes/images/cross.png\',
				// 	\'buttonImg\'      : \'Cms/includes/images/imageupload.jpg\',
				// 	\'folder\'         : \'uploads\',
				// 	\'onAllComplete\'  : function(event, data){ reloadimageslist("#' . $attributes['id'] . 'list", ' . $value . '); },
				// 	\'onSelect\'         : function(event, data){ $("#galloptions").css({"display": "block"}); },
				// 	\'multi\'          : true,
				// 	\'scriptAccess\'   : \'sameDomain\'
				// });
				loadImages("#' . $attributes['id'] . 'list", ' . $value . ');
				$("#galloptions").hide();
				$("#gal' . $attributes['id'] . '").jqm({ajax: "' . Core_Common_Route::getLinkController('imageCollection:popgaleries', array('page_id' => $page->get('id'), 'field' => $attributes['id'], 'data_id' => $attributes['data_id'])) . '", trigger: "a.galsel-' . $attributes['id'] . '"});
				</script>';
        break;
			case Cms_Model_StructureField::DATA_COLLECTION_FIELD:
				$tag = '<div id="'.$name.$value.'">';
				$tag.= '</div>';
				$tag.= '<a href="javascript:addFormField(\'#'.$name.$value.'\', \''.$value.'\')">Agregar campo</a>';
				break;
			case Cms_Model_StructureField::CHECKBOX_FIELD:
				$attributes['type'] = 'checkbox';
				$attributes['id'] = $name;
				$attributes['name'] = $name;

				if($value == 1)
				{
					$attributes['checked'] = 'checked';
				}

				$tag = Cms_Library_FieldsHelper::textField( $attributes['id'], 1, $attributes);
				break;
			case Cms_Model_StructureField::LINK_FIELD:
				if(!is_array($attributes))
					$attributes = array();
				$page_id = 0;
				if($page != null)
				{
					$page_id = $page->get('id');
				}
				$tag = '<div class="linkfield">';

				$idname = Core_Base_String::plainString($name);

				$tag.= '<div id="'.$idname.'-ruta"></div>';
				$attributes['type'] = 'hidden';
				$attributes['id'] = $idname;
				$val = '';
				if(is_object($value))
					$val = $value->getPage()->get('id');
				$tag.= Cms_Library_FieldsHelper::textField( $name, $val, $attributes);

				if($value)
				{
					$value->getPage()->get('id');
				}
				$tag.= 'Link a página interna <a href="javascript:;" class="parentselector1'.$field->get('id').'">Seleccionar</a>';
				$tag.= '</div>';
				$script = '<script type="text/javascript" charset="utf-8">';
				$link = Core_Common_Route::getLinkController('page:parentSelector', array('site_id' => $site_id, 'page_id' => $page_id, 'type' => 'update', 'toupdate' => $idname.'-ruta', 'field' => $idname, 'title_field' => $idname.'-title', 'counter' => $idname."-counter"));
				$script.= "$('#".$idname."-counter').jqm({ajax: '".$link."', trigger: 'a.parentselector1".$field->get('id')."'});";
				$script.= '</script>';
				Core_App_View_Template::instace()->printAfterHeader('<div id="'.$idname.'-counter" class="jqmWindow"></div>');
				Core_App_View_Template::instace()->printAfterHeader($script);
				break;
			case Cms_Model_StructureField::DROPDOWN_FIELD:
				$tag = 'Error generando campo';
				if($field)
				{
					$desc = $field->get('description');
					$options = explode('|', $desc);
					$campo = '<select name="'.$name.'">';
					foreach( $options as $option)
					{
						$sel = ($option == $value) ? ' selected ="selected"' : '';
						$campo.= "\n<option value =\"".$option."\" ".$sel.">".$option.'</option>';
					}
					$tag = $campo.'</select>';
				}
				break;
			case Cms_Model_StructureField::GMAP_FIELD:
				if(!is_array($attributes))
					$attributes = array();
				$page_id = 0;
				if($page != null)
				{
					$page_id = $page->get('id');
				}
				$map_id = 0;
				$map = $value;
				$map_center = '';
				$zoom = '';
				$markers = null;
				if($value)
				{
					//error_log( print_r($map, true), 0);
					$map_id = $map->get('id');
					$map_center = Cms_Model_Map::PointToPosition($map->get('center_point'));
					$zoom = $map->get('zoom');
					$markers = $map->getMarkers();
				}
				
				$idname = Core_Base_String::plainString($name);
				$tag = '<div class="map">'.$idname;
				$tag.= '<div class="map_option"><a href="#" id="btn_add_pin">Agregar Pin</a></div>';
				$tag.= "\n";
				$tag.= '<div id="'.$idname.'-map" style="width: 550px; height: 400px;">Mapa</div>';
				$tag.= "\n";
				$tag.= '<div class="options"><div id="info"></div><div id="pins"></div><div id="uppins">';
				if($markers)
				{
					if($markers->count() > 0)
					{
						foreach($markers as $marker)
						{
							$point = Cms_Model_Map::PointToPosition($marker->get('location'));
							
							$tag.= '<input type="text" class="markers" name="'.$idname.'-up-map-pin['.$marker->get('id').']" value="'.$point.'">';
						}
					}
				}
				$tag.= '</div></div>';
				$tag.= "\n";
				$tag.= '<input type="hidden" name="'.$idname.'" id="'.$idname.'" value="'.$map_id.'" /> <label>Zoom: <input type="text" name="'.$idname.'-map_zoom" id="map_zoom" value="'.$zoom.'" /></label><label>Coord. Centro: <input type="text" name="'.$idname.'-map_center" id="map_center" value="'.$map_center.'" /></label>';
				$tag.= '</div>';$tag.= "\n";
				$tag.= '<script  type="text/javascript">'; $tag.= "\n";
				$tag.= '	initGMap("'.$idname.'-map", { scaleControl: true, position: null, zoom: 1, mapType: google.maps.MapTypeId.ROADMAP, markers: null})';
				$tag.= "\n";
				$tag.= '</script>';
				break;
			default:
				$tag = 'Tipo de texto no definido';
				break;
		}
		return $tag;
	}

}


?>
