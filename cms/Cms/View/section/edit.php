<?php
Cms_View_Template::instace()->addJavascript('core-includes/javascript/vendor/jquery/jquery-1.7.min.js');
Cms_View_Template::instace()->addJavascript('core-includes/javascript/library/app.js');
Cms_View_Template::instace()->getHeader();
?>

	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt; Actualización de sección</h2>
			
			<div class="form">
				<form action="<?php Core_Common_Route::linkController('section:edit', array('id' => $section->get('id') , 'site_id' => $site->get('id'))); ?>" class="app" method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Actualiza la información de la sección</a></h3>
						<ul>
							<li>
								<div class="label"><label for="page_name">Nombre de la sección</label></div>
								<div class="cell"><input type="text" name="name" value="<?php echo $section->get('name'); ?>" /></div>
							</li>
							<li>
								<div class="label"><label for="page_name">Template default</label>
									<p class="description">Las páginas de la sección tendrán esta estructura por default.</p>
									</div>
								<div class="cell">
									<select name="page_structure_id">
										<?php if($pageStructures->count() > 0): ?>
											<?php foreach($pageStructures as $pStructure): ?>
												<?php $sel = ''; if($section->get('page_structure_id') == $pStructure->get('id')){ $sel = ' selected="selected"'; }?>
											<option value="<?php echo $pStructure->get('id'); ?>"<?php echo $sel; ?>><?php echo $pStructure->get('name'); ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
										<?php ?>
									</select>
								</div>
								<div class ="clear"></div>
							</li>
							<li>
								<div class="label">
									<label for="publish_status">Publicar la sección:</label>
									<p class="description">Marcar si quiere que la sección se publique de inmediato. (Sin contenido)</p>
								</div>
								<div class="cell">
									<input type="checkbox" value="1" name="publish_status" id="publish_status"<?php if($section->get('publish_status') == 1){ echo ' checked="checked"'; } ?> />
								</div>
								<div class="clear"></div>
							</li>
						</ul>
					</fieldset>
					
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
							<input type="hidden" name="site_id" value="<?php echo $site->get('id'); ?>" id="site_id" />
							<input type="hidden" name="process" value="section:update" id="process" />
							<input type="hidden" name="section_id" value="<?php echo $section->get('id'); ?>" id="section_id" />
							<input type="submit" name="Enviar" value="Actualizar" /></li>
						</ul>
					</fieldset>
				</form>
				<?php if($languages->count() > 0): ?>
				<form action="<?php Core_Common_Route::linkController('section:edit', array('id' => $section->get('id'), 'site_id' => $site->get('id'))) ?>" class="app" method="get" accept-charset="utf-8">
					
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Nombre de la sección en idiomas</a></h3>
						<ul>
							<?php foreach($languages as $language): ?>
								<?php
								
								$secc = $section->getForLanguage( $language->get('code'));
								$arr = array('section_id' => $secc->get('id'), 'site_id' => $site->get('id'), 'lang_id' => $language->get('id'));
								if($secc->count() == 0)
								{
									// la seccion no existe, crearla
									$arr = array('new_section' => 1, 'lang_id' => $language->get('id'), 'site_id' => $site->get('id'), 'parent_section_id' => $section->get('id'));
								}
								?>
							<li>
								<div class="title"><label for="page_name">Nombre de la sección en <?php echo $language->get('name'); ?></label></div>
								<div class="cell"><h5><a href="<?php Core_Common_Route::linkController('section:jxupdatename', $arr); ?>" class="inline_edit"><?php echo $secc->get('name'); ?></a></h5></div>
							</li>
							<?php endforeach; ?>
						</ul>
					</fieldset>
					
				</form>
				<?php endif; ?>
			</div>
			
		</div>
		<div class="menu">
		
		</div>
	</div>
<script type="text/javascript" charset="utf-8">
	setInlineEdition();
</script>
<?php
Cms_View_Template::instace()->getFooter();
?>