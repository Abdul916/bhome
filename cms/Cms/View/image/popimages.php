<h3>Reordenar páginas principales de
	<a href="#" class="jqmClose modal_close_bluebg">Cerrar</a></h3>
<script type="text/javascript" charset="utf-8">
	function CallSaveOrden( serialization)
	{
		/*$.post('',
			serialization,
			function(data)
			{
				// respuesta
				$('.inline_alert').css({'display': 'block'});
				//loadImages('#<?php echo $field; ?>', data);
				return false;
			}
			);*/
			
		var slctdImg = $('#img' + $('input:radio[name=selectedgalleryid]:checked').val());
		var id_imagen = $(jQuery('<input type="text" name="<?php echo $field.'-auto'; ?>" value="'+ $('input:radio[name=selectedgalleryid]:checked').val() +'" /> <br /><img src="' + slctdImg.attr('src') + '" width="100" class="thumb_img" />'));
		$('#<?php echo $field; ?>image').html(id_imagen);
		$('.jqmWindow').jqmHide();
		return false;
	}

</script>
<style type="text/css" media="screen">
	#list {
		overflow: auto;
		height: 400px;
	}
	.inline_alert { display: none;}
</style>
<div id="modalcontent" class="">
	<form action="popgaleries_submit" method="post" id="galleryselection" accept-charset="utf-8">
		
	<p style="margin-top:0px">Selecciona la galería que deseas asignar a esta página</p>
	
	<div id="list" class="galerylist">
		<div class="box">
			<div class="img"><label for="radio0"><div style="width:110px; height:85px; display:inline-table; background-color:#CCC;" /></label></div>
			<p>
				<input type="radio" name="selectedgalleryid" value="0" id="radio0">
				<label for="radio0">Nueva imagen</label>
			</p>
		</div>
		
		
		<?php if($images->count() > 0):
				foreach($images as $image):
					if( is_file($image->get('sys_thumbnail'))):
		?>
			<div class="box">
				<div class="img"><label for="radio<?php echo $image->get('id'); ?>"><img src="<?php echo $image->get('sys_thumbnail'); ?>" id="img<?php echo $image->get('id'); ?>" width="110" /></label></div>
				<p>
					<input type="radio" name="selectedgalleryid" value="<?php echo $image->get('id'); ?>" id="radio<?php echo $image->get('id'); ?>">
					<label for="radio<?php echo $image->get('id'); ?>"><?php echo $image->get('file'); ?></label>
				</p>
			</div>
		<?php 
					endif;
				endforeach;
			endif; ?>
	<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<p>
	<input type="submit" name="send" value="Seleccionar Imagen" id="send" >
	<div class="inline_alert">
		<p>Galería asignada con exito</p>
	</div>
	</form>
	<script type="text/javascript" charset="utf-8">
		$('#galleryselection').submit(function() {
		  CallSaveOrden( $(this).serialize());
		  return false;
		});
	</script>
	</p>
</div>
