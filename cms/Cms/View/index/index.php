<?php
Cms_View_Template::instace()->getHeader();
?>
	<div id="app">
		<div class="content">
			<h2 class="bc">Dashboard</h2>
			<table class="list">
				<caption><h5 class="topborder">Sitios Actuales</h5></caption>
				<thead>
					<tr>
						<th>Sitio Web</th>
						<th>Dominio</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
					<?php if($sites->count() > 0): ?>
				<tbody>
					<?php foreach($sites as $site): ?>
					<tr>
						<td><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a></td>
						<td><?php echo $site->get('domain'); ?></td>
						<td>Publico</td>
						<td class="opt"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>">Ver contenido</a> </td>
					</tr>
					<?php endforeach; ?>
				</tbody>
					<?php endif; ?>
			</table>
		</div>
		<div class="menu">
			<!--
		<a href="<?php Core_Common_Route::linkController('site:add'); ?>" id="create_new_product" class="button">Crear nuevo Sitio Web</a>-->
		</div>
	</div>
	
<?php
Cms_View_Template::instace()->getFooter();
?>