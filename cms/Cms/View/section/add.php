<?php
Cms_View_Template::instace()->getHeader();
?>

	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt; Crear una nueva sección</h2>
			
			<div class="form">
				<form action="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>" class="app" method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Ingresa la información de la nueva sección</a></h3>
						
						<ul>
							<li>
								<div class="label"><label for="page_name">Nombre de la sección</label></div>
								<div class="cell"><input type="text" name="name" value="" /></div>
							</li>
							<li>
								<div class="label"><label for="page_name">Template default</label>
									<p class="description">Las páginas de la sección tendrán esta estructura por default.</p>
									</div>
								<div class="cell">
									<select name="page_structure_id">
										<?php if($pageStructures->count() > 0): ?>
											<?php foreach($pageStructures as $pStructure): ?>
												
											<option value="<?php echo $pStructure->get('id'); ?>"><?php echo $pStructure->get('name'); ?></option>
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
									<input type="checkbox" value="1" name="publish_status" id="publish_status" />
								</div>
								<div class="clear"></div>
							</li>
							
						</ul>
					</fieldset>
					
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
							<input type="hidden" name="site_id" value="<?php echo $site->get('id'); ?>" id="site_id" />
							<input type="hidden" name="process" value="section:save" id="process" />
							<input type="submit" name="Enviar" value="Crear" /></li>
						</ul>
					</fieldset>
				</form>
			</div>
			
		</div>
		<div class="menu">
		
		</div>
	</div>

<?php
Cms_View_Template::instace()->getFooter();
?>