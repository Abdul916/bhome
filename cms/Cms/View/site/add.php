<?php
Cms_View_Template::instace()->getHeader();
?>

	<div id="app">
		<div class="content">
			<h2 class="bc">Administrador de contenido</h2>
			
			<div class="form">
				<form action="<?php Core_Common_Route::linkController('index'); ?>" class="app" method="post" accept-charset="utf-8">
					<fieldset class="vertical">
						<h3><a id="new-product" href="#new-product">Nuevo Sitio Web</a></h3>
						
						<ul>
							<li>
								<div class="label"><label for="page_name">Nombre del sitio</label></div>
								<div class="cell"><input type="text" name="name" value="" /></div>
							</li>
							<li>
								<div class="label"><label for="page_name">Dominio</label></div>
								<div class="cell"><input type="text" name="domain" value="" /></div>
							</li>
							<li>
								<div class="label"><label for="page_name">Path</label>
									<p class="description">Ruta en servidor al sitio.</p>
									</div>
								<div class="cell"><input type="text" name="path" value="" /></div>
								<div class ="clear"></div>
							</li>
							<li>
								<div class="label"><label for="page_name">Descripción</label></div>
								<div class="cell"> <textarea name="description"></textarea> </div>
							</li>
						</ul>
						
					</fieldset>
					
					
					<fieldset class="options">
						<ul>
							<li><div class="label"><label></label></div>
							<input type="hidden" name="process" value="site:save" id="process" />
							<input type="submit" name="Enviar" value="Crear" /></li>
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