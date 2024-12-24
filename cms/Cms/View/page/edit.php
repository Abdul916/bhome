<?php
Cms_View_Template::instace()->addJavascript('core-includes/javascript/vendor/jquery/jquery-1.7.min.js');
Cms_View_Template::instace()->addCss('Cms/includes/css/uploadify.css');
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/library/app.js');

// Backbone
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/vendor/backbone/v0.9.2/underscore-min.js');
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/vendor/backbone/v0.9.2/backbone-min.js');

Cms_View_Template::instace()->addJavaScript('Cms/includes/backbone/model/DynamicData.js');
Cms_View_Template::instace()->addJavaScript('Cms/includes/backbone/collection/DynamicDatas.js');

Cms_View_Template::instace()->addJavaScript('core-includes/javascript/vendor/jqueryui/js/jquery-ui-1.8.16.custom.min.js');
Cms_View_Template::instace()->addCss('core-includes/javascript/vendor/jqueryui/css/smoothness/jquery-ui-1.8.16.custom.css');

Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/json2.js');

Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/uploadify2.1.4/swfobject.js');
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/uploadify2.1.4/jquery.uploadify.v2.1.4.min.js');

Cms_View_Template::instace()->addJavaScript('Cms/includes/tinymce/jscripts/tiny_mce/tiny_mce.js');
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/cms_form.php?site_id='.$site->get('id'));

Cms_View_Template::instace()->addJavaScript('core-includes/javascript/library/modal.js');
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/jqModal/jqModal.js');
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/orderGallery.js');
Cms_View_Template::instace()->addJavaScript('//maps.google.com/maps/api/js?sensor=false');
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/gmap_manager.js');
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/library/fetch.js');
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/library/multi-upload.js');
//Cms_View_Template::instace()->printAfterHeader('<script type="text/javascript" src=""></script>');

Cms_View_Template::instace()->getHeader();
?>

