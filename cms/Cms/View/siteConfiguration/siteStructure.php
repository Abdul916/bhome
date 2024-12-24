<?php
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
				<form action="<?php Core_Common_Route::linkController('siteConfiguration:siteStructure', array('id' => $site->get('id'))) ?>" class="app"method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Páginas Template</a></h3>
					</fieldset>
					<h4>Las siguientes estructurás de contenido estan activas:</h4>
					<div class="stdFormTable">
						<table>
							<thead>
								<tr>
									<th>Nombre de template</th>
									<th>Descripción</th>
									<th></th>
								</tr>
							</thead>
							<?php if($structures->count() > 0): ?>
							<tbody>
								<?php foreach($structures as $structure): ?>
								<tr>
									<td><?php echo $structure->get('name'); ?></td>
									<td><?php echo $structure->get('description'); ?></td>
									<td class="opt"><a href="<?php Core_Common_Route::linkController('pageStructure:detail', array('id' => $structure->get('id') , 'site_id' => $site->get('id'))) ?>">Administrar</a></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php endif; ?>
							<?php if($structures->count() == 0): ?>
							<tfoot>
								<tr>
									<td colspan="2">
										<div class="empty-list">
										No tienes templates de contenido para tu sitio.
										</div></td>
								</tr>
							</tfoot>
							<?php endif; ?>
						</table>
					</div>
					<fieldset>
						<h3><a id="new-product" href="#new-product">Agregar un nuevo producto</a></h3>
						<ul>
							<li>
								<div class="label"><label for="name">Nombre template</label></div>
								<div class="cell"><input type="text" id="name" name="name" /></div>
							</li>
							<li>
								<div class="label"><label for="description">Descripción</label></div>
								<div class="cell"><textarea name="description" id="description" cols="30" rows="10"></textarea></div>
							</li>
						</ul>
					</fieldset>
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
								<input type="hidden" name="site_id" value="<?php echo $site->get('id'); ?>" />
								<input type="hidden" name="process" value="pageStructure:save" />
								<input type="submit" name="Enviar" value="Crear" /></li>
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
<?php
Cms_View_Template::instace()->getFooter();
?>