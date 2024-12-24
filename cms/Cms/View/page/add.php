<?php
Cms_View_Template::instace()->addJavascript('core-includes/javascript/vendor/jquery/jquery-1.7.min.js');
Cms_View_Template::instace()->addJavascript('core-includes/javascript/vendor/jqueryui/js/jquery-ui-1.8.16.custom.min.js');
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/vendor/swfobject/swfobject.js');
Cms_View_Template::instace()->addCss('core-includes/javascript/vendor/jqueryui/css/smoothness/jquery-ui-1.8.16.custom.css');



Cms_View_Template::instace()->addJavaScript('Cms/includes/tinymce/jscripts/tiny_mce/tiny_mce.js');
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/jqModal/jqModal.js');

Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/cms_form.php?site_id='.$site->get('id'));
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/gmap_manager.js');
Cms_View_Template::instace()->printAfterHeader('<script type="text/javascript" src="//maps.google.com/maps/api/js?v=3.1&sensor=false"></script>');
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/page-add.js');
Cms_View_Template::instace()->getHeader();
?>
<script type="text/javascript">
var fieldsCount = 0;
function addFormField(section , id)
{
	var fields = '<p id="fild'+fieldsCount+'"><input type ="text" id="dcoll" name="dcoll[]" > : <input type ="text" id="dval" name="dval[]" >';
	
	$(section).append(fields +" <a href='#' onClick='removeFormField(\"#fild" + fieldsCount + "\"); return false;'>Remove</a><p>");
	fieldsCount++;
}
function removeFormField(id) {
	$(id).remove();
}
jQuery(document).ready(function($) {
	$('.datepicker').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
});

</script>

	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> 
				&gt; <?php echo $section->get('name'); ?> 
				&gt; <?php if($language_parent){ echo $language_parent->get('name'). ' &gt; '; } ?> 
				Crear una nueva página <?php if($language){ echo ' en '.$language->get('name'); } ?></h2>

			<div class="form">
				<form action="<?php
				$vars = array('id' => $site->get('id'));
				$controller = 'site:general';
				if(is_object($parent_page) && $parent_page->count() > 0){
					$vars['site_id'] = $site->get('id');
					$vars['id'] = $parent_page->get('id');
					$controller = 'page:childs';
				}
				Core_Common_Route::linkController( $controller, $vars);
				?>" class="app" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Nueva página <?php if($language){ echo $language->get('name'); } ?></a></h3>
						
						<ul>
							<li>
								<div class="label"><label for="page_name">Nombre de la página</label>
								<p class="description">Este nombre sera parte de la url de la página</p></div>
								
								<div class="cell"><input type="text" name="page_name" value="" /></div>
								<div class="clear"></div>
							</li>
							<li>
								<div class="label"><label>Publicar</label></div>
								<div class="cell">
									<label> <input type="checkbox" name="publish_status" value="1" id="publish_status" class="" /> Publicar esta página </label><br />
									
								</div>
							</li>
							<li class="publish_date_input">
								<div class="label"><label>Fecha de publicación</label>
									<p class="description">(YYYY-MM-DD)</p></div>
								<div class="cell"><input type="text" name="publish_date" class="date" value="<?php echo Core_Base_Date::getDate(); ?>" id="publish_date" /></div>
							</li>
							
							<?php if($fields->isCollection()): ?>
							<?php foreach($fields as $field): ?>
								<?php if($field->get('field_type') != Cms_Model_StructureField::IMAGE_COLLECTION_FIELD): ?>
								<li>
									<div class="label"><label for=""><?php echo $field->get('name'); ?></label></div>
									<div class="cell"><?php
										echo Cms_Library_FieldsHelper::getField( $field->get('field_type'), $field->get('unique_key'), null, null, null, $field);
									?></div>
								</li>
								<?php endif; ?>

							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</fieldset>

					<fieldset class="vertical">
						<h3><a id="seo" href="#seo">Información para Buscadores de internet</a></h3>
						<ul>
							<li><div class="label"><label for="meta_description">Descripción:</label>
									<p class="description">Descripción corta del contenido de la página.<br /><strong>No incluir html</strong></p>
									</div>
								<div class="cell"><textarea name="meta_description"></textarea></div>
								<div class="clear"></div>
							</li>
							<li><div class="label"><label for="meta_keywords">Keywords</label>
									<p class="description">Palabras clave referentes al contenido de esta página. Deben separarse por coma.<br /><strong>No incluir html</strong></p>
									</div>
								<div class="cell"><textarea name="meta_keywords"></textarea></div>
								<div class="clear"></div>
							</li>
						</ul>
					</fieldset>
					
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
							<input type="hidden" name="section_id" value="<?php echo $section->get('id'); ?>" id="section_id" />
							<input type="hidden" name="page_structure_id" value="<?php echo $structure->get('id'); ?>" id="page_structure_id" />
							<input type="hidden" name="process" value="page:save" id="process" />
							<?php
							$parent_page_id = 0;
							if(is_object($parent_page) && $parent_page->count() > 0):
							$parent_page_id = $parent_page->get('id');
							endif; ?>
							<input type="hidden" name="parent_page_id" value="<?php echo $parent_page_id; ?>" id="parent_page_id" />

							<!-- campos para idiomas-->
							<input type="hidden" name="lang_main_page_id" value="<?php if($language_parent){ echo $language_parent->get('id'); } ?>" id="lang_main_page_id" />
							<input type="hidden" name="lang_code" value="<?php if($language){ echo $language->get('code'); } ?>" id="lang_code" />
							<input type="hidden" name="site_language_id" value="<?php if($language){ echo $language->get('id'); } ?>" id="site_language_id" />
							<input type="hidden" name="site_id" value="<?php echo $site->get('id'); ?>" id="site_id">
							<input type="submit" name="Enviar" value="Guardar página" />
							<?php if($language_parent): ?>
							<a href="<?php Core_Common_Route::linkController('page:edit', array('id' => $language_parent->get('id'))) ?>" class="cancel">Cancelar</a>
							<?php endif; ?>
							</li>
						</ul>
					</fieldset>
					
				</form>
			</div>
		</div>
		<div class="menu">
			<?php if(!$language): ?>
			<div class="infobox">
				<div class="title"><h3>Template</h3></div>
				<div class="boxcontent">
					<p>Selecciona el template para esta página</p>
					<form action="index.php" method="get" accept-charset="utf-8">
						<select name="fsid" id="fsid">
							<?php foreach( $pageStructures as $pstrcut):
								$sel = ($pstrcut->get('id') == $structure->get('id')) ? ' selected="selected"' : '';
							?>
							<option value="<?php echo $pstrcut->get('id'); ?>" <?php echo $sel; ?>><?php echo $pstrcut->get('name'); ?></option>
							<?php endforeach; ?>
							</select>
							<input type="hidden" name="a" value="cms" id="c">
							<input type="hidden" name="c" value="page:add" id="c">
							<input type="hidden" name="id" value="<?php echo $section->get('id'); ?>" id="id">
							<input type="hidden" name="site_id" value="<?php echo $site->get('id'); ?>" id="site_id">
							<?php if(is_object($parent_page) && $parent_page->count() > 0): ?>
								<input type="hidden" name="parent_page" value="<?php echo $parent_page->get('id'); ?>" id="parent_page">
							<?php endif; ?>
						<p><input type="submit" value="Cambiar template &rarr;"></p>
					</form>
				</div>
			</div>
			
			
			
			<?php endif; ?>

		</div>
	</div>

<?php
Cms_View_Template::instace()->getFooter();
?>