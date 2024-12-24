<?php
Cms_View_Template::instace()->getHeader();
?>
	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt;
				 
				Secciones principales</h2>

			<div class="form">
				<form action="" class="app" accept-charset="utf-8" method="post">
					<fieldset class="vertical">
						<h3><?php echo $site->get('name'); ?> </h3>
					</fieldset>
					
					<div class="stdFormTable menuList">
						<table border="0" cellspacing="0" cellpadding="0">
							<thead>
							<tr><th>Titulo menú</th></tr>
							</thead>
							<tbody>
								<tr>
									<td>
										
										<?php if($parents->count() > 0): ?>
										<ul>
										<?php foreach($parents as $parent): ?>
											<li>

												<h3><?php echo $parent->get('title'); ?>
													<a href="<?php Core_Common_Route::linkController('menuItem:edit', array('id' => $parent->get('id'), 'menu_id' => $menu->get('id') , 'site_id' => $site->get('id'))) ?>">Editar</a> <span><?php echo $parent->publishStatusToNoun( $parent->get('publish_status')); ?></span></h3>
													<?php
													$child = $menu->getChildsForMenuItem( $parent);

													if($menu->getChildsForMenuItem( $parent))
														Cms_Library_MenuViewHelper::printUls( $child, $menu);
													?>
											</li>
										<?php endforeach; ?>
										</ul>
										<?php endif; ?>


										</td>
									</tr>
								</tbody>
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