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
			<h2 class="bc">
				<a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"
					><?php echo $site->get('name'); ?></a>

					 &gt; <?php echo $section->get('name'); ?></h2>
			
			<div class="section">
				<div class="information">
					<h3><?php
					$parent = $page->getParentPage();

					if($parent && $parent->count() == 1):
					?>
					<a href="<?php Core_Common_Route::linkController('page:childs', array('id' => $parent->get('id'), 'site_id' => $site->get('id') )); ?>"><?php echo $parent->get('name').' &gt; '; ?></a>
					<?php
					endif;
					echo $page->get('name'); ?> 
						<?php if($page->get('lang_main_page_id') == 0): ?>
						<a href="<?php Core_Common_Route::linkController('page:add', array('id' => $section->get('id'), 'site_id' => $site->get('id'), 'parent_page' => $page->get('id'))); ?>" class="button">AGREGAR PÁGINA</a>
						<?php endif; ?>
						<a href="#" rel="pagelist-<?php echo $section->get('id'); ?>" class="button clear_button btn_sort<?php echo $page->get('id') ?>">ORDENAR</a>
						</h3>
					
						<table>
							<thead>
							<tr>
								<th></th>
								<th>Nombre página</th>
								<th width="15%">Tipo</th>
								<th width="15%">Fecha de publicación</th>
								<th width="15%">Fecha creación</th>
								<th width="15%">Opciones</th>

							</tr>
							</thead>
							<tbody>
							<?php
							if($pages->isCollection()):
								foreach($pages as $pag):
							?>
								<tr id="page_row-<?php echo $pag->get('id'); ?>">
									<?php if($pag->haschilds()){ ?>
										<td width="3%"><img src="Cms/includes/images/package.png" width="16" height="16" /></td>
										<td><a href="<?php Core_Common_Route::linkController('page:childs' , array('id' => $pag->get('id'), 'site_id' => $site->get('id'))) ?>"><?php echo $pag->get('name'); ?></a></td>
										<?php }else{
												$page_icon = 'page_white.png';
												if($pag->get('publish_status') == 0)
												{
													$page_icon = 'page_white_key.png';
												}
												if($pag->get('index_status') == 1)
												{
													$page_icon = 'page_white_star.png';
												}
											?>

									<td width="3%"><img src="Cms/includes/images/<?php echo $page_icon; ?>" width="16" height="16" /></td>

									<td><?php echo $pag->get('name'); ?></td>
									<?php } ?>
									<td><?php echo $page_structures_array[$pag->get('page_structure_id')]->get('name'); ?></td>
									<td><?php echo $pag->get('publish_date'); ?></td>
									<td><?php 

									echo $page_structures_array[$pag->get('page_structure_id')]->get('name');

									 ?></td>
									<td class="opt">
										<a href="<?php Core_Common_Route::linkController('page:edit', array('id' => $pag->get('id'))); ?>">Editar</a>
										<a href="Javascript:;" onClick="if(confirm('¿Deseas borrar esta página?')){ deletepage(<?php echo $section->get('id'); ?>, <?php echo $pag->get('id'); ?>);}">Borrar</a>
										</td>
								</tr>
							<?php
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
			</div>
			
			
		</div><!-- end div.content -->
		<div class="menu">
		<a href="#" id="create_new_product" class="button">Crear nueva Sección</a>
		</div>
	</div>
	<!-- MODALES -->
	<div class="jqmWindow" id="pagesort<?php echo $page->get('id'); ?>">
	Espere... <img src="images/loading.gif" alt="loading" />
	</div>
	<script type="text/javascript" charset="utf-8">
		$('#pagesort<?php echo $page->get('id'); ?>').jqm({ajax: '<?php Core_Common_Route::linkController('page:poporderpages', array('site_id' => $site->get('id') , 'page_id' => $page->get('id'))) ?>', trigger: 'a.btn_sort<?php echo $page->get('id'); ?>'});

	</script>
	<!-- end modales -->
<?php
Cms_View_Template::instace()->getFooter();
?>
