<?php
Cms_View_Template::instace()->addJavascript('core-includes/javascript/vendor/jquery/jquery-1.7.min.js');
Cms_View_Template::instace()->addJavascript('core-includes/javascript/vendor/jquery/plugins/tablednd-0.5/jquery.tablednd_0_5.js');
Cms_View_Template::instace()->addJavascript('Cms/includes/javascript/pagestructure_detail.js');
Cms_View_Template::instace()->getHeader();
?>
	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt; <a href="<?php Core_Common_Route::linkController('siteConfiguration:index', array('id' => $site->get('id'))) ?>">Configuración</a> &gt; Templates</h2>
			
			<div id="tabs">
				<ul>
					<li><a href="<?php Core_Common_Route::linkController('siteConfiguration:index', array('id' => $site->get('id'))); ?>">Generales</a></li>
					<li><a href="<?php Core_Common_Route::linkController('siteConfiguration:siteStructure', array('id' => $site->get('id'))); ?>" class="selected">Templates</a></li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<!-- tab content -->
			<div class="form">
				<form action="<?php Core_Common_Route::linkController('pageStructure:detail', array('id' => $structure->get('id'), 'site_id' => $site->get('id'))) ?>" class="app"method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Template de <em><?php echo $structure->get('name'); ?></em></a></h3>
					</fieldset>
					<fieldset class="vertical">
						<ul>
							<li>
								<div class="label"><label>Nombre del template:</label></div>
								<div class="cell"><input type="text" name="template_html_path" value="<?php echo $structure->get('template_html_path'); ?>"/></div>
							</li>
						</ul>
					</fieldset>
					
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
								<input type="hidden" name="page_structure_id" value="<?php echo $structure->get('id'); ?>" />
								<input type="hidden" name="process" value="pageStructure:updateTemplate" />
								<input type="submit" name="Enviar" value="Guardar" /></li>
						</ul>

					</fieldset>
				</form>
				
				
				<form action="<?php Core_Common_Route::linkController('pageStructure:detail', array('id' => $structure->get('id'), 'site_id' => $site->get('id'))) ?>" class="app"method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Estructura de contenido para <em><?php echo $structure->get('name'); ?></em></a></h3>
					</fieldset>
					<h4>Los siguientes campos de contenido están activos:</h4>
					<div class="ajax_response" id="orderresponse"></div>
					<div class="stdFormTable">
						<table id="field_list">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Codigo en Template</th>
									<th>Tipo</th>
									<th>Descripción</th>
									<th></th>
								</tr>
							</thead>
							<?php if($fields->count() > 0): ?>
							<tbody>
								<?php foreach($fields as $field): ?>
								<tr id="<?php echo $field->get('id'); ?>">
									<td><?php echo $field->get('name'); ?></td>
									<td><?php echo $field->get('unique_key'); ?></td>
									<td><?php echo $field->fieldTypeToNoun($field->get('field_type')); ?></td>
									<td><?php echo stripslashes($field->get('description')); ?></td>
									<td class="opt"><a href="<?php Core_Common_Route::linkController('pageStructure:detail', array('id' => $field->get('id') , 'site_id' => $site->get('id'))) ?>">Administrar</a></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php endif; ?>
							<?php if($fields->count() == 0): ?>
								<tfoot>
									<tr><td colspan="3"><div class="empty-list"><?php echo $structure->get('name')?> no tiene campos de contenido.</div></td></tr>
								</tfoot>
							<?php endif; ?>
						</table>
						
						<div class ="clear"></div>
					</div>
					<a class="button" onClick="saveneworden();">Guardar Orden</a>
					<fieldset>
						<h3><a id="new-product" href="#new-product">Agregar un nuevo campo de contenido:</a></h3>
						<ul>
							<li>
								<div class="label"><label for="name">Nombre campo:</label></div>
								<div class="cell"><input type="text" id="name" name="name" /></div>
							</li>
							<li>
								<div class="label"><label for="name">Descripción del campo:</label></div>
								<div class="cell"><input type="text" id="description" name="description" /></div>
							</li>
							<li>
								<div class="label"><label for="description">Tipo de campo</label></div>
								<div class="cell">
									<select name="field_type">
										<?php
										$nouns = $fieldtemplate->getNounsArray();
										foreach($nouns as $key => $title):
										?>
										<option value="<?php echo $key; ?>"><?php echo $title; ?></option>
										<?php endforeach; ?>
									</select>
									</div>
							</li>
						</ul>
					</fieldset>
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
								<input type="hidden" name="page_structure_id" value="<?php echo $structure->get('id'); ?>" />
								<input type="hidden" name="process" value="structureField:save" />
								<input type="submit" name="Enviar" value="Crear nuevo campo" /></li>
						</ul>

					</fieldset>
				</form>
			</div>
			<!-- / tab content -->
			
		</div><!-- end div.content -->
		<div class="menu">
		<a href="<?php Core_Common_Route::linkController('section:add', array('id' => $site->get('id')) ); ?>" id="create_new_product" class="button">Crear nueva Sección</a>
		<a href="<?php Core_Common_Route::linkController('siteConfiguration:index', array('id' => $site->get('id')) ); ?>" id="create_new_product" class="button">Configurar Sitio</a>
		</div>
	</div>
	<input type="hidden" name="structure_id" value="<?php echo $structure->get('id'); ?>" id="structure_id">
	<input type="hidden" name="site_id" value="<?php echo $site->get('id'); ?>" id="site_id">
<?php
Cms_View_Template::instace()->getFooter();
?>