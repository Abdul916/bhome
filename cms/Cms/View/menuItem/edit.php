<?php
Cms_View_Template::instace()->getHeader();
?>

	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt; 
				<a href="<?php Core_Common_Route::linkController('menu:detail', array('id' => $menu->get('id') , 'site_id' => $site->get('id'))); ?>"><?php echo $menu->get('description'); ?></a> &gt; 
				Edición de menú</h2>
			
			<div class="form">
				<form action="<?php Core_Common_Route::linkController('menu:detail', array('id' => $menu->get('id') , 'site_id' => $site->get('id'))); ?>" class="app" method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Nuevo Sitio Web</a></h3>
						
						<ul>
							<li>
								<div class="label"><label for="page_name">Titulo menú</label></div>
								<div class="cell"><input type="text" name="title" value="<?php echo $menuitem->get('title'); ?>" /></div>
							</li>
							<li>
								<div class="label"><label for="page_name">Publico</label>
									<p class="description">Indica si el menú se muestra<br /> en la página web.</p>
									</div>
								<div class="cell">
										<select name="publish_status">
											<option value ="0"<?php if($menuitem->get('publish_status') == 0){ echo ' selected="selected"'; } ?>>No publicado</option>
											<option value ="1"<?php if($menuitem->get('publish_status') == 1){ echo ' selected="selected"'; } ?>>Publicado</option>
										</select>
									</div>
								<div class="clear"></div>
							</li>
							<li>
								<div class="label"><label for="page_name">Link a página:</label>
									<p class="description">Página a la que liga este menú.</p>
									</div>
								<div class="cell"> 
									<?php if(is_object($linkedElement)): ?>
									<a href="<?php Core_Common_Route::linkController('page:edit', array('id' => $linkedElement->get('id'))) ?>"><?php echo $linkedElement->get('name'); ?></a>
									<?php endif; ?>
									</div>
								<div class ="clear"></div>
							</li>
						</ul>
						
					</fieldset>
					
					
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
							<input type="hidden" name="process" value="menuItem:update" id="process" />
							<input type="hidden" name="menuitem_id" value="<?php echo $menuitem->get('id'); ?>" id="process" />
							<input type="submit" name="Enviar" value="Actualizar" /></li>
						</ul>
					
					</fieldset>
				</form>
			</div>
			
		</div>
		<div class="menu">
		<a href="#" id="create_new_product" class="button">Crear nuevo producto</a>
		</div>
	</div>

<?php
Cms_View_Template::instace()->getFooter();
?>