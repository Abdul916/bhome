<?php
Cms_View_Template::instace()->getHeader();
?>
	<div id="app">
		<div class="content">
			<h2 class="bc"><a href="<?php Core_Common_Route::linkController('site:general', array('id' => $site->get('id'))); ?>"><?php echo $site->get('name'); ?></a> &gt; Configuración &gt; Templates</h2>
			
			<div id="tabs">
				<ul>
					<li><a href="<?php Core_Common_Route::linkController('siteConfiguration:index', array('id' => $site->get('id'))); ?>" class="selected">Generales</a></li>
					<li><a href="<?php Core_Common_Route::linkController('siteConfiguration:siteStructure', array('id' => $site->get('id'))); ?>">Templates</a></li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<!-- tab content -->
			<div class="form">
				<form action="<?php Core_Common_Route::linkController('siteConfiguration:index', array('id' => $site->get('id'))) ?>" class="app"method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Configuración general</a></h3>
						<h4>Información sobre la configuración del sitio web: <em><?php echo $site->get('name'); ?></em></h4>
					</fieldset>
					<fieldset class="vertical">
						<ul>
							<li>
								<div class="label"><label for="name">Path a carpeta de media: </label></div>
								<div class="cell"><input type="text" id="media_path" name="media_path" value="<?php echo $site->get('path'); ?>" /></div>
							</li>
							<li>
								<div class="label"><label for="name">Dominio del sitio: </label>
									<p class="description">No incluir http:// o www. <br />Ejemplo: misitio.com</p>
									</div>
								<div class="cell"><input type="text" id="domain" name="domain" value="<?php echo $site->get('domain'); ?>" /></div>
								<div class="clear"></div>
							</li>
							<li>
								<div class="label"><label for="description">Descripción</label></div>
								<div class="cell"><textarea name="description" id="description" cols="30" rows="10"><?php echo $site->get('description'); ?></textarea></div>
							</li>
						</ul>
					</fieldset>
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
								<input type="hidden" name="site_id" value="<?php echo $site->get('id'); ?>" />
								<input type="hidden" name="process" value="siteConfiguration:updateSiteConfig" />
								<input type="submit" name="Enviar" value="Actualizar Configuración" /></li>
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