<script type="text/javascript">
var fieldsCount = 0;
function loadImages(lista, icollection)
{
	$(lista).load('index.php?a=cms&c=imageCollection:jximagecollection&id='+ icollection+'&site_id=' + <?php echo $site->get('id'); ?>, function(){
		setOrderBtnAction("#btn_order"+icollection);
	});
}
function reloadimageslist(lista, icollection)
{
	$(lista)
	{
		setTimeout("loadImages('"+ lista+ "', '"+icollection+ "');",1000);
	}
}
function addFormField(section , id)
{
	var fields = '<p id="fild'+fieldsCount+'"><input type ="text" id="dcoll" name="dcoll[]" > : <input type ="text" id="dval" name="dval[]" >';
	
	$(section).append(fields +" <a href='#' onClick='removeFormField(\"#fild" + fieldsCount + "\"); return false;'>Remove</a><p>");
	fieldsCount++;
}
function removeFormField(id) {
	$(id).remove();
}
function removeImage(id)
{
	$.post("<?php Core_Common_Route::linkController('image:jxdelete'); ?>", { image_id: id, time: "2pm" },
	   function(data){
			$('#img' + id).remove();
	   });
}
function editImage()
{
	
}
$(document).ready( function(){
	$(".datepicker").datepicker( {changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd'});
});
</script>

<div id="app">
  <div class="content">
    <h2 class="bc">
	<a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> 
	&gt; <?php echo $section->get('name'); ?> &gt; 
	<?php if( is_object($parentPage) && $parentPage->count() > 0): ?>
	<a href="<?php Core_Common_Route::linkController('page:childs', array('id' => $parentPage->get('id'), 'site_id' => $site->get('id'))); ?>"><?php echo $parentPage->get('name'); ?></a> &gt; 
	<?php endif; ?>
	<?php echo ucwords(strtolower($page->get('name'))); ?> &gt; Editar página</h2>
    <div class="form">
      <form action="<?php Core_Common_Route::linkController('page:edit', array('id' => $page->get('id'))); if(isset($_GET['lang_parent']) && is_numeric($_GET['lang_parent'])){ echo 'lang_parent='.$_GET['lang_parent']; } ?>" class="app" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <fieldset class="vertical">
          <h3><a id="new-product" href="#new-product">Edición de página, versión
            <?php if($language_parent){ echo $language->get('name'); }else{ echo 'español.';} ?>
            </a></h3>
          
          <ul>
            <li>
              <div class="label">
              		
                <label for="page_name">Nombre de la página: </label>
                <p class="description">Titulo de esta página.</p>
              </div>
              <div class="cell">
                <input type="text" name="page_name" value="<?php echo $page->get('name'); ?>" />
              </div>
              <div class="clear"></div>
            </li>
			<li>
              <div class="label">
                <label for="parent_page">URL: </label>
              </div>
              <div class="cell">
                <a style="font-size:12px; color:#666;" 
					target="_blank" 
					href="http://<?php echo $_SERVER['SERVER_NAME']; echo $frontPage->getURL(); ?>">http://<?php echo $_SERVER['SERVER_NAME']; echo $frontPage->getURL(); ?></a>
				
              </div>
            </li>
			<?php if(Cms_Cms::getConfig($site->get('id'), 'enable_mobile')): ?>
			<li>
              <div class="label">
                <label for="parent_page">URL Móvil: </label>
              </div>
              <div class="cell">
                
				<a style="font-size:12px; color:#666;" target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME']; echo '/m'.$frontPage->getURL(); ?>">http://<?php echo $_SERVER['SERVER_NAME']; echo '/m'.$frontPage->getURL(); ?></a>
              </div>
            </li>
			<?php endif; ?>
            <li>
              <div class="label">
                <label for="parent_page">Jerarquía de la página: </label>
              </div>
              <div class="cell">
                <div class="path">
                  <?php foreach($breadcrum as $parent): ?>
                  <?php echo $parent->get('name'); ?> &gt;
                  <?php endforeach;
					echo $page->get('name');
				  ?>
                  <a href="#" class="parentselector">Cambiar padre</a> </div>
              </div>
            </li>
			<?php if($fields->isCollection()): ?>
            <?php foreach($fields as $field): ?>
            <li>
              <div class="label">
              	   <label for=""><?php echo $field->get('name'); ?></label>
              </div>
              <div class="cell">
                              <?php
								$value = '';
								$dataModel = $data->getModelForFieldId($field->get('id'));
								
								$attributes = null;
								if($dataModel)
								{
									$value = $dataModel->getValue();
									$fieldName = 'field['.$field->get('id').']';

									if($field->get('field_type') == Cms_Model_StructureField::IMAGE_FIELD)
									{
										$fieldName = $field->get('unique_key');
										$value = '';
									}
									if($field->get('field_type') == Cms_Model_StructureField::IMAGE_COLLECTION_FIELD)
									{
										$fieldName = 'field'.$field->get('id');
										$value = $dataModel->get('foreign_id');
										$attributes['data_id'] = $dataModel->get('id');
									}
									if($field->get('field_type') == Cms_Model_StructureField::DATA_COLLECTION_FIELD)
									{
										$fieldName = 'field'.$field->get('id');
										$value = $dataModel->get('foreign_id');

										$datacollection = new Cms_Model_DataCollection( Cms_Cms::getDbConnection());
										$datacollection->find($dataModel->get('foreign_id'));
										$dfields = $datacollection->getDynamicFields();
										
										if($dfields->isCollection()):
											foreach($dfields as $dfield):
										?>
                <p id="fild<?php echo $dfield->get('id'); ?>">
                  <input type ="text" id="dcoll" name="dfield[<?php echo $dfield->get('id'); ?>]" value="<?php echo $dfield->get('label'); ?>" style="font-weight:bold" /> 
                  :
                  <input type ="text" id="dvalue" name="dvalue[<?php echo $dfield->get('id'); ?>]" value="<?php echo $dfield->get('value'); ?>" />
                  <a href="#" class="dfield-delete-btn" data-field-id="<?php echo $dfield->get('id'); ?>">Borrar</a>

                <p>

                  <?php
											endforeach;
										endif;
									}
									
									if($field->get('field_type') == Cms_Model_StructureField::LINK_FIELD)
									{
										$attributes = array();
										$attributes['page_id'] = $page->get('id');
										$fieldName1 = 'field-'.$field->get('id').'-title';
										
										if(is_object($value))
										{
											if($value->hasPage())
												echo '<p class="linkactual">
											Link a: <strong>'. $value->getPage()->get('name').'</strong> 
											<input name ="'.$fieldName1.'" value ="'.$value->getTitle().'" type="hidden" />
											<em>index.php?seccid='.$value->getPage()->get('site_section_id').'&pageid='.$value->getPage()->get('id').'</em></p>';

										}
									}
									if($field->get('field_type') == Cms_Model_StructureField::DROPDOWN_FIELD)
									{
										$value = $dataModel->getValue();
									}

									// imprimir el campo
									
									echo Cms_Library_FieldsHelper::getField( $field->get('field_type'),
												$fieldName,
												$value,
												$site->get('id'),
												$page,
												$field,
												$attributes);

									if($field->get('field_type') == Cms_Model_StructureField::IMAGE_FIELD)
									{
										
										$imagen = new Cms_Model_Image( Cms_Cms::getDbConnection());
										
										if(is_numeric($dataModel->get('foreign_id')) && $dataModel->get('foreign_id') > 0)
										{
											// Check if image is realted to some other page
											$neighbors = new Cms_Model_Data( Cms_Cms::getDbConnection());
											$neighbors->select()->where('foreign_id ='. $dataModel->get('foreign_id'))
													 ->where(' and foreign_model = '. '"Cms_Model_Image"')
													 ->runSelect();
											$ids = array_map(function($e){ return $e->site_page_id; }, $neighbors->getArray());
											$page_id = $dataModel->get('foreign_id');
											$ids = array_filter( $ids, function($id) use ($page_id) { return $id != $page_id;});

											$neighbords_ids = implode(', ', $ids);

											$imagen->find($dataModel->get('foreign_id'));
											$enableGd2 = Cms_Cms::getConfig($site->get('id'), 'enable_gd2');
											if($enableGd2)
											{
												$imagepath = $imagen->get('sys_thumbnail');
											}else{
												$imagepath = '/'.$imagen->get('file_path');
											}
											echo '<br /><img src ="'.$imagepath.'" width="100" class="thumb_img" />';
											echo "<p>Imagen compartida con páginas: {$neighbords_ids}</p>";
										}
									}
									if($field->get('field_type') == Cms_Model_StructureField::GMAP_FIELD)
									{
										
									}
								}else{
									
									echo Cms_Library_FieldsHelper::getField( $field->get('field_type'),
										$field->get('unique_key'),
										null,
										$site->get('id'),
										$page,
										$field,
										null);
									}
								?>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </fieldset>
		<fieldset class="vertical">
			<h3><a id="seo" href="#seo">Información para Buscadores de internet</a></h3>
			<ul>
				<li><div class="label"><label>Descripción:</label>
						<p class="description">Descripción corta del contenido de la página.<br /><strong>No incluir html</strong></p>
						</div>
					<div class="cell"><textarea name="meta_description"><?php echo $page->get('meta_description'); ?></textarea></div>
					<div class="clear"></div>
				</li>
				<li><div class="label"><label>Keywords</label>
						<p class="description">Palabras clave referentes al contenido de esta página. Deben separarse por coma.<br /><strong>No incluir html</strong></p>
						</div>
					<div class="cell"><textarea name="meta_keywords"><?php echo $page->get('meta_keywords'); ?></textarea></div>
					<div class="clear"></div>
				</li>
			</ul>
		</fieldset>

        <fieldset class="options">
          <ul>
            <li>
              <div class="label">
                <label></label>
              </div>
              <input type="hidden" name="page_id" value="<?php echo $page->get('id'); ?>" id="page_id" />
              <input type="hidden" name="process" value="page:update" id="process" />
              <input type="submit" name="Enviar" value="Actualizar" />
            </li>
          </ul>
        </fieldset>
      </form>
    </div>
  </div>
  <div class="menu">
    <a href="<?php Core_Common_Route::linkController('page:add', array('id' => $section->get('id'), 'site_id' => $site->get('id'))); ?>" id="create_new_page" class="button">Nueva página en misma categoría</a>
    <div class="options">
      <div class="infobox">
        <div class="title">
          <h3>Status de la página</h3>
        </div>
        <div class="boxcontent">
          <div id="publishresponce"><br>
			<p>ID: <?php echo $page->get('id'); ?></p>
			<p>Template: <?php echo $structure->get('name'); ?></p>

			<form action="#" method="post" accept-charset="utf-8">
				<p>Fecha de publicación (YYYY-MM-DD): </p>
				<p><input type="text" name="publish_date" value=" <?php echo $page->get('publish_date'); ?>" id="publish_date" class="datepicker" /></p>
				<div id="publis_date_alert"></div>
				<p><a href="#" id="publication_date" class="button jx_update_publish_date datepicker">Actualizar fecha de publicación</a><br /></p>
			</form>


            <?php if( ! $page->get('publish_status')): ?>
            <p>Esta página no es publica</p>
            <p><a href="<?php Core_Common_Route::linkController('page:jxswitchpublicstatus', array('page_id' => $page->get('id'))); ?>" class="ajax" rel="publishresponce">Publicar página</a></p>
            <?php endif; ?>
            <?php if($page->get('publish_status') == 1): ?>
            <p>Esta página es publica</p>
            <p><a href="<?php Core_Common_Route::linkController('page:jxswitchpublicstatus', array('page_id' => $page->get('id'))); ?>" class="ajax" rel="publishresponce">No publicar esta página</a></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
	<?php // var_dump($languages); ?>
    <?php if($languages->count() > 0 && !isset($_GET['lang_parent']) && !$page->get('lang_main_page_id')): ?>
	    <?php foreach($languages as $lang): ?>
	    <?php
			$verbo = 'Crear ';
			$action = 'add';
			$langSecc = $section->getForLanguage( $lang->get('code'));
		
			$vars = array('id' => $langSecc->get('id') , 'site_id' => $site->get('id'), 'lang_main' => $page->get('id'), 'lang_code' => $lang->get('id'));
			$pagebegins = $page->getLanguageVersion($lang);
		
			if($pagebegins->count() > 0)
			{
				// la página en este idioma ya se ha hecho
				$verbo = 'Editar ';
				$action = 'edit';
				$vars = array('id' => $pagebegins->get('id'), 'lang_parent' => $page->get('id'));
			}
			$parent_lang_val_ready = false;
			
			if( is_object($parentPage) && $parentPage->count() > 0)
			{
				$parent_lang_val = $parentPage->getLanguageVersion($lang);
				if($parent_lang_val->count() > 0)
				{
					$parent_lang_val_ready = true;
				}
			}
			//echo '4. ';
			
			if(($page->get('parent_page_id') == 0 || $page->get('parent_page_id') == null) || $parent_lang_val_ready || $pagebegins->count() > 0):
			
			?>
	    <a href="<?php Core_Common_Route::linkController('page:'.$action, $vars) ?>" id="create_related_lang" class="button"><?php echo $verbo; ?> contenido en <?php echo $lang->get('name'); ?></a>
	    <?php 
			endif;
		

			if(($page->get('parent_page_id') != 0 && $page->get('parent_page_id') != null) && !$language_parent && !$parent_lang_val_ready):
		?>
		<p>Para poder crear la página en idioma <?php echo $lang->get('name'); ?>, 
		antes debes crear la versión en <?php echo $lang->get('name'); ?> de <?php echo $parentPage->get('name');?></p>
		<?php
		endif;
		
	endforeach; ?>
    <?php endif; ?>
    <?php if(isset($_GET['lang_parent']) || $page->get('lang_main_page_id') > 0):
		if(isset($_GET['lang_parent']))
		$parent_page_id = $_GET['lang_parent'];
		else
		$parent_page_id = $page->get('lang_main_page_id');
?>
    <a href="<?php Core_Common_Route::linkController('page:edit', array('id' => $parent_page_id)) ?>" id="create_related_lang" class="button">Regresar</a>
    <?php endif; ?>
  </div>
</div>
<form action="<?php Core_Common_Route::linkController('page:edit', array('id' => $page->get('id'))); ?>" method="post" accept-charset="utf-8" name="update_page_structure" id="update_page_structure">
  <input type="hidden" name="page_id" value="<?php echo $page->get('id'); ?>" id="page_id">
  <input type="hidden" name="parent_page_id" value="" id="parent_page_id">
  <input type="hidden" name="parent_section_id" value="" id="parent_section_id">
  <input type="hidden" name="process" value="page:assignParentPage" id="process" />
</form>
<div class="jqmWindow" id="ex2"> Espere... <img src="images/loading.gif" alt="loading" /> </div>
<?php
	echo Cms_View_Template::instace()->getAfterHeader();
	?>

<script type="text/javascript" charset="utf-8">
	$('#ex2').jqm({ajax: '<?php Core_Common_Route::linkController('page:parentSelector', array('site_id' => $site->get('id'), 'page_id' => $page->get('id'), 'type' => 'submit')) ?>', trigger: 'a.parentselector'});

	setAjaxLinks();

	console.log($('.jx_update_publish_date'));

	$('.jx_update_publish_date').click( function(){

		var data = {publish_date: $('#publish_date').val(), page_id: <?php echo $page->get('id'); ?>};
		
		$.post('<?php Core_Common_Route::linkController('page:jx_updatePublishDate'); ?>', data, function(){
			$('#publis_date_alert').html('<p>Fecha de publicación actualizada</p>');
		});
		return false;
	});

	var dynamicDataCollection = new DynamicDatas(<?php if(isset($dfields) && is_object($dfields)){ echo $dfields->toJson(); } ?>);
	dynamicDataCollection.each( function(model){
		model.set('view', $('#fild' + model.get('id')));
	}, this);
	if($('.dfield-delete-btn').length > 0)
	{
		$('.dfield-delete-btn').click( function(event){
			var e = $(this);
			if(!confirm("¿Estas seguro de borrar este elemento?")) return false;
			var dfield = dynamicDataCollection.get(e.data('field-id'));
			//console.log(e.data('field-id'), dynamicDataCollection.get(e.data('field-id')));
			var v = dfield.get('view');
			dfield.destroy({
				success: function (model) {
					//console.log('BORRADO', model, v);
					v.fadeOut(500, function() { $(this).remove(); });
				}
			});
			event.preventDefault();
		});
	}
	
</script>
<?php
Cms_View_Template::instace()->getFooter();
?>
