<?php
Cms_View_Template::instace()->getHeader();
?>
	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt; Secciones principales</h2>
			
			
			<div class="form">
				<form action="" class="app" accept-charset="utf-8" method="post">
					<fieldset class="vertical">
						<h3><?php echo $site->get('name'); ?> </h3>
					</fieldset>
					<div class="stdFormTable">
						<table>
							<thead>
							<tr>
								<th></th>
								<th>Nombre Menú</th>
								<th>Codigo para Theme</th>
								<th>Tipo de menú</th>
								<th>Opciones</th>
							</tr>
							</thead>
							<?php if($menus->count() > 0): ?>
							<tbody>
							<?php foreach($menus as $menu): ?>
								<tr>
									<td width="3%"><img src="images/cms/package_green.png" width="16" height="16" /></td>
									<td><a href="<?php Core_Common_Route::linkController('menu:detail' , array('id' => $menu->get('id'), 'site_id' => $site->get('id'))) ?>"><?php echo $menu->get('name'); ?></a></td>
									<td><?php echo $menu->get('code_name'); ?></td>
									<td><?php echo $menu->typeToNoun( $menu->get('type')); ?></td>
									<td class="opt"> <a href="<?php Core_Common_Route::linkController('menu:detail', array('id' => $menu->get('id'))); ?>">Editar</a></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
							<?php endif; ?>
						</table>
						</div>
					</form>
			</div>
			
			
		</div><!-- end div.content -->
		<div class="menu">
			<form action="<?php echo Core_Common_Route::linkController('menu:index' , array('id' => $site->get('id'))); ?>" method="post" name="built_menu" id="built_menu" accept-charset="utf-8">
				<a href="#" onClick="javascript:document.built_menu.submit(); return false;" id="create_new_product" class="button">Crear Menús</a>
				<input type="hidden" name="process" value="menu:updateMenus" id="process" />
				<input type="hidden" name="site_id" value="<?php echo $site->get('id'); ?>"  id="site_id" />
				
			</form>
			
			<a href="<?php Core_Common_Route::linkController('menu:create'); ?>" id="create_new_product" class="button">Crear nuevo menú</a>
		</div>
	</div>
<?php
Cms_View_Template::instace()->getFooter();
?>