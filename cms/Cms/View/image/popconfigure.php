<script type="text/javascript" charset="utf-8">
	
	function refreshimag(img)
	{
		$('#pop_img_display').html($('<img id="new_image" src="../' + img + '" />'));
		$('#new_image').load( function(){
			var width = ($('#new_image').width() < 250) ? $('#new_image').width() : 250;
			
			$('#new_image').width(width);
		});
		$('#thumbnail').val('');
	}
</script>
<h3>Asignar nueva página principal para:  <a href="#" class="jqmClose modal_close_bluebg">Cerrar</a></h3>

<div id="modalcontent" class="">
<h4>Ingresa las opciones para la imagen: </h4>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td> <div style="height: 300px; overflow:hidden;"><img src="../<?php echo $imagen->get('file_path'); ?>" width ="300" /></div> </td>
		<td id="pop_img_display" align="center" valign="middle" width="20%">
		<?php if($imagen->get('thumbnail')):
			list($width, $height, $type, $attr) = getimagesize('../'.$imagen->get('thumbnail'));
			
			$nwidth = ($width < 250) ? $width : 250;
		?>
		<img width="<?php echo $nwidth; ?>" src="../<?php echo $imagen->get('thumbnail'); ?>" id="thumb_img" />
		<br />
		<a href="#" class="button delete_thumbnail" rel="<?php echo $imagen->get('id'); ?>" style="font-size:11px; width:100px; display:block; margin: 10px 0px;">Borrar thumbnail</a>
		<?php endif; ?>
		</td>
	</tr>
</table>
<?php
	function mb_unserialize($serial_str) {
	    $out = @preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
	    return unserialize($out);   
	}
	$nombreImagen = $imagen->serialized('image_name');
	// echo '<!--';
	// echo $imagen->get('coded_properties');
	// echo "\n";
	$d = json_decode($imagen->get('coded_properties'));
	// var_dump($d);
	// echo "\n";
	// echo $d->image_name;
	// echo '-->';
	
	$search = array('"');
	$replac = array('&quot;');
	//$nombreImagen = stripslashes( str_replace('"', '&quot;', $d->image_name));
	
?>
	<form action="<?php Core_Common_Route::linkController('image:updateconfig') ?>" id="updateimage" name="updateimage">
		<div class="pop_jxresult"></div>
		<fieldset>
			<ul>
				<li>
					<div class="label"><label for="image_link">Nombre:</label></div>
          <div class="cell"><input type="text" name="image_name" 
            value="<?php if(!$d->image_name){ }else{ echo stripslashes($d->image_name); } ?>" /></div>
				</li>
				<li>
					<div class="label"><label for="image_link">Link de la imagen:</label></div>
					<div class="cell"><input type="text" name="image_url" value="<?php if(!$imagen->serialized('image_link')){ ?>http://<?php }else{ echo $imagen->serialized('image_link'); } ?>" /></div>
				</li>
				<li>
					<div class="label"><label for="image_description">Descripción de la imagen:</label></div>
					<div class="cell"><textarea name="image_description" style=""><?php echo stripslashes($d->image_description); ?></textarea></div>
				</li>
				<li>
					<div class="label"><input type="hidden" name="image_id" value="<?php echo $imagen->get('id'); ?>" /> &nbsp;</div>
					<div class="cell">
					<input type="submit" name="submit" id="updateimage" value="Guardar" /> <a href="#" class="cancel jqmClose">Cerrar</a> </div>
				</li>
			</ul>
		</fieldset>
		
	</form>
	<form action="<?php Core_Common_Route::linkController('image:uploadThumbnail') ?>" id="updateimage" name="updateimage" 
		target="upload_thumb" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<fieldset>
			<ul>
				<li>
					<div class="label"><label for="image_link">Thumbnail:</label></div>
					<div class="cell"><input type="file" name="thumbnail" id="thumbnail" value="" class="inline" style="width:auto;" /> <input class="inline" type="submit" name="submit" value="Subir imagen" /> </div>
				</li>
				<li>
					<div class="label"><input type="hidden" name="image_id" value="<?php echo $imagen->get('id'); ?>" />
						<input type="hidden" name="site_id" id="site_id" value="<?php echo $site_id; ?>" />&nbsp;</div>
					<div class="cell">
						<iframe name="upload_thumb" id="upload_thumb" class="inline" src="Cms/includes/empty.html" height="20" width="220" frameborder="0"></iframe>
					</div>
				</li>
			</ul>
		</fieldset>
	</form>
</div>
