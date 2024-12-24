<h3>Reordenar páginas principales de: <?php echo $currentparent->get('name'); ?>
	<a href="#" class="jqmClose modal_close_bluebg">Cerrar</a></h3>

<div id="modalcontent" class="">
	<script type="text/javascript" charset="utf-8">
		function CheckIsIE()
		{
			if (navigator.appName.toUpperCase() == 'MICROSOFT INTERNET EXPLORER') { return true;}
			else { return false; }
		}
		function CallSaveOrden()
		{
			if (CheckIsIE() == true)
			{
				document.content.focus(); document.content.saveneworden();
			}else{
				window.frames['content'].focus();
				window.frames['content'].saveneworden();
			}
		}
	</script>
	<style type="text/css" media="screen">
		#list {
			overflow: auto;
			height: 400px;
		}
	</style>
	<div id="list">
		<iframe src ="<?php Core_Common_Route::linkController('page:orderPagesFrame', array('page_id' => $currentparent->get('id'), 'site_id' => $site->get('id'))); ?>" 
			width="555" height="380" frameborder="0" id="content" name="content">
		  <p>Su navegador no soporta iFrames.</p>
		</iframe>
	</div>
	<p>
	<input type="submit" name="send" value="Guardar" id="send" onClick="CallSaveOrden();">
	</p>
</div>
