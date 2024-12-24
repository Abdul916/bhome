<?php

Cms_View_Template::instace()->addJavascript('core-includes/javascript/vendor/jquery/jquery-1.7.min.js');
Cms_View_Template::instace()->addJavaScript('core-includes/javascript/vendor/jquery/plugins/tablednd-0.5/jquery.tablednd_0_5.js');
Cms_View_Template::instace()->addJavaScript('Cms/includes/javascript/jqModal/jqModal.js');
Cms_View_Template::instace()->getHeader();

?>
<script type="text/javascript" charset="utf-8">
	function deletepage(section_id, page_id)
	{
		$.post('<?php Core_Common_Route::linkController('page:delete'); ?>&page_id=' + page_id, 
		'&page_id='+page_id,
		function(data){
			$('#page_row-'+page_id).fadeTo(400, 0, function () { 
			        $(this).remove();
			    });
		});
	}
</script>
	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt; Secciones principales</h2>
			
			<?php if($sections->count() > 0): ?>
			<?php foreach($sections as $section): ?>
			<div class="section">
				<div class="information">
					<?php
					$pagesparent = $section->getParentPages();
					
					if($pagesparent->count() > 0){
						$pages = $pagesparent;
					}else{
						$pages = $section->getPages();
					}
					
					?>
					<h3><?php echo $section->get('name'); ?> 
						<a href="<?php Core_Common_Route::linkController('page:add', array('id' => $section->get('id'), 'site_id' => $site->get('id'))); ?>" class="button">AGREGAR PÁGINA</a>
						<a href="<?php Core_Common_Route::linkController('section:edit', array('id' => $section->get('id'), 'site_id' => $site->get('id'))) ?>" class="button">EDITAR SECCIÓN</a>
						<?php if($pages->count() > 0): ?>
						<a href="#" rel="pagelist-<?php echo $section->get('id'); ?>" class="button clear_button btn_sort<?php echo $section->get('id') ?>">ORDERNAR</a>
						<?php endif; ?>
						</h3>
					
						<table id='pagelist-<?php echo $section->get('id'); ?>'>
							<thead>
							<tr>
								<th></th>
								<th>Nombre Página</th>
								<th width="20%">Fecha de creación</th>
								<th width="20%">Opciones</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if($pages->count() > 0):
								foreach($pages as $page):
									if(!$page->get('site_language_id')):
							?>
								<tr id="page_row-<?php echo $page->get('id'); ?>">
									<?php if($page->haschilds()){ ?>

										<td width="3%"><img src="Cms/includes/images/package.png" width="16" height="16" /></td>

										<td><a href="<?php Core_Common_Route::linkController('page:childs' , array('id' => $page->get('id'), 'site_id' => $site->get('id'))) ?>"><?php echo $page->get('name'); ?></a></td>

										<?php }else{
											$page_icon = 'page_white.png';
											if($page->get('publish_status') == 0)
											{
												$page_icon = 'page_white_key.png';
											}
											if($page->get('index_status') == 1)
											{
												$page_icon = 'page_white_star.png';
											}
											?>
											<td width="3%"><img src="Cms/includes/images/<?php echo $page_icon; ?>" width="16" height="16" /></td>

									<td><?php echo $page->get('name'); ?></td>
									<?php } ?>
									<td><?php echo $page->get('created_at'); ?></td>
									<td class="opt">
										<a href="<?php Core_Common_Route::linkController('page:edit', array('id' => $page->get('id'), 'site_id' => $site->get('id'))); ?>">Editar</a>
										<a href="Javascript:;" onClick="if(confirm('¿Deseas borrar esta página?')){ deletepage(<?php echo $section->get('id'); ?>, <?php echo $page->get('id'); ?>);}">Borrar</a>
									</td>
								</tr>
							<?php
									endif;
								endforeach;
								?>
							</tbody>
							<?php
							endif;	
							?>
						</table>
					
				</div>
				<div class="options">
					<a href="#" class="app_button page_edit_icon"><span>Editar Sección</span></a>
				</div>
				
				<!-- MODALES -->
				<div class="jqmWindow" id="seccsort<?php echo $section->get('id'); ?>">
				Espere... <img src="images/loading.gif" alt="loading" />
				</div>
				<script type="text/javascript" charset="utf-8">
					$('#seccsort<?php echo $section->get('id'); ?>').jqm({ajax: '<?php Core_Common_Route::linkController('section:poporderpages', array('site_id' => $site->get('id') , 'section_id' => $section->get('id'))) ?>', trigger: 'a.btn_sort<?php echo $section->get('id'); ?>'});

				</script>
				<!-- end modales -->
				
			</div>
			<?php endforeach; ?>
			<?php endif; ?>
			
		</div><!-- end div.content -->
		<div class="menu">
		<a href="<?php Core_Common_Route::linkController('section:add', array('id' => $site->get('id')) ); ?>" id="create_new_product" class="button">Crear nueva Sección</a>
		<a href="<?php Core_Common_Route::linkController('section:order', array('id' => $site->get('id')) ); ?>" id="configure_site" class="button">Reordenar secciones</a>
		<!-- 
		<a href="<?php Core_Common_Route::linkController('siteConfiguration:index', array('id' => $site->get('id')) ); ?>" id="configure_site" class="button">Configurar Sitio</a>
		<a href="<?php Core_Common_Route::linkController('menu' , array('id' => $site->get('id')))?>" id="admin_menus" class="button">Menús</a>
		-->
		
		
		</div>
	</div>
<?php
Cms_View_Template::instace()->getFooter();
?